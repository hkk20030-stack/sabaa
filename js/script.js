// Check if user is logged in
function checkUserLogin() {
    const userId = localStorage.getItem('user_id');
    const username = localStorage.getItem('username');
    const fullName = localStorage.getItem('full_name');
    
    if (userId && username) {
        // User is logged in
        const loginLink = document.querySelector('a[href="login.html"]');
        if (loginLink) {
            loginLink.textContent = `تسجيل الخروج (${fullName || username})`;
            loginLink.href = '#';
            loginLink.onclick = function(e) {
                e.preventDefault();
                logout();
            };
            loginLink.style.background = '#d4b5a0';
            loginLink.style.color = '#2c2c2c';
        }
    }
}

// Logout function
function logout() {
    fetch('php/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear localStorage
                localStorage.removeItem('user_id');
                localStorage.removeItem('username');
                localStorage.removeItem('full_name');
                localStorage.removeItem('email');
                
                // Redirect to login page
                window.location.href = 'login.php';
            }
        })
        .catch(error => console.error('Logout error:', error));
}

// Mobile Menu Toggle
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.querySelector('.nav-menu');

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
    });
}

// Smooth Scroll for Navigation Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            const target = document.querySelector(href);
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            
            // Close mobile menu
            if (navMenu) {
                navMenu.classList.remove('active');
                if (menuToggle) menuToggle.classList.remove('active');
            }
        }
    });
});

// Contact Form Handler
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Get form values
        const name = contactForm.querySelector('input[placeholder="الاسم"]').value;
        const email = contactForm.querySelector('input[placeholder="البريد الإلكتروني"]').value;
        const phone = contactForm.querySelector('input[placeholder="رقم الهاتف"]').value;
        const message = contactForm.querySelector('textarea').value;
        
        // Simple validation
        if (!name || !email || !phone || !message) {
            alert('الرجاء ملء جميع الحقول');
            return;
        }
        
        // Show success message
        alert('شكراً لتواصلك معنا! سنرد عليك قريباً.');
        contactForm.reset();
    });
}

// CTA Button Click Handler
document.querySelectorAll('.cta-button').forEach(button => {
    button.addEventListener('click', (e) => {
        const userId = localStorage.getItem('user_id');
        
        if (!userId) {
            // Redirect to login if not logged in
            window.location.href = 'login.php';
        } else {
            // Show booking confirmation
            alert('شكراً! سيتم التواصل معك قريباً لتأكيد الحجز.');
        }
    });
});

// Product Button Click Handler
document.querySelectorAll('.product-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const userId = localStorage.getItem('user_id');
        
        if (!userId) {
            // Redirect to login if not logged in
            window.location.href = 'login.php';
        } else {
            // Show product details
            alert('تم إضافة المنتج إلى السلة');
        }
    });
});

// Navbar Background on Scroll
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
    } else {
        navbar.style.boxShadow = 'none';
        navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
    }
});

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.service-card, .product-card, .testimonial-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Lazy Load Images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// Add CSS for animations
const animStyle = document.createElement('style');
animStyle.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease;
    }
    
    .animate-fade-in-delay {
        animation: fadeIn 0.8s ease 0.3s both;
    }
    
    .animate-fade-in-delay-2 {
        animation: fadeIn 0.8s ease 0.6s both;
    }
`;
document.head.appendChild(animStyle);

// Console Welcome Message
console.log('%c🌸 مرحباً بك في سبا! 🌸', 'color: #a67c52; font-size: 20px; font-weight: bold;');
console.log('%cتجربة فريدة من الاسترخاء والجمال', 'color: #666; font-size: 14px;');

// Initialize on page load
window.addEventListener('load', () => {
    checkUserLogin();
});

