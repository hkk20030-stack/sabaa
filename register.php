<?php
// بدء الجلسة
session_start();

// إذا كان المستخدم مسجل دخول بالفعل، أعد توجيهه إلى الصفحة الرئيسية
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - سبا</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .login-form {
            max-height: 600px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-image-overlay"></div>
            <div class="login-content">
                <h1 class="brand-title">سبا</h1>
                <p class="brand-subtitle">تجربة فريدة من الاسترخاء والجمال</p>
            </div>
        </div>
        
        <div class="login-right">
            <div class="login-form-container">
                <div class="login-header">
                    <h2>إنشاء حساب جديد</h2>
                    <p>انضم إلينا واستمتع بخدماتنا المميزة</p>
                </div>
                
                <form id="registerForm" class="login-form" method="POST" action="php/register.php">
                    <div id="messageBox" class="message-box" style="display: none;"></div>
                    
                    <div class="form-group">
                        <label for="fullName">الاسم الكامل</label>
                        <input type="text" id="fullName" name="fullName" placeholder="أدخل اسمك الكامل" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني (اختياري)</label>
                        <input type="email" id="email" name="email" placeholder="example@email.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="username">اسم المستخدم</label>
                        <input type="text" id="username" name="username" placeholder="أدخل اسم المستخدم" required>
                        <small style="color: #999; margin-top: 5px; display: block;">يجب أن يكون 3 أحرف على الأقل</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="password-toggle" id="passwordToggle">👁️</button>
                        </div>
                        <small style="color: #999; margin-top: 5px; display: block;">يجب أن تكون 6 أحرف على الأقل</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">تأكيد كلمة المرور</label>
                        <div class="password-wrapper">
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="••••••••" required>
                            <button type="button" class="password-toggle" id="confirmPasswordToggle">👁️</button>
                        </div>
                    </div>
                    
                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" id="agree" name="agree" required>
                            <span class="checkmark"></span>
                            أوافق على شروط الخدمة
                        </label>
                    </div>
                    
                    <button type="submit" class="login-button" id="registerBtn">إنشاء الحساب</button>
                    
                    <div class="divider">
                        <span>أو</span>
                    </div>
                    
                    <div class="signup-link">
                        <p>هل لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="js/register.js"></script>
</body>
</html>

