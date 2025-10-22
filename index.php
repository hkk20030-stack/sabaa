<?php
// بدء الجلسة
session_start();

// التحقق من أن المستخدم مسجل دخول
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$username = $isLoggedIn ? $_SESSION['username'] : null;
$fullName = $isLoggedIn ? $_SESSION['full_name'] : null;
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سبا - تجربة فريدة من الاسترخاء والجمال</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>سبا</h1>
                    <span class="logo-subtitle">تجربة الاسترخاء والجمال</span>
                </div>
                <ul class="nav-menu">
                    <li><a href="#home">الرئيسية</a></li>
                    <li><a href="#services">الخدمات</a></li>
                    <li><a href="#products">المنتجات</a></li>
                    <li><a href="#offers">العروض الخاصة</a></li>
                    <li><a href="#contact">تواصل معنا</a></li>
                    <li>
                        <?php if ($isLoggedIn): ?>
                            <a href="php/logout.php" style="background: #d4b5a0; color: #2c2c2c; padding: 0.5rem 1.5rem; border-radius: 25px;">تسجيل الخروج (<?php echo htmlspecialchars($fullName ?: $username); ?>)</a>
                        <?php else: ?>
                            <a href="login.php" style="background: var(--primary-color); color: white; padding: 0.5rem 1.5rem; border-radius: 25px;">تسجيل الدخول</a>
                        <?php endif; ?>
                    </li>
                </ul>
                <button class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title animate-fade-in">استمتع بلحظات رائعة من الهدوء والاسترخاء</h1>
            <p class="hero-subtitle animate-fade-in-delay">استفيدوا من خصم 50% على جميع الخدمات لفترة محدودة!</p>
            <button class="cta-button animate-fade-in-delay-2">احجز الآن</button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">عن سبا</h2>
                    <p>نقدم لك تجربة فريدة من نوعها في عالم الاسترخاء والجمال. نحن متخصصون في تقديم أفضل خدمات السبا والعناية بالجمال، مصممة خصيصاً لتمنحك لحظات من الهدوء والراحة.</p>
                    <p>نوفر مجموعة متنوعة من الخدمات تشمل العناية بالأظافر، الحمام المغربي، العناية بالشعر، الصبغات، والمساج بالأحجار الساخنة.</p>
                </div>
                <div class="about-image">
                    <img src="images/spa-room.jpg" alt="غرفة السبا">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2 class="section-title">خدماتنا المميزة</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-image">
                        <img src="images/service-nails.jpg" alt="أظافر تركيب">
                    </div>
                    <h3>أظافر تركيب</h3>
                    <p>خدمات مانيكير وبديكير احترافية مع تركيب أظافر فاخرة باستخدام أجود المنتجات العالمية.</p>
                    <div class="service-price">
                        <span class="old-price">200 ريال</span>
                        <span class="new-price">100 ريال</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image">
                        <img src="images/service-hammam.jpg" alt="حمام مغربي">
                    </div>
                    <h3>حمام مغربي</h3>
                    <p>تجربة تقليدية فاخرة للتنظيف العميق والاسترخاء في أجواء مغربية أصيلة.</p>
                    <div class="service-price">
                        <span class="old-price">300 ريال</span>
                        <span class="new-price">150 ريال</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image">
                        <img src="images/service-hair-wash.jpg" alt="غسيل شعر">
                    </div>
                    <h3>غسيل شعر</h3>
                    <p>غسيل وتنظيف عميق للشعر باستخدام منتجات طبيعية مع تدليك فروة الرأس المريح.</p>
                    <div class="service-price">
                        <span class="old-price">150 ريال</span>
                        <span class="new-price">75 ريال</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image">
                        <img src="images/service-hair-color.jpg" alt="صبغات">
                    </div>
                    <h3>صبغات</h3>
                    <p>صبغات شعر احترافية بأحدث التقنيات والألوان العصرية مع الحفاظ على صحة الشعر.</p>
                    <div class="service-price">
                        <span class="old-price">400 ريال</span>
                        <span class="new-price">200 ريال</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-image">
                        <img src="images/service-massage.jpg" alt="مساج بالأحجار">
                    </div>
                    <h3>مساج بالأحجار</h3>
                    <p>جلسات تدليك علاجية بالأحجار الساخنة لتخفيف التوتر وآلام العضلات.</p>
                    <div class="service-price">
                        <span class="old-price">350 ريال</span>
                        <span class="new-price">175 ريال</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">💎</div>
                    <h3>الباقات الخاصة</h3>
                    <p>باقات مخصصة تجمع بين عدة خدمات بأسعار مميزة.</p>
                    <div class="service-price">
                        <span class="old-price">800 ريال</span>
                        <span class="new-price">400 ريال</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products">
        <div class="container">
            <h2 class="section-title">منتجاتنا الفاخرة</h2>
            <p class="section-subtitle">مجموعة مختارة من أفضل منتجات العناية والجمال</p>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/spa_products_1.jpg" alt="منتجات السبا الفاخرة">
                        <div class="product-overlay">
                            <button class="product-btn">عرض التفاصيل</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>مجموعة الزيوت العطرية</h3>
                        <p>زيوت طبيعية 100% للاسترخاء والعناية</p>
                        <div class="product-price">
                            <span class="old-price">200 ريال</span>
                            <span class="new-price">100 ريال</span>
                        </div>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/spa_products_2.jpg" alt="منتجات العناية بالبشرة">
                        <div class="product-overlay">
                            <button class="product-btn">عرض التفاصيل</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>طقم العناية الكامل</h3>
                        <p>مجموعة متكاملة للعناية اليومية</p>
                        <div class="product-price">
                            <span class="old-price">300 ريال</span>
                            <span class="new-price">150 ريال</span>
                        </div>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/spa_products_3.jpg" alt="منتجات الاستحمام">
                        <div class="product-overlay">
                            <button class="product-btn">عرض التفاصيل</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>مجموعة الصابون الطبيعي</h3>
                        <p>صابون يدوي الصنع بمكونات عضوية</p>
                        <div class="product-price">
                            <span class="old-price">150 ريال</span>
                            <span class="new-price">75 ريال</span>
                        </div>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/spa_products_4.jpg" alt="أدوات السبا">
                        <div class="product-overlay">
                            <button class="product-btn">عرض التفاصيل</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>طقم الشموع المعطرة</h3>
                        <p>شموع فاخرة لأجواء استرخاء مثالية</p>
                        <div class="product-price">
                            <span class="old-price">180 ريال</span>
                            <span class="new-price">90 ريال</span>
                        </div>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/spa_products_5.jpg" alt="منتجات الاسترخاء">
                        <div class="product-overlay">
                            <button class="product-btn">عرض التفاصيل</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>مجموعة الأملاح العلاجية</h3>
                        <p>أملاح البحر الميت للاستحمام المريح</p>
                        <div class="product-price">
                            <span class="old-price">120 ريال</span>
                            <span class="new-price">60 ريال</span>
                        </div>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/spa_products_6.jpg" alt="منتجات التدليك">
                        <div class="product-overlay">
                            <button class="product-btn">عرض التفاصيل</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3>أحجار التدليك الساخنة</h3>
                        <p>مجموعة أحجار بازلت طبيعية</p>
                        <div class="product-price">
                            <span class="old-price">250 ريال</span>
                            <span class="new-price">125 ريال</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Offers Section -->
    <section id="offers" class="mystery-box">
        <div class="container">
            <div class="mystery-box-content">
                <div class="mystery-box-text">
                    <h2 class="section-title">العروض الخاصة</h2>
                    <p class="mystery-box-description">استمتع بعروضنا الحصرية! احصل على خصم 50% على جميع الخدمات لفترة محدودة. باقات متنوعة تجمع بين أفضل خدماتنا بأسعار لا تقاوم.</p>
                    <div class="mystery-box-features">
                        <div class="feature-item">
                            <span class="feature-icon">✨</span>
                            <span>خصم 50% على جميع الخدمات</span>
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">🎁</span>
                            <span>باقات حصرية مخصصة</span>
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">💝</span>
                            <span>منتجات فاخرة مجانية</span>
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">🌟</span>
                            <span>خدمة VIP متميزة</span>
                        </div>
                    </div>
                    <button class="cta-button">احجز الآن واستفد</button>
                </div>
                <div class="mystery-box-image">
                    <div class="box-animation">
                        <div class="box">
                            <div class="box-lid"></div>
                            <div class="box-body"></div>
                            <div class="box-ribbon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <div class="container">
            <h2 class="section-title">معرض الصور</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="images/hero-banner.jpg" alt="منتجات السبا">
                </div>
                <div class="gallery-item">
                    <img src="images/service-nails.jpg" alt="خدمات الأظافر">
                </div>
                <div class="gallery-item">
                    <img src="images/service-hammam.jpg" alt="الحمام المغربي">
                </div>
                <div class="gallery-item">
                    <img src="images/service-massage.jpg" alt="المساج بالأحجار">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">آراء عملائنا</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"تجربة رائعة! الخدمات احترافية جداً والأجواء هادئة ومريحة. أنصح الجميع بزيارة سبا."</p>
                    <p class="testimonial-author">- سارة أحمد</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"الحمام المغربي والمساج بالأحجار كانا رائعين. أفضل سبا جربته في حياتي!"</p>
                    <p class="testimonial-author">- نورة محمد</p>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                    <p class="testimonial-text">"المنتجات عالية الجودة والأسعار ممتازة خصوصاً مع العروض الحالية. شكراً سبا!"</p>
                    <p class="testimonial-author">- ليلى خالد</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title">تواصل معنا</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📱</span>
                        <div>
                            <h3>الهاتف</h3>
                            <p>+966 50 123 4567</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">✉️</span>
                        <div>
                            <h3>البريد الإلكتروني</h3>
                            <p>info@spa-ksa.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <div>
                            <h3>العنوان</h3>
                            <p>الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">⏰</span>
                        <div>
                            <h3>ساعات العمل</h3>
                            <p>السبت - الخميس: 9 صباحاً - 10 مساءً</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contactForm">
                        <div class="form-group">
                            <input type="text" placeholder="الاسم" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="البريد الإلكتروني" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" placeholder="رقم الهاتف" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="رسالتك" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="cta-button">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>سبا</h3>
                    <p>تجربة فريدة من الاسترخاء والجمال - نقدم أفضل خدمات السبا والعناية بالجمال</p>
                </div>
                <div class="footer-section">
                    <h3>روابط سريعة</h3>
                    <ul>
                        <li><a href="#home">الرئيسية</a></li>
                        <li><a href="#services">الخدمات</a></li>
                        <li><a href="#products">المنتجات</a></li>
                        <li><a href="#offers">العروض الخاصة</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>تابعنا</h3>
                    <div class="social-links">
                        <a href="#" class="social-link">📘</a>
                        <a href="#" class="social-link">📷</a>
                        <a href="#" class="social-link">🐦</a>
                        <a href="#" class="social-link">📱</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 سبا. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>

