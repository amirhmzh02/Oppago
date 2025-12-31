<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OppaGo Navigation</title>
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/hero.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('css/order.css')}}">
    <link rel="stylesheet" href="{{asset('css/contact.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;800&display=swap" rel="stylesheet">
</head>

<body style="height: 200vh; background-color: #151515; margin: 0;">
    <nav id="oppa-navbar">
        <div class="nav-container">

            <div class="mobile-toggle" id="mobile-menu-btn">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <ul class="nav-links left-side">
                <li><a href="/">HOME</a></li>
                <li><a href="/menu">OUR MENU</a></li>
            </ul>

            <div class="nav-logo">
                <a href="/home">
                    <img src="{{asset('storage/image/logo.png')}}" alt="OppaGo Logo">
                </a>
            </div>

            <ul class="nav-links right-side">
                <li><a href="#review">REVIEW</a></li>

                <li class="dropdown-item">
                    <a href="" class="dropbtn">ORDER ▾</a>
                    <div class="dropdown-content">
                        <a href="https://easyeat.ai/r/spicylit-cafe/3">Pickup</a>
                        <a href="https://easyeat.ai/r/spicylit-cafe/2?page=2">Delivery</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div id="oppa-mobile-sidebar">
        <button id="close-sidebar">&times;</button>
        <div class="sidebar-logo">
            <h2>OppaGo</h2>
        </div>
        <ul class="sidebar-links">
            <li><a href="/">Home</a></li>
            <li><a href="/menu">Our Menu</a></li>
            <li><a href="#review">Review</a></li>
            <li class="sidebar-dropdown">
                <span>Order ▾</span>
                <ul class="sidebar-submenu">
                    <li><a href="https://easyeat.ai/r/spicylit-cafe/3">Pickup</a></li>
                    <li><a href="https://easyeat.ai/r/spicylit-cafe/2?page=2">Delivery</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- home view that have slideshow -->
    <section id="oppa-hero">
        <div class="hero-container">

            <div class="hero-text">
                <h1 class="hero-title">SIGNATURE <br><span class="highlight">WINGS</span></h1>
                <p class="hero-subtitle">
                    Korean food with Malaysian taste.<br>
                    Rich flavor in every bite.
                </p>
                <div class="hero-buttons">
                    <a href="https://easyeat.ai/r/spicylit-cafe/3" class="btn-primary">Order Online</a>
                    <a href="/menu" class="btn-secondary">View Menu</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="slideshow-container">
                    <div class="slide fade active">
                        <img src="{{ asset('storage/image/menu-img/ayam/10pcs.png') }}" alt="Signature Wings">
                    </div>
                    <div class="slide fade">
                        <img src="{{ asset('storage/image/menu-img/ayam/soygarlic.png') }}" alt="Soy Garlic">
                    </div>
                    <div class="slide fade">
                        <img src="{{ asset('storage/image/menu-img/ayam/buttermilk.png') }}" alt="Mixed Platter">
                    </div>
                </div>

                <div class="slide-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>

        </div>
    </section>

    <!--  our menu -->

    <section id="oppa-menu">
        <div class="menu-container">
            <p class="menu-pretitle">HUNGRY?</p>
            <h2 class="menu-title">OUR MENU</h2>
            <div class="title-underline"></div>
            <div class="menu-carousel-wrapper">
                <button class="nav-arrow prev-btn" style="color: white;" aria-label="Previous Menu Item"
                    onclick="moveCarousel(-1)">
                    ← <!-- Left arrow -->
                </button>
                <div class="carousel-items-container">
                    <div class="menu-item active-center" data-index="0">
                        <img src="{{ asset('storage/image/menu-img/ayam/10pcs.png') }}" alt="Menu Item 1">
                    </div>
                    <div class="menu-item active-right" data-index="1">
                        <img src="{{ asset('storage/image/menu-img/ayam/soygarlic.png') }}" alt="Menu Item 2">
                    </div>
                    <div class="menu-item hidden" data-index="2">
                        <img src="{{ asset('storage/image/menu-img/ayam/buttermilk.png') }}" alt="Menu Item 3">
                    </div>
                    <div class="menu-item hidden" data-index="3">
                        <img src="{{ asset('storage/image/menu-img/ayam/10pcs.png') }}" alt="Menu Item 4">
                    </div>
                    <div class="menu-item hidden" data-index="4">
                        <img src="{{ asset('storage/image/menu-img/ayam/10pcs.png') }}" alt="Menu Item 5">
                    </div>
                </div>

                <button class="nav-arrow next-btn" style="color: white;" aria-label="Next Menu Item"
                    onclick="moveCarousel(1)">
                    → <!-- Right arrow -->
                </button>
            </div>
            <a href="/menu" class="btn-see-more">See More</a>
        </div>
    </section>

    <!-- Delivery Section -->
    <section id="oppa-order">
        <div class="order-container">
            <!-- Decorative circles -->
            <div class="decorative-circle circle-1"></div>
            <div class="decorative-circle circle-2"></div>

            <div class="order-text">
                <span class="order-badge">DON'T WANT TO LEAVE YOUR COUCH?</span>
                <h2 class="order-title">WE DELIVER THE <span class="highlight-yellow">FLAVOR</span></h2>
                <p class="order-subtitle">
                    Get your favorite meals delivered hot and fresh to your
                    doorstep, or order ahead for quick pickup.
                </p>
            </div>

            <div class="order-cards">
                <!-- Delivery Card -->
                <div class="order-card glass-effect">
                    <div class="card-icon">
                        <i class="fas fa-motorcycle" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="card-title">DELIVERY</h3>
                    <p class="card-subtitle">Order ready in 15 min</p>
                    <a href="https://easyeat.ai/r/spicylit-cafe/2" class="card-btn primary">Order Delivery</a>
                    <a href="/menu" class="card-btn secondary">View Menu</a>
                </div>

                <!-- Pickup Card -->
                <div class="order-card glass-effect">
                    <div class="card-icon">
                        <i class="fas fa-hand-holding" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="card-title">PICKUP</h3>
                    <p class="card-subtitle">Order ready in 15 min</p>
                    <a href="https://easyeat.ai/r/spicylit-cafe/3" class="card-btn primary">Order Pickup</a>
                    <a href="/menu" class="card-btn secondary">View Menu</a>
                </div>
            </div>


        </div>
        <div style=" display: flex; justify-content: center; align-items: center; padding: 20px;" id="review">
            <script src="https://elfsightcdn.com/platform.js" async></script>
            <div class="elfsight-app-b28e361e-81ce-4941-b9d3-81c2f267756f" data-elfsight-app-lazy></div>
        </div>
    </section>

    <!-- Find Us / Location Section -->
    <!-- Add this inside the .map-container div, after the .iframe-wrapper -->
    <section id="oppa-find-us">
        <div class="container">
            <div class="content-wrapper">
                <div class="left-content">
                    <div class="image-section">
                        <h2 class="section-title">FIND US</h2>
                        <!-- <p class="section-subtitle">VISIT US AT OPPAGO</p> -->
                    </div>

                    <div class="black-section">
                        <div class="info-item">
                            <div class="icon-wrapper">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <h3>Location</h3>
                                <p>D'Anjung Avenue,Seksyen 7, 40000 Shah Alam, Selangor</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="icon-wrapper">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h3>Opening Hours</h3>
                                <p>Tue–Sun: 4:00 PM – 11:00 PM</p>
                                <p>Close on Monday</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-content">
                    <div class="map-container">
                        <div class="iframe-wrapper">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.0672936763267!2d101.49365987497089!3d3.0767055968989756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc5353a49d7bb3%3A0x9fff25190caf8e67!2sOppaGo%20Chicken%20Wings%20%26%20Topokki%20Shah%20Alam!5e0!3m2!1sen!2smy!4v1765210142872!5m2!1sen!2smy"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <!-- Add this button after the iframe -->
                        <a href="https://maps.google.com/?q=OppaGo+Chicken+Wings+%26+Topokki+Shah+Alam,+D'Anjung+Avenue,Seksyen+7,+40000+Shah+Alam,+Selangor"
                            target="_blank" class="directions-btn">
                            <i class="fas fa-directions"></i>
                            <span>Get Directions</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add this after the closing </section> tag of your oppa-find-us section -->
    <footer id="oppago-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="{{asset('storage/image/logo.png')}}" alt="OppaGo Logo">
                        <p class="tagline">Chicken Wings & Topokki</p>
                    </div>
                    <p class="footer-description">Delicious Korean-inspired chicken wings and topokki in Shah Alam.
                        Authentic flavors at your fingertips.</p>

                    <div class="social-buttons">
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-btn tiktok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#oppa-hero"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="/menu"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="#review"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#oppa-find-us"><i class="fas fa-chevron-right"></i> Find Us</a></li>
                        <li><a href="#oppa-find-us"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-heading">Contact Info</h3>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>D'Anjung Avenue, Seksyen 7,<br>40000 Shah Alam, Selangor</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+60 11-1234 5678</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>oppago@gmail.com</span>
                        </li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-heading">Opening Hours</h3>
                    <ul class="opening-hours">
                        <li>
                            <span class="day">Tuesday - Sunday</span>
                            <span class="time">4:00 PM – 11:00 PM</span>
                        </li>
                        <li>
                            <span class="day">Monday</span>
                            <span class="time closed">Closed</span>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </footer>

    <!-- <script src="script.js"></script> -->

    <script>
        // --- HERO SLIDESHOW VARIABLES ---
        let heroSlideshowInterval;
        let slideIndex = 0;
        let heroSlides; // Populated in DOMContentLoaded
        let heroDots;   // Populated in DOMContentLoaded

        /**
         * Handles the auto-play and display of the Hero Slideshow.
         * Called automatically and on manual dot clicks.
         */
        function showSlides() {
            if (!heroSlides || heroSlides.length === 0) return;

            // Hide all slides
            for (let i = 0; i < heroSlides.length; i++) {
                heroSlides[i].style.display = "none";
                heroSlides[i].classList.remove("active");
            }

            slideIndex++;
            if (slideIndex > heroSlides.length) { slideIndex = 1 }

            // Reset dots
            for (let i = 0; i < heroDots.length; i++) {
                heroDots[i].className = heroDots[i].className.replace(" active", "");
            }

            // Show current slide
            heroSlides[slideIndex - 1].style.display = "block";
            heroSlides[slideIndex - 1].classList.add("active");
            heroDots[slideIndex - 1].className += " active";

            // Restart interval
            clearTimeout(heroSlideshowInterval);
            heroSlideshowInterval = setTimeout(showSlides, 4000);
        }

        /**
         * Allows manual navigation using the dots.
         * @param {number} n - The slide index (1-based).
         */
        window.currentSlide = function (n) {
            slideIndex = n - 1; // Set index to n-1, then showSlides will increment it to n
            showSlides();
        }

        // --- MENU CAROUSEL VARIABLES ---
        let menuItems; // Populated in DOMContentLoaded
        let menuIndex = 0;

        /**
         * Updates the CSS classes for the asymmetric menu carousel display.
         */
        function updateCarouselClasses() {
            if (!menuItems || menuItems.length === 0) return;

            menuItems.forEach((item, index) => {
                item.classList.remove('active-left', 'active-center', 'active-right', 'hidden');

                // Calculate the position relative to the current center item (menuIndex)
                const relativeIndex = (index - menuIndex + menuItems.length) % menuItems.length;

                if (relativeIndex === 0) {
                    // Center item
                    item.classList.add('active-center');
                } else if (relativeIndex === menuItems.length - 1) {
                    // Item immediately left of center (wraps around from the end)
                    item.classList.add('active-left');
                } else if (relativeIndex === 1) {
                    // Item immediately right of center
                    item.classList.add('active-right');
                } else {
                    // All other items are hidden off-screen
                    item.classList.add('hidden');
                }
            });
        }

        /**
         * Moves the menu carousel one step left (-1) or right (1).
         * @param {number} step - -1 for previous, 1 for next.
         */
        window.moveCarousel = function (step) {
            menuIndex = (menuIndex + step + menuItems.length) % menuItems.length;
            updateCarouselClasses();
        }

        // --- CONSOLIDATED DOM CONTENT LOADED (Initialization) ---
        document.addEventListener('DOMContentLoaded', () => {
            // --- Get all required elements ---
            const navbar = document.getElementById('oppa-navbar');
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('oppa-mobile-sidebar');
            const closeBtn = document.getElementById('close-sidebar');

            // Populate global element lists (Crucial fix for element selector failure)
            heroSlides = document.querySelectorAll("#oppa-hero .slide");
            heroDots = document.querySelectorAll("#oppa-hero .dot");
            menuItems = document.querySelectorAll('#oppa-menu .menu-item');


            // 1. Navbar Scroll Effect
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // 2. Mobile Sidebar Toggle
            mobileBtn.addEventListener('click', () => {
                sidebar.classList.add('active');
            });
            closeBtn.addEventListener('click', () => {
                sidebar.classList.remove('active');
            });
            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && !mobileBtn.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });

            // --- 3. Initialize Slideshows and Carousels ---
            // Only run initialization if elements were found
            if (heroSlides.length > 0) {
                showSlides();
            }
            if (menuItems.length > 0) {
                updateCarouselClasses();
            }
        });
    </script>
</body>

</html>