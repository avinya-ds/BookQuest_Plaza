<?php
session_start();
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--BOOTSTRAP-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" referrerpolicy="n0-referrer">
      <!--REMIXICONS-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
      <!--SWIPER CSS-->
      <link rel="stylesheet" href="css/swiper-bundle.min.css">
      <!--CSS-->
      <link rel="stylesheet" href="css/styles.css">
      <title>Home Page</title>
    </head>
    <body>
        <!--HEADER-->
        <?php include 'header.php'; ?>
        <!--LOGIN-->
        <main class="main">
        <!--HOME-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__title">
                        Discover And Shop
                    </h1>
                    <p class="home__description">
                        Uncover Literary Gems:
                        Browse, Buy, and Immerse Yourself in the World of Books at BookQuest Plaza.  
                    </p>
                    <a href="#featured" class="button">Explore Now</a>
                </div>
                <div class="home__images">
                    <div class="home__swiper swiper">
                        <div class="swiper-wrapper">
                            <div class="home__simg swiper-slide">
                                <img src="img/Scarred_ Emily McIntire.jpg" alt="image" class="home__img">
                            </div>

                            <div class="home__simg swiper-slide">
                                <img src="img/Forever Never_ Lucy Score.webp" alt="image" class="home__img">
                            </div>
                            
                            <div class="home__simg swiper-slide">
                                <img src="img/Ivory And Bone_ Julie Eshbaugh.jpg" alt="image" class="home__img">
                            </div>
                            
                            <div class="home__simg swiper-slide">
                                <img src="img/Twisted Lies_ Ana Huang.jpg" alt="image" class="home__img">
                            </div>
                            <div class="home__simg swiper-slide">
                                <img src="img/The Discovered_ Maggie Sunseri.jpeg" alt="image" class="home__img">
                            </div>
                            <div class="home__simg swiper-slide">
                                <img src="img/Things we never got over_ Lucy Score.webp" alt="image" class="home__img">
                            </div>
                            <div class="home__simg swiper-slide">
                                <img src="img/A Ballad of Hate and Hope_ Kaylea Prime.jpg" alt="image" class="home__img">
                            </div>
                            <div class="home__simg swiper-slide">
                                <img src="img/It Ends with Us_ Colleen Hoover.webp" alt="image" class="home__img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
         </section>
         <!--SERVICES-->
         <section class="services section">
            <div class="services__container container grid">
                <div class="services__card">
                    <i class="ri-truck-line"></i>
                    <h3 class="services__title">Free Shipping</h3>
                    <p>Order Over ₹1000</p>
                </div>
                <div class="services__card">
                    <i class="ri-lock-2-line"></i>
                    <h3 class="services__title">Secure</h3>
                    <p>100% Secure</p>
                </div>
                <div class="services__card">
                    <i class="ri-customer-service-2-line"></i>
                    <h3 class="services__title">Support</h3>
                    <p>Call Us Anytime</p>
                </div>
            </div>
         </section>
         <!--FEATURED-->
         <section class="featured section" id="featured">
            <h2 class="featured__title">Featured Books</h2>
            <div class="featured__swiper swiper">
                <div class="swiper-wrapper">
                    <a href="search.php" class="featured__card swiper-slide">
                        <img src="img/Divergent_ Veronica Roth.webp" alt="image" class="featured__img">
                        <div class="featured__prices">
                            <span class="featured__discount">₹1,100.00</span>
                            <span class="featured__price">₹1,538.00</span>
                        </div>
                    </a>
                    <a href="search.php" class="featured__card swiper-slide">
                        <img src="img/A Thousand Pieces of You- Claudia Gray.webp" alt="image" class="featured__img">
                        <div class="featured__prices">
                            <span class="featured__discount">₹706.00</span>
                            <span class="featured__price">₹1,050.69</span>
                        </div>
                    </a>
                    <a href="search.php" class="featured__card swiper-slide">
                        <img src="img/King of Sloth_ Ana Huang.jpg" alt="image" class="featured__img">
                        <div class="featured__prices">
                            <span class="featured__discount">₹1,545.00</span>
                            <span class="featured__price">$2,318.90</span>
                        </div>
                    </a>
                    <a href="search.php" class="featured__card swiper-slide">
                        <img src="img/The Whisperers of Evernow_ Heidi Catherine.jpeg" alt="image" class="featured__img">
                        <div class="featured__prices">
                            <span class="featured__discount">₹1,538.00</span>
                            <span class="featured__price">₹1,538.00</span>
                        </div>
                    </a>
                    <a href="search.php" class="featured__card swiper-slide">
                        <img src="img/Expiration Dates_ Rebecca Serle.jpg" alt="image" class="featured__img">
                        <div class="featured__prices">
                            <span class="featured__discount">₹1,500.00</span>
                            <span class="featured__price">₹1,868.10</span>
                        </div>
                    </a>
                    <a href="search.php" class="featured__card swiper-slide">
                        <img src="img/The Guest_ A Novel_Book by B.A. Paris.jpg" alt="image" class="featured__img">
                        <div class="featured__prices">
                            <span class="featured__discount">₹1,099.00</span>
                            <span class="featured__price">₹2,418.04</span>
                        </div>
                    </a>
                </div>
                <div class="swiper-button-prev">
                    <i class="ri-arrow-left-s-line"></i>
                </div>
                <div class="swiper-button-next">
                   <i class="ri-arrow-right-s-line"></i>
                </div>
            </div>
        </section>
    </main>
    <!--FOOTER-->
    <?php include 'footer.php'; ?>  
    <!--SWIPER JS-->
    <script src="js/swiper-bundle.min.js"></script>
    <!--MAIN JS-->
    <script src="js/main.js"></script>
    </body>
</html>