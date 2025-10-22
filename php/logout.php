<?php
// بدء الجلسة
session_start();

// حذف جميع متغيرات الجلسة
$_SESSION = array();

// حذف ملفات تعريف الارتباط
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// حذف ملفات تعريف الارتباط المخصصة
setcookie('spa_user_id', '', time() - 3600, "/");
setcookie('spa_username', '', time() - 3600, "/");

// إنهاء الجلسة
session_destroy();

// تعيين رأس JSON
header('Content-Type: application/json; charset=utf-8');

// إرسال رد النجاح
echo json_encode([
    'success' => true,
    'message' => 'تم تسجيل الخروج بنجاح',
    'redirect' => 'login.html'
]);
?>

