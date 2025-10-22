<?php
// تفعيل عرض الأخطاء للتطوير
error_reporting(E_ALL);
ini_set('display_errors', 1);

// تعيين رأس JSON
header('Content-Type: application/json; charset=utf-8');

// بيانات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spa_db";

// محاولة الاتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'خطأ في الاتصال بقاعدة البيانات'
    ]);
    exit;
}

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
$confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
$fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// التحقق من البيانات المدخلة
if (empty($username) || empty($password) || empty($fullName)) {
    echo json_encode([
        'success' => false,
        'message' => 'الرجاء ملء جميع الحقول المطلوبة'
    ]);
    exit;
}

// التحقق من طول اسم المستخدم
if (strlen($username) < 3 || strlen($username) > 50) {
    echo json_encode([
        'success' => false,
        'message' => 'اسم المستخدم يجب أن يكون بين 3 و 50 حرف'
    ]);
    exit;
}

// التحقق من طول كلمة المرور
if (strlen($password) < 6) {
    echo json_encode([
        'success' => false,
        'message' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل'
    ]);
    exit;
}

// التحقق من تطابق كلمات المرور
if ($password !== $confirmPassword) {
    echo json_encode([
        'success' => false,
        'message' => 'كلمات المرور غير متطابقة'
    ]);
    exit;
}

// التحقق من صيغة البريد الإلكتروني
if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'صيغة البريد الإلكتروني غير صحيحة'
    ]);
    exit;
}

// التحقق من عدم وجود اسم مستخدم مكرر
$checkSQL = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($checkSQL);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        'success' => false,
        'message' => 'اسم المستخدم موجود بالفعل'
    ]);
    exit;
}

// تشفير كلمة المرور
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// إدراج المستخدم الجديد
$insertSQL = "INSERT INTO users (username, password, full_name, email) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($insertSQL);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'خطأ في تحضير الاستعلام'
    ]);
    exit;
}

$stmt->bind_param("ssss", $username, $hashedPassword, $fullName, $email);

if ($stmt->execute()) {
    // بدء جلسة المستخدم
    session_start();
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['full_name'] = $fullName;
    $_SESSION['login_time'] = time();
    
    echo json_encode([
        'success' => true,
        'message' => 'تم إنشاء الحساب بنجاح'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'حدث خطأ أثناء إنشاء الحساب: ' . $conn->error
    ]);
}

$stmt->close();
$conn->close();
?>

