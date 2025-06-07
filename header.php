<?php
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection Failed:" . $conn->connect_error);
}
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null; 
?>
<header class="header" id="header">
        <nav class="nav container">
            <div class="logo__container">
                <img src="img/BookQuest Plaza logo.png" class="logo">
            </div>
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="home.php" class="nav__link" >
                            <i class="ri-home-line">Home</i>    
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#contact" class="nav__link">
                            <i class="ri-group-line">Contact Us</i>    
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="home.php#featured" class="nav__link">
                            <i class="ri-book-3-line">Featured</i>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="search.php" class="nav__link">
                            <i class="ri-search-line">Search</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nav__actions">
                <!--LOGIN-->
                <a href="login.php"><i class="ri-user-line login-button" id="login-button"></i>
                <!--USER PROFILE-->
                <a href="user.php"><i class="ri-shield-user-line" id="user-profile"></i>
                <!--CART-->
                <?php
                $sql = "SELECT * FROM cart WHERE email = '$email'";
                $result = $conn->query($sql);
                if ($result) {
                    $cartitems = $result->num_rows; 
                } else {
                    $cartitems = 0;
                }
                ?>
                <a href="cart.php"><i class="ri-shopping-cart-2-line"></i><span>(<?php echo $cartitems; ?>)</span></a>
            </div>
        </nav>
    </header>
