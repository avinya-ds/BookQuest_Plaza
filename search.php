<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'book');    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header('location:login.php');
        exit();
    }
    $bktitle = mysqli_real_escape_string($conn, $_POST['bktitle']);
    $bkprice = mysqli_real_escape_string($conn,$_POST['bkprice']);
    $bkimage = mysqli_real_escape_string($conn,$_POST['bkimage']);
    $bkqty = mysqli_real_escape_string($conn,$_POST['bkqty']);
    $bkcode = mysqli_real_escape_string($conn,$_POST['bkcode']);
    $email = mysqli_real_escape_string($conn,$_SESSION['email']);
    $sql = "SELECT * FROM cart WHERE code='$bkcode' AND email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo ("<script language='javascript'>
        window.alert('Book Already Has Been Added To Cart')
        window.location.href='cart.php'
        </script>");
        exit();
    } else {
        if (strpos($bkimage, 'http') === 0) {
            $image_file = 'img/' . $bkcode . '.jpg';
            file_put_contents($image_file, file_get_contents($bkimage));
        } else {
            $image_file = $bkimage;
        }
        $sql = "INSERT INTO cart(email, title, price, qty, bimage) VALUES('$email', '$bktitle', '$bkprice', '$bkqty', '$image_file')";
        if($conn->query($sql)===TRUE){
            echo ("<script language='javascript'>
            window.alert('Book Added To Cart!')
            window.location.href='cart.php'
            </script>");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
   <title>Search Page</title>
</head>
<body>
   <!--HEADER-->
   <?php include 'header.php'; ?>
   <div class="search__header">
      <h3 class="search__title">Search</h3><br>
   </div>
   <div class="search__form">
      <form action="" method="post">
         <input type="text" name="search" class="search__input" placeholder="Find Titles For Your Next Read!" required>
         <button type="submit" class="search__button button" name="submit">Search</button>
      </form>
   </div>
   <?php
   echo "<div class='bks__container'>";
   $sql = "SELECT * FROM books";
   if (isset($_POST['submit'])) {
      $search = mysqli_real_escape_string($conn, $_POST['search']);
      $sql .= " WHERE title LIKE '%$search%'";
   }
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
         ?>
         <div class="bks">
         <form action="" method="post" class="box">
            <img src="img/<?php echo $row['bimage']; ?>" alt="" class="bimage">
            <div class="title"><?php echo htmlspecialchars($row['title']); ?></div>
            <div class="price">₹<?php echo htmlspecialchars($row['price']); ?></div>
            <input type="number" class="bkqty" name="bkqty" min="1" max="5" value="1">
            <input type="hidden" name="bkcode" value="<?php echo htmlspecialchars($row['code']); ?>">
            <input type="hidden" name="bktitle" value="<?php echo htmlspecialchars($row['title']); ?>">
            <input type="hidden" name="bkprice" value="<?php echo htmlspecialchars($row['price']); ?>">
            <input type="hidden" name="bkimage" value="<?php echo htmlspecialchars($row['bimage']); ?>">
            <input type="submit" class="button" value="Add To Cart" name="add_to_cart">
         </form>
         </div>
         <?php 
      }
   } else {
      include 'googlebks.php';
   }
   echo "</div>";
   $conn->close();
   ?>
   <!--FOOTER-->
   <?php include 'footer.php'; ?> 
</body>
</html>
