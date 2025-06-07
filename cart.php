<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'book');    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_SESSION['email'];
if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location:login.php');
    exit();
}
if(isset($_POST['update'])){
    $bkcode = $_POST['bkcode'];
    $bkqty = $_POST['bkqty'];
    $sql ="UPDATE cart SET qty = '$bkqty' WHERE code = '$bkcode'" or die('query failed');
    if($conn->query($sql)===TRUE){
    echo ("<script language='javascript'>
    window.alert('Cart Quantity Updated!')
    window.location.href='cart.php'
    </script>");
    exit();
   }
}
if(isset($_GET['delete'])){
    $delete_code = $_GET['delete'];
    $sql ="DELETE FROM cart WHERE code = '$delete_code'" or die('query failed');
    if($conn->query($sql)===TRUE){
    echo ("<script language='javascript'>
    window.alert('Book Removed From Cart!')
    window.location.href='cart.php'
    </script>");
    exit();
   }
}
if(isset($_GET['delete_all'])){
    $sql = "DELETE FROM cart WHERE email = '$email'" or die('query failed');
    if($conn->query($sql)===TRUE){
    echo ("<script language='javascript'>
    window.alert('All Books Removed From Cart!')
    window.location.href='cart.php'
    </script>");
    exit();
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--BOOTSTRAP-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" referrerpolicy="no-referrer">
   <!--REMIXICONS-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
   <!--SWIPER CSS-->
   <link rel="stylesheet" href="css/swiper-bundle.min.css">
   <!--CSS-->
   <link rel="stylesheet" href="css/styles.css">
   <title>Cart Page</title>
</head>
<body>
   <!--HEADER-->
   <?php include 'header.php'; ?>
   <div class="cart__header">
      <h3 class="cart__title">Your Cart</h3><br>
   </div>
    <div class="cart">
        <div class="cart__container">
        <?php
        $total_amt = 0;
        $sql = "SELECT * FROM cart WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="bks">
                    <form action="" method="post" class="box">
                        <a href="cart.php?delete=<?php echo $row['code']; ?>" class="close-icon" onclick="return confirm('Do You want to Delete This Book From Cart?');">
                            <i class="ri-close-line"></i>
                        </a>
                        <?php if (strpos($row['bimage'], 'img/') === 0): ?>
                            <img src="<?php echo $row['bimage']; ?>" alt="Book Image">
                            <?php else: ?>
                                <img src="img/<?php echo $row['bimage']; ?>" alt="Book Image">
                        <?php endif; ?>
                        <div class="bktitle"><?php echo htmlspecialchars($row['title']); ?></div>
                        <div class="bkprice">₹<?php echo htmlspecialchars($row['price']); ?></div>
                        <input type="hidden" name="bkcode" value="<?php echo htmlspecialchars($row['code']); ?>">
                        <div class="qtyupdate">
                            <input type="number" class="bkqty" name="bkqty" min="1" max="5" value="<?php echo htmlspecialchars($row['qty']); ?>">
                            <button type="submit" class="update__button button" name="update">Update</button>
                        </div>
                        </form>
                    <div class="total">Price : <span>₹<?php echo $total = ($row['qty'] * $row['price']); ?></span> </div>
                </div>
            <?php
            $total_amt += $total;
         }
      } else {
         echo '<p class="empty">Your cart is empty!</p>';
      }
      ?>
        </div>
        <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete_button button <?php echo ($total_amt > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">Delete All Books In Cart</a> 
        </div>
        <div class="cart_total">
            <p>Total Amount : <span>₹<?php echo $total_amt; ?></span></p>
            <div class="cont_container">
                <a href="search.php" class="continue_button button">Continue Browsing</a>
                <a href="checkout.php" class="checkout_button button <?php echo ($total_amt > 1)?'':'disabled'; ?>">Checkout</a>
            </div>
        </div>
    </div>
    <?php
    $conn->close();
   ?>
   <!--FOOTER-->
   <?php include 'footer.php'; ?> 
</body>
</html>
