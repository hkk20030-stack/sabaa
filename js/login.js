// Login Form Handler
const loginForm = document.getElementById('loginForm');
const loginButton = document.getElementById('loginBtn');
const messageBox = document.getElementById('messageBox');
const passwordToggle = document.getElementById('passwordToggle');
const passwordInput = document.getElementById('password');

// Toggle Password Visibility
if (passwordToggle) {
    passwordToggle.addEventListener('click', (e) => {
        e.preventDefault();
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            passwordToggle.textContent = '👁️';
        }
    });
}

// Login Form Submission
if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Get form values
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        const remember = document.getElementById('remember') ? document.getElementById('remember').checked : false;
        
        // Validate inputs
        if (!username || !password) {
            showMessage('الرجاء ملء جميع الحقول', 'error');
            return;
        }
        
        // Validate username length
        if (username.length < 3) {
            showMessage('اسم المستخدم يجب أن يكون 3 أحرف على الأقل', 'error');
            return;
        }
        
        // Add loading state
        loginButton.classList.add('loading');
        loginButton.disabled = true;
        
        // Create FormData
        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);
        if (remember) {
            formData.append('remember', 'on');
        }
        
        try {
            // Send login request to PHP
            const response = await fetch('php/login.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            // Remove loading state
            loginButton.classList.remove('loading');
            loginButton.disabled = false;
            
            if (data.success) {
                showMessage('تم تسجيل الدخول بنجاح! جاري التحويل...', 'success');
                
                // Store user data in localStorage
                localStorage.setItem('user_id', data.user.id);
                localStorage.setItem('username', data.user.username);
                localStorage.setItem('full_name', data.user.full_name);
                localStorage.setItem('email', data.user.email);
                
                // Redirect to main page after 1.5 seconds
                setTimeout(() => {
                    window.location.href = data.redirect || 'index.php';
                }, 1500);
            } else {
                showMessage(data.message || 'حدث خطأ في تسجيل الدخول', 'error');
            }
        } catch (error) {
            loginButton.classList.remove('loading');
            loginButton.disabled = false;
            console.error('Login error:', error);
            showMessage('حدث خطأ في الاتصال: ' + error.message, 'error');
        }
    });
}

// Message Display Function
function showMessage(message, type = 'info') {
    if (!messageBox) return;
    
    messageBox.textContent = message;
    messageBox.className = 'message-box ' + type;
    messageBox.style.display = 'block';
    
    // Scroll to message
    messageBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        messageBox.style.display = 'none';
    }, 5000);
}

// Input Focus Effects
document.querySelectorAll('.form-group input').forEach(input => {
    input.addEventListener('focus', function() {
        if (this.parentElement) {
            this.parentElement.style.transform = 'translateY(-2px)';
            this.parentElement.style.transition = 'transform 0.3s ease';
        }
    });
    
    input.addEventListener('blur', function() {
        if (this.parentElement) {
            this.parentElement.style.transform = 'translateY(0)';
        }
    });
});

// Load remembered username if exists
window.addEventListener('load', () => {
    const rememberedUsername = localStorage.getItem('rememberedUsername');
    const usernameInput = document.getElementById('username');
    const rememberCheckbox = document.getElementById('remember');
    
    if (rememberedUsername && usernameInput) {
        usernameInput.value = rememberedUsername;
        if (rememberCheckbox) {
            rememberCheckbox.checked = true;
        }
    }
});

// Save username if remember me is checked
if (loginForm) {
    loginForm.addEventListener('submit', () => {
        const rememberCheckbox = document.getElementById('remember');
        const usernameInput = document.getElementById('username');
        
        if (rememberCheckbox && rememberCheckbox.checked && usernameInput) {
            localStorage.setItem('rememberedUsername', usernameInput.value);
        } else {
            localStorage.removeItem('rememberedUsername');
        }
    });
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    // Alt + U to focus on username
    if (e.altKey && e.key === 'u') {
        e.preventDefault();
        const usernameInput = document.getElementById('username');
        if (usernameInput) usernameInput.focus();
    }
    
    // Alt + P to focus on password
    if (e.altKey && e.key === 'p') {
        e.preventDefault();
        const passwordInput = document.getElementById('password');
        if (passwordInput) passwordInput.focus();
    }
    
    // Enter to submit form
    if (e.key === 'Enter' && document.activeElement === document.getElementById('password')) {
        if (loginForm) {
            loginForm.dispatchEvent(new Event('submit'));
        }
    }
});

// Console Welcome Message
console.log('%c🌸 مرحباً بك في سبا! 🌸', 'color: #a67c52; font-size: 20px; font-weight: bold;');
console.log('%cتجربة فريدة من الاسترخاء والجمال', 'color: #666; font-size: 14px;');
console.log('%c\n📝 بيانات الاختبار:\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n👤 اسم المستخدم: admin\n🔐 كلمة المرور: 123456\n\nأو\n\n👤 اسم المستخدم: user\n🔐 كلمة المرور: password\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━', 'color: #a67c52; font-size: 12px; line-height: 1.8;');

