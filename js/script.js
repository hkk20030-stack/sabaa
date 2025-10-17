// Mobile Menu Toggle
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.querySelector('.nav-menu');

menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    
    // Animate hamburger icon
    const spans = menuToggle.querySelectorAll('span');
    spans[0].style.transform = navMenu.classList.contains('active') 
        ? 'rotate(45deg) translate(5px, 5px)' 
        : 'rotate(0) translate(0, 0)';
    spans[1].style.opacity = navMenu.classList.contains('active') ? '0' : '1';
    spans[2].style.transform = navMenu.classList.contains('active') 
        ? 'rotate(-45deg) translate(7px, -6px)' 
        : 'rotate(0) translate(0, 0)';
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-menu a').forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
        const spans = menuToggle.querySelectorAll('span');
        spans[0].style.transform = 'rotate(0) translate(0, 0)';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'rotate(0) translate(0, 0)';
    });
});

// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const navbarHeight = document.querySelector('.navbar').offsetHeight;
            const targetPosition = target.offsetTop - navbarHeight;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// Navbar Background on Scroll
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        navbar.style.background = 'rgba(255, 255, 255, 0.98)';
        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
    } else {
        navbar.style.background = 'rgba(255, 255, 255, 0.95)';
        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
    }
});

// Scroll Reveal Animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

// Add fade-in-up class to elements
const animateElements = document.querySelectorAll(
    '.service-card, .product-card, .testimonial-card, .gallery-item, .contact-item'
);

animateElements.forEach(el => {
    el.classList.add('fade-in-up');
    observer.observe(el);
});

// Product Card Interactions
document.querySelectorAll('.product-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        const productCard = btn.closest('.product-card');
        const productName = productCard.querySelector('h3').textContent;
        
        // Create a simple modal effect
        alert(`تم اختيار: ${productName}\n\nسيتم إضافة هذا المنتج إلى سلة التسوق قريباً!`);
    });
});

// CTA Button Interactions
document.querySelectorAll('.cta-button').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (!btn.type || btn.type !== 'submit') {
            e.preventDefault();
            
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.background = 'rgba(255, 255, 255, 0.5)';
            ripple.style.borderRadius = '50%';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s ease-out';
            
            btn.style.position = 'relative';
            btn.style.overflow = 'hidden';
            btn.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
            
            // Show confirmation
            alert('شكراً لاهتمامك! سيتم التواصل معك قريباً.');
        }
    });
});

// Add ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Form Submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Get form values
        const formData = new FormData(contactForm);
        const name = contactForm.querySelector('input[type="text"]').value;
        const email = contactForm.querySelector('input[type="email"]').value;
        const phone = contactForm.querySelector('input[type="tel"]').value;
        const message = contactForm.querySelector('textarea').value;
        
        // Validate
        if (!name || !email || !phone || !message) {
            alert('الرجاء ملء جميع الحقول');
            return;
        }
        
        // Show success message
        alert(`شكراً ${name}!\n\nتم إرسال رسالتك بنجاح. سنتواصل معك قريباً على:\nالبريد الإلكتروني: ${email}\nالهاتف: ${phone}`);
        
        // Reset form
        contactForm.reset();
    });
}

// Service Card Hover Effect
document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.background = 'linear-gradient(135deg, #f5f0eb, #e8dfd5)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.background = '#f5f0eb';
    });
});

// Gallery Lightbox Effect
document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function() {
        const img = this.querySelector('img');
        const lightbox = document.createElement('div');
        lightbox.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            cursor: pointer;
            animation: fadeIn 0.3s ease;
        `;
        
        const lightboxImg = document.createElement('img');
        lightboxImg.src = img.src;
        lightboxImg.style.cssText = `
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.5);
            animation: zoomIn 0.3s ease;
        `;
        
        lightbox.appendChild(lightboxImg);
        document.body.appendChild(lightbox);
        
        lightbox.addEventListener('click', () => {
            lightbox.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => lightbox.remove(), 300);
        });
    });
});

// Add lightbox animations
const lightboxStyle = document.createElement('style');
lightboxStyle.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    @keyframes zoomIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
`;
document.head.appendChild(lightboxStyle);

// Parallax Effect for Hero Section
window.addEventListener('scroll', () => {
    const hero = document.querySelector('.hero');
    const scrolled = window.pageYOffset;
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Counter Animation for Mystery Box
const animateCounter = (element, target, duration) => {
    let current = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
};

// Testimonial Card Rotation
let currentTestimonial = 0;
const testimonialCards = document.querySelectorAll('.testimonial-card');

const rotateTestimonials = () => {
    testimonialCards.forEach((card, index) => {
        card.style.transform = index === currentTestimonial 
            ? 'scale(1.05)' 
            : 'scale(1)';
        card.style.opacity = index === currentTestimonial ? '1' : '0.7';
    });
    
    currentTestimonial = (currentTestimonial + 1) % testimonialCards.length;
};

// Rotate testimonials every 5 seconds
if (testimonialCards.length > 0) {
    setInterval(rotateTestimonials, 5000);
}

// Add loading animation
window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 100);
});

// Product Price Animation
document.querySelectorAll('.new-price').forEach(price => {
    price.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
        this.style.transition = 'transform 0.3s ease';
    });
    
    price.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});

// Mystery Box Animation Enhancement
const box = document.querySelector('.box');
if (box) {
    box.addEventListener('mouseenter', () => {
        box.style.animation = 'float 1s ease-in-out infinite, spin 2s linear infinite';
    });
    
    box.addEventListener('mouseleave', () => {
        box.style.animation = 'float 3s ease-in-out infinite';
    });
}

const spinStyle = document.createElement('style');
spinStyle.textContent = `
    @keyframes spin {
        from { transform: rotateY(0deg) translateY(0); }
        50% { transform: rotateY(180deg) translateY(-20px); }
        to { transform: rotateY(360deg) translateY(0); }
    }
`;
document.head.appendChild(spinStyle);

// Console Welcome Message
console.log('%c🌸 مرحباً بك في مستري بوكس! 🌸', 'color: #a67c52; font-size: 20px; font-weight: bold;');
console.log('%cصندوق المفاجآت للسبا - تجربة فريدة من الاسترخاء والجمال', 'color: #666; font-size: 14px;');

