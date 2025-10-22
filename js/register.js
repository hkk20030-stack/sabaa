// Register Form Handler
const registerForm = document.getElementById('registerForm');
const registerButton = document.getElementById('registerBtn');
const messageBox = document.getElementById('messageBox');
const passwordToggle = document.getElementById('passwordToggle');
const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');

// Toggle Password Visibility
passwordToggle.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        passwordToggle.textContent = '👁️';
    }
});

confirmPasswordToggle.addEventListener('click', () => {
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        confirmPasswordToggle.textContent = '🙈';
    } else {
        confirmPasswordInput.type = 'password';
        confirmPasswordToggle.textContent = '👁️';
    }
});

// Register Form Submission
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Get form values
    const fullName = document.getElementById('fullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const agree = document.getElementById('agree').checked;
    
    // Validate inputs
    if (!fullName || !username || !password || !confirmPassword) {
        showMessage('الرجاء ملء جميع الحقول المطلوبة', 'error');
        return;
    }
    
    // Validate full name
    if (fullName.length < 3) {
        showMessage('الاسم يجب أن يكون 3 أحرف على الأقل', 'error');
        return;
    }
    
    // Validate username length
    if (username.length < 3) {
        showMessage('اسم المستخدم يجب أن يكون 3 أحرف على الأقل', 'error');
        return;
    }
    
    // Validate password length
    if (password.length < 6) {
        showMessage('كلمة المرور يجب أن تكون 6 أحرف على الأقل', 'error');
        return;
    }
    
    // Validate password match
    if (password !== confirmPassword) {
        showMessage('كلمات المرور غير متطابقة', 'error');
        return;
    }
    
    // Validate email format if provided
    if (email && !isValidEmail(email)) {
        showMessage('صيغة البريد الإلكتروني غير صحيحة', 'error');
        return;
    }
    
    // Validate agreement
    if (!agree) {
        showMessage('يجب عليك الموافقة على شروط الخدمة', 'error');
        return;
    }
    
    // Add loading state
    registerButton.classList.add('loading');
    registerButton.disabled = true;
    
    // Create FormData
    const formData = new FormData();
    formData.append('fullName', fullName);
    formData.append('email', email);
    formData.append('username', username);
    formData.append('password', password);
    formData.append('confirmPassword', confirmPassword);
    
    try {
        // Send register request to PHP
        const response = await fetch('php/register.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        // Remove loading state
        registerButton.classList.remove('loading');
        registerButton.disabled = false;
        
        if (data.success) {
            showMessage('تم إنشاء الحساب بنجاح! جاري التحويل...', 'success');
            
            // Store user data in localStorage
            localStorage.setItem('username', username);
            localStorage.setItem('full_name', fullName);
            
            // Redirect to main page after 1.5 seconds
            setTimeout(() => {
                window.location.href = 'index.html';
            }, 1500);
        } else {
            showMessage(data.message, 'error');
        }
    } catch (error) {
        registerButton.classList.remove('loading');
        registerButton.disabled = false;
        showMessage('حدث خطأ في الاتصال: ' + error.message, 'error');
    }
});

// Validate Email Function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Message Display Function
function showMessage(message, type = 'info') {
    messageBox.textContent = message;
    messageBox.className = 'message-box ' + type;
    messageBox.style.display = 'block';
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        messageBox.style.display = 'none';
    }, 5000);
}

// Input Focus Effects
document.querySelectorAll('.form-group input').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateY(-2px)';
        this.parentElement.style.transition = 'transform 0.3s ease';
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateY(0)';
    });
});

// Real-time password match validation
confirmPasswordInput.addEventListener('input', () => {
    if (passwordInput.value && confirmPasswordInput.value) {
        if (passwordInput.value === confirmPasswordInput.value) {
            confirmPasswordInput.style.borderColor = '#4caf50';
        } else {
            confirmPasswordInput.style.borderColor = '#f44336';
        }
    } else {
        confirmPasswordInput.style.borderColor = '#e0e0e0';
    }
});

// Console Welcome Message
console.log('%c🌸 مرحباً بك في سبا! 🌸', 'color: #a67c52; font-size: 20px; font-weight: bold;');
console.log('%cتجربة فريدة من الاسترخاء والجمال', 'color: #666; font-size: 14px;');

