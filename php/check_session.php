<?php
// بدء الجلسة
session_start();

// تعيين رأس JSON
header('Content-Type: application/json; charset=utf-8');

// التحقق من وجود جلسة نشطة
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo json_encode([
        'logged_in' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'full_name' => $_SESSION['full_name'],
            'email' => $_SESSION['email']
        ]
    ]);
} else {
    echo json_encode([
        'logged_in' => false
    ]);
}
?>

