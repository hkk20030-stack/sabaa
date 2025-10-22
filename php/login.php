<?php
// بدء الجلسة
session_start();

// تفعيل عرض الأخطاء للتطوير
error_reporting(E_ALL);
ini_set('display_errors', 0);

// تعيين رأس JSON
header('Content-Type: application/json; charset=utf-8');

// بيانات الاتصال بقاعدة البيانات
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "spa_db";

// محاولة الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'خطأ في الاتصال بقاعدة البيانات. تأكد من أن MySQL يعمل وقاعدة البيانات موجودة.'
    ]);
    exit;
}

// تعيين الترميز
$conn->set_charset("utf8mb4");

// التحقق من طريقة الطلب
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'طريقة الطلب غير صحيحة'
    ]);
    exit;
}

// الحصول على البيانات من النموذج
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$remember = isset($_POST['remember']) ? true : false;

// التحقق من البيانات المدخلة
if (empty($username) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'الرجاء إدخال اسم المستخدم وكلمة المرور'
    ]);
    exit;
}

// التحقق من طول اسم المستخدم
if (strlen($username) < 3 || strlen($username) > 50) {
    echo json_encode([
        'success' => false,
        'message' => 'اسم المستخدم غير صحيح'
    ]);
    exit;
}

// البحث عن المستخدم في قاعدة البيانات
$sql = "SELECT id, username, password, full_name, email, status FROM users WHERE username = ? AND status = 'active'";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'خطأ في قاعدة البيانات: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // تسجيل محاولة فاشلة
    error_log("Failed login attempt for username: " . $username . " at " . date('Y-m-d H:i:s'));
    
    echo json_encode([
        'success' => false,
        'message' => 'اسم المستخدم أو كلمة المرور غير صحيحة'
    ]);
    exit;
}

$user = $result->fetch_assoc();

// التحقق من كلمة المرور
if (!password_verify($password, $user['password'])) {
    // تسجيل محاولة فاشلة
    error_log("Failed password attempt for username: " . $username . " at " . date('Y-m-d H:i:s'));
    
    echo json_encode([
        'success' => false,
        'message' => 'اسم المستخدم أو كلمة المرور غير صحيحة'
    ]);
    exit;
}

// تحديث وقت آخر تسجيل دخول
$update_sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("i", $user['id']);
$update_stmt->execute();
$update_stmt->close();

// حفظ بيانات الجلسة
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['email'] = $user['email'];
$_SESSION['login_time'] = time();
$_SESSION['logged_in'] = true;

// إذا كان المستخدم قد اختار "تذكرني"
if ($remember) {
    // إنشاء ملف تعريف الارتباط لمدة 30 يوم
    setcookie('spa_user_id', $user['id'], time() + (30 * 24 * 60 * 60), "/", "", false, true);
    setcookie('spa_username', $user['username'], time() + (30 * 24 * 60 * 60), "/", "", false, true);
}

// إرسال رد النجاح مع رابط التحويل
echo json_encode([
    'success' => true,
    'message' => 'تم تسجيل الدخول بنجاح',
    'redirect' => 'index.html',
    'user' => [
        'id' => $user['id'],
        'username' => $user['username'],
        'full_name' => $user['full_name'],
        'email' => $user['email']
    ]
]);

$stmt->close();
$conn->close();
?>

