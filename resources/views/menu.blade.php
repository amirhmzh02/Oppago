<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Navigation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/menu-style.css">
    <link rel="stylesheet" href="css/navbar.css">

    <style>
        /* Add any additional inline styles here if needed */
    </style>
</head>

<body>

    <div class="container">
        <nav id="oppa-navbar">
            <div class="nav-container">

                <div class="mobile-toggle" id="mobile-menu-btn">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>

                <ul class="nav-links left-side">
                    <li><a href="/home">HOME</a></li>
                    <li><a href="/menu">OUR MENU</a></li>
                </ul>

                <div class="nav-logo">
                    <a href="/home">
                        <img src="{{asset('image/logo.png')}}" alt="OppaGo Logo">
                    </a>
                </div>

                <ul class="nav-links right-side">
                    <li><a href="/review">REVIEW</a></li>

                    <li class="dropdown-item">
                        <a href="/order" class="dropbtn">ORDER ▾</a>
                        <div class="dropdown-content">
                            <a href="/order/pickup">Pickup</a>
                            <a href="/order/delivery">Delivery</a>
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
                <li><a href="/review">Review</a></li>
                <li class="sidebar-dropdown">
                    <span>Order ▾</span>
                    <ul class="sidebar-submenu">
                        <li><a href="/order/pickup">Pickup</a></li>
                        <li><a href="/order/delivery">Delivery</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <div class="container">
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-target="signature">
                        <img class="icon" src="image/menu-page/chicken-wings.png" alt="">
                        <span>SIGNATURE</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="rabokki">
                        <img class="icon" src="image/menu-page/noodles.png" alt="">
                        <span>RABOKKI</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="toppokki">
                        <img class="icon" src="image/menu-page/tteokbokki.png" alt="">
                        <span>TOPPOKKI</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="side-dish">
                        <img class="icon" src="image/menu-page/fries.png" alt="">
                        <span>SIDE DISH</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="drinks">
                        <img class="icon" src="image/menu-page/cooking.png" alt="">
                        <span>RICE</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Signature Menu Cards (Desktop) -->
        <div class="menu-container active" id="signature">
            <!-- <h2 class="menu-title">Signature Wings</h2> -->
            <div class="menu-grid">
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ayam/10pcs.png" alt="Classic Tteokbokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Mix 10 Pcs</h3>
                        <p class="menu-card-desc">Mix flavor of our signature wings, perfect for sharing with family and
                            friends.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ayam/kroean.png" alt="Classic Tteokbokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Korean Spicy Wings</h3>
                        <p class="menu-card-desc">Classic Korean-style spicy wings with our special gochujang glaze.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ayam/soygarlic.png" alt="Cheese Tteokbokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Soy Garlic Wings</h3>
                        <p class="menu-card-desc">Savory wings with sweet soy sauce and aromatic garlic flavor.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ayam/salted.png" alt="Cream Tteokbokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Salted Egg Wings</h3>
                        <p class="menu-card-desc">Crispy wings coated with rich salted egg yolk flavour, serve with
                            salted egg sauce</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ayam/creamy.png" alt="Cream Tteokbokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Creamy Cheese Wings</h3>
                        <p class="menu-card-desc">Crispy wings coated with our special creamy cheese powder, serve with
                            salted egg sauce</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ayam/buttermilk.png" alt="Cream Tteokbokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Buttermilk Wings</h3>
                        <p class="menu-card-desc">Creamy, juicy buttermilk wings with a mild and delicious flavor.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Signature Carousel (Mobile) -->
        <div class="mobile-carousel-container active" id="signature-mobile">
            <!-- <h2 class="mobile-carousel-title">Signature Wings</h2> -->
            <div class="mobile-carousel">
                <div class="mobile-carousel-track" id="signature-track">
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ayam/10pcs.png" alt="Mix 10 Pcs">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Mix 10 Pcs</h3>
                                <p class="mobile-card-desc">Mix flavor of our signature wings, perfect for sharing with
                                    family and friends.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ayam/kroean.png" alt="Korean Spicy Wings">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Korean Spicy Wings</h3>
                                <p class="mobile-card-desc">Classic Korean-style spicy wings with our special gochujang
                                    glaze.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ayam/soygarlic.png" alt="Soy Garlic Wings">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Soy Garlic Wings</h3>
                                <p class="mobile-card-desc">Savory wings with sweet soy sauce and aromatic garlic
                                    flavor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ayam/salted.png" alt="Salted Egg Wings">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Salted Egg Wings</h3>
                                <p class="mobile-card-desc">Crispy wings coated with rich salted egg yolk flavour, serve
                                    with salted egg sauce</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ayam/creamy.png" alt="Creamy Cheese Wings">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Creamy Cheese Wings</h3>
                                <p class="mobile-card-desc">Crispy wings coated with our special creamy cheese powder,
                                    serve with salted egg sauce</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ayam/buttermilk.png"
                                alt="Buttermilk Wings">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Buttermilk Wings</h3>
                                <p class="mobile-card-desc">Creamy, juicy buttermilk wings with a mild and delicious
                                    flavor.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-carousel-indicators" id="signature-indicators">
                <!-- Indicators will be generated by JavaScript -->
            </div>
            <div class="mobile-carousel-controls">
                <button class="mobile-prev-btn" data-target="signature">Previous</button>
                <button class="mobile-next-btn" data-target="signature">Next</button>
            </div>
        </div>

        <!-- Rabokki Menu Cards (Desktop) -->
        <div class="menu-container" id="rabokki">
            <!-- <h2 class="menu-title">Rabokki Specials</h2> -->
            <div class="menu-grid">
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ramen/spicy.png" alt="Classic Rabokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Original Spicy Rabokki</h3>
                        <p class="menu-card-desc">Classic spicy ramen combined with our signature sauce, loaded with
                            chewy tteokbokki rice cakes.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ramen/carbonara.png" alt="Seafood Rabokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Salted Carbonara Rabokki</h3>
                        <p class="menu-card-desc">Creamy carbonara ramen with our special twist, featuring tteokbokki
                            rice cakes in a rich, savory sauce.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ramen/quartro.png" alt="Seafood Rabokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Quatro Cheese Rabokki</h3>
                        <p class="menu-card-desc">quatro cheese ramen blended with our signature recipe, mixed with
                            tteokbokki rice cakes.</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/ramen/jajamyon.png" alt="Seafood Rabokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">jjangmyeon Soy Rabokki</h3>
                        <p class="menu-card-desc">Savory jajangmyeon ramen with our unique soy garlic sauce, mixed with
                            tteokbokki rice cakes.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rabokki Carousel (Mobile) -->
        <div class="mobile-carousel-container" id="rabokki-mobile">
            <!-- <h2 class="mobile-carousel-title">Rabokki Specials</h2> -->
            <div class="mobile-carousel">
                <div class="mobile-carousel-track" id="rabokki-track">
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ramen/spicy.png"
                                alt="Original Spicy Rabokki">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Original Spicy Rabokki</h3>
                                <p class="mobile-card-desc">Classic spicy ramen combined with our signature sauce,
                                    loaded with chewy tteokbokki rice cakes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ramen/carbonara.png"
                                alt="Salted Carbonara Rabokki">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Salted Carbonara Rabokki</h3>
                                <p class="mobile-card-desc">Creamy carbonara ramen with our special twist, featuring
                                    tteokbokki rice cakes in a rich, savory sauce.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ramen/quartro.png"
                                alt="Quatro Cheese Rabokki">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Quatro Cheese Rabokki</h3>
                                <p class="mobile-card-desc">Quatro cheese ramen blended with our signature recipe, mixed
                                    with tteokbokki rice cakes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/ramen/jajamyon.png"
                                alt="Jjangmyeon Soy Rabokki">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Jjangmyeon Soy Rabokki</h3>
                                <p class="mobile-card-desc">Savory jajangmyeon ramen with our unique soy garlic sauce,
                                    mixed with tteokbokki rice cakes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-carousel-indicators" id="rabokki-indicators">
                <!-- Indicators will be generated by JavaScript -->
            </div>
            <div class="mobile-carousel-controls">
                <button class="mobile-prev-btn" data-target="rabokki">Previous</button>
                <button class="mobile-next-btn" data-target="rabokki">Next</button>
            </div>
        </div>

        <!-- Toppokki Menu Cards (Desktop) -->
        <div class="menu-container" id="toppokki">
            <!-- <h2 class="menu-title">Toppokki Selection</h2> -->
            <div class="menu-grid">
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/toppoki/toppoki.png" alt="Jumbo Toppokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Sweet Spicy Topokki</h3>
                        <p class="menu-card-desc">Chewy rice cake in sweet & spicy homemade souce with soft egg ,savory
                            fish cake, cruncy domuji and seaweed sesame on top</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/toppoki/fried-toppoki.png" alt="Jumbo Toppokki">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Cheezy Fried Topokki</h3>
                        <p class="menu-card-desc">Cripy rice cake with juicy cocktail sausage couted with out signature
                            souce. tapped with melted cheese slice and seaweed</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toppokki Carousel (Mobile) -->
        <div class="mobile-carousel-container" id="toppokki-mobile">
            <!-- <h2 class="mobile-carousel-title">Toppokki Selection</h2> -->
            <div class="mobile-carousel">
                <div class="mobile-carousel-track" id="toppokki-track">
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/toppoki/toppoki.png" alt="Jumbo Toppokki">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Sweet Spicy Topokki</h3>
                                <p class="mobile-card-desc">Chewy rice cake in sweet & spicy homemade souce with soft
                                    egg ,savory fish cake, cruncy domuji and seaweed sesame on top</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/toppoki/fried-toppoki.png"
                                alt="Jumbo Toppokki">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Cheezy Fried Topokki</h3>
                                <p class="mobile-card-desc">Cripy rice cake with juicy cocktail sausage couted with out
                                    signature souce. tapped with melted cheese slice and seaweed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-carousel-indicators" id="toppokki-indicators">
                <!-- Indicators will be generated by JavaScript -->
            </div>
            <div class="mobile-carousel-controls">
                <button class="mobile-prev-btn" data-target="toppokki">Previous</button>
                <button class="mobile-next-btn" data-target="toppokki">Next</button>
            </div>
        </div>

        <!-- Side Dish Menu Cards (Desktop) -->
        <div class="menu-container" id="side-dish">
            <!-- <h2 class="menu-title">Fries</h2> -->
            <div class="menu-grid">
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/fries/fries.png" alt="Korean Fried Chicken">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Original Fries</h3>
                        <p class="menu-card-desc">Crispy golden fries</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/fries/bulgogi-fries.png" alt="Kimchi Pancake">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Loaded Bulgogi Beef Fries</h3>
                        <p class="menu-card-desc">Crispy fries topped with savory bulgogi beef and our mayonnaise sauce
                        </p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/fries/buttermilk-fries.png" alt="Kimchi Pancake">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Loaded Buttermilk Fries</h3>
                        <p class="menu-card-desc">Golden fries loaded with creamy buttermilk sauce</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/gimari.png" alt="Kimchi Pancake">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Chicken Bulgogi Gimmari</h3>
                        <p class="menu-card-desc">Cripy seaweed rolls stuffed with juicy chicken bulgogi and glass
                            noddle</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Dish Carousel (Mobile) -->
        <div class="mobile-carousel-container" id="side-dish-mobile">
            <!-- <h2 class="mobile-carousel-title">Fries</h2> -->
            <div class="mobile-carousel">
                <div class="mobile-carousel-track" id="side-dish-track">
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/fries/fries.png" alt="Original Fries">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Original Fries</h3>
                                <p class="mobile-card-desc">Crispy golden fries</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/fries/bulgogi-fries.png"
                                alt="Loaded Bulgogi Beef Fries">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Loaded Bulgogi Beef Fries</h3>
                                <p class="mobile-card-desc">Crispy fries topped with savory bulgogi beef and our
                                    mayonnaise sauce</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/fries/buttermilk-fries.png"
                                alt="Loaded Buttermilk Fries">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Loaded Buttermilk Fries</h3>
                                <p class="mobile-card-desc">Golden fries loaded with creamy buttermilk sauce</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/gimari.png" alt="Chicken Bulgogi Gimmari">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Chicken Bulgogi Gimmari</h3>
                                <p class="mobile-card-desc">Cripy seaweed rolls stuffed with juicy chicken bulgogi and
                                    glass noddle</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-carousel-indicators" id="side-dish-indicators">
                <!-- Indicators will be generated by JavaScript -->
            </div>
            <div class="mobile-carousel-controls">
                <button class="mobile-prev-btn" data-target="side-dish">Previous</button>
                <button class="mobile-next-btn" data-target="side-dish">Next</button>
            </div>
        </div>

        <!-- Drinks Menu Cards (Desktop) -->
        <div class="menu-container" id="drinks">
            <!-- <h2 class="menu-title">Rice</h2> -->
            <div class="menu-grid">
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/rice/seaweed-rice.png" alt="Seaweed Rice">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Seaweed Rice</h3>
                        <p class="menu-card-desc">Steamed rice mixed with seasoned seaweed and sesame oil</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/rice/buttermilk-rice.png"
                        alt="Buttermilk Chicken Rice">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Buttermilk Chicken Rice</h3>
                        <p class="menu-card-desc">Steamed rice served with our signature buttermilk chicken</p>
                    </div>
                </div>
                <div class="menu-card">
                    <img class="menu-card-img" src="image/menu-img/rice/bulgogi-rice.png" alt="Bulgogi Beef Rice">
                    <div class="menu-card-content">
                        <h3 class="menu-card-title">Bulgogi Beef Rice</h3>
                        <p class="menu-card-desc">Steamed rice topped with savory marinated bulgogi beef</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Drinks Carousel (Mobile) -->
        <div class="mobile-carousel-container" id="drinks-mobile">
            <!-- <h2 class="mobile-carousel-title">Rice</h2> -->
            <div class="mobile-carousel">
                <div class="mobile-carousel-track" id="drinks-track">
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/rice/seaweed-rice.png" alt="Seaweed Rice">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Seaweed Rice</h3>
                                <p class="mobile-card-desc">Steamed rice mixed with seasoned seaweed and sesame oil</p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/rice/buttermilk-rice.png"
                                alt="Buttermilk Chicken Rice">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Buttermilk Chicken Rice</h3>
                                <p class="mobile-card-desc">Steamed rice served with our signature buttermilk chicken
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-carousel-card">
                        <div class="mobile-card">
                            <img class="mobile-card-img" src="image/menu-img/rice/bulgogi-rice.png"
                                alt="Bulgogi Beef Rice">
                            <div class="mobile-card-content">
                                <h3 class="mobile-card-title">Bulgogi Beef Rice</h3>
                                <p class="mobile-card-desc">Steamed rice topped with savory marinated bulgogi beef</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-carousel-indicators" id="drinks-indicators">
                <!-- Indicators will be generated by JavaScript -->
            </div>
            <div class="mobile-carousel-controls">
                <button class="mobile-prev-btn" data-target="drinks">Previous</button>
                <button class="mobile-next-btn" data-target="drinks">Next</button>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            // --- Get all required elements ---
            const navbar = document.getElementById('oppa-navbar');
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('oppa-mobile-sidebar');
            const closeBtn = document.getElementById('close-sidebar');

            // Populate global element lists (Crucial fix for element selector failure)
           


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

        });
        // Function to get URL parameters
        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Function to show specific menu section
        function showMenuSection(sectionId) {
            // Remove active class from all links and containers
            document.querySelectorAll('.nav-link').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelectorAll('.menu-container').forEach(container => {
                container.classList.remove('active');
            });
            document.querySelectorAll('.mobile-carousel-container').forEach(container => {
                container.classList.remove('active');
            });

            // Add active class to the corresponding nav link
            const targetLink = document.querySelector(`.nav-link[data-target="${sectionId}"]`);
            if (targetLink) {
                targetLink.classList.add('active');
            }

            // Show corresponding menu container and carousel
            document.getElementById(sectionId).classList.add('active');
            document.getElementById(sectionId + '-mobile').classList.add('active');

            // Reset all carousels to first slide
            resetAllCarousels();
        }

        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('data-target');
                showMenuSection(targetId);
            });
        });

        // Carousel functionality
        const carousels = {};

        function initializeCarousels() {
            const carouselContainers = document.querySelectorAll('.mobile-carousel-container');

            carouselContainers.forEach(container => {
                const targetId = container.id.replace('-mobile', '');
                const track = container.querySelector('.mobile-carousel-track');
                const cards = container.querySelectorAll('.mobile-carousel-card');
                const indicatorsContainer = container.querySelector('.mobile-carousel-indicators');

                // Create indicators
                indicatorsContainer.innerHTML = '';
                for (let i = 0; i < cards.length; i++) {
                    const indicator = document.createElement('div');
                    indicator.className = 'mobile-carousel-indicator';
                    if (i === 0) indicator.classList.add('active');
                    indicator.addEventListener('click', () => {
                        goToSlide(targetId, i);
                    });
                    indicatorsContainer.appendChild(indicator);
                }

                // Initialize carousel state
                carousels[targetId] = {
                    currentIndex: 0,
                    track: track,
                    cards: cards,
                    indicators: indicatorsContainer.querySelectorAll('.mobile-carousel-indicator')
                };
            });
        }

        function goToSlide(targetId, index) {
            const carousel = carousels[targetId];
            if (!carousel) return;

            carousel.currentIndex = index;
            carousel.track.style.transform = `translateX(-${index * 100}%)`;

            // Update indicators
            carousel.indicators.forEach((indicator, i) => {
                if (i === index) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        function nextSlide(targetId) {
            const carousel = carousels[targetId];
            if (!carousel) return;

            let nextIndex = carousel.currentIndex + 1;
            if (nextIndex >= carousel.cards.length) {
                nextIndex = 0;
            }
            goToSlide(targetId, nextIndex);
        }

        function prevSlide(targetId) {
            const carousel = carousels[targetId];
            if (!carousel) return;

            let prevIndex = carousel.currentIndex - 1;
            if (prevIndex < 0) {
                prevIndex = carousel.cards.length - 1;
            }
            goToSlide(targetId, prevIndex);
        }

        function resetAllCarousels() {
            Object.keys(carousels).forEach(targetId => {
                goToSlide(targetId, 0);
            });
        }

        // Add event listeners for carousel controls
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('mobile-next-btn')) {
                const targetId = e.target.getAttribute('data-target');
                nextSlide(targetId);
            } else if (e.target.classList.contains('mobile-prev-btn')) {
                const targetId = e.target.getAttribute('data-target');
                prevSlide(targetId);
            }
        });

        // Touch swipe functionality for mobile
        document.querySelectorAll('.mobile-carousel').forEach(carousel => {
            let startX = 0;
            let endX = 0;

            carousel.addEventListener('touchstart', function (e) {
                startX = e.touches[0].clientX;
            });

            carousel.addEventListener('touchend', function (e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe(startX, endX, carousel);
            });
        });

        function handleSwipe(startX, endX, carousel) {
            const container = carousel.closest('.mobile-carousel-container');
            const targetId = container.id.replace('-mobile', '');

            if (startX > endX + 50) {
                // Swipe left - next slide
                nextSlide(targetId);
            } else if (startX < endX - 50) {
                // Swipe right - previous slide
                prevSlide(targetId);
            }
        }

        // Initialize carousels and check for URL parameter when page loads
        document.addEventListener('DOMContentLoaded', function () {
            initializeCarousels();

            // Check for ID parameter in URL
            const menuId = getUrlParameter('id');
            if (menuId) {
                // Map the incoming IDs to your section IDs
                const idMapping = {
                    'chicken-wings': 'signature',
                    'fries': 'side-dish',
                    'tteokbokki': 'toppokki',
                    'bulgogi': 'rabokki', // Assuming bulgogi is in rabokki section
                    'rabokki': 'rabokki',
                    'rice': 'drinks'
                };

                const targetSection = idMapping[menuId];
                if (targetSection) {
                    showMenuSection(targetSection);
                }
            }
        });
    </script>
</body>

</html>