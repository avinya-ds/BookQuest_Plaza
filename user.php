<?php
session_start();
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection Failed:" . $conn->connect_error);
}
$email = $_SESSION['email'];
if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location:login.php');
    exit();
}
if(isset($_POST['change'])){
    $email = $_SESSION['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    if($pass == $cpass){ 
        $sql = "UPDATE logins SET pass = '$pass' , cpass = '$cpass' WHERE email = '$email'";
        if($conn->query($sql)===TRUE){
            echo "<script>
            alert('Password Is Successfully Updated!');
            window.location.href='user.php';
            </script>";
            exit();
        }
        else {
            echo "Error updating record: " . $conn->error;
        }
    }
    else{
        echo "<script>
        alert('Password does not match');
        window.location.href='user.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
</head>
<body>
<!--HEADER-->
<?php include 'header.php'; ?>
<!--User Info-->
<div class="user__header">
    <h3 class="user__title">Profile</h3>
</div>
<div class="user">
    <div class="user__container">
        <p>Username: <span><?php echo $_SESSION['username']; ?></span></p>
        <p>Email: <span><?php echo $_SESSION['email']; ?></span></p>
        <p><a href="orders.php" id="order_button button">Your Orders</a></p>
        <form method="post" action="logout.php">
            <p> <button type="submit" class="logout__button button" name="logout">Log Out</button></p>
        </form>
    </div>
    <div class="pass__container">
        <form method="post" action="user.php" class="pass__form grid">
            <h3 class="pass__title">Change Password</h3>
            <div class="pass__group grid">
                <div>
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Enter Password" required>
                </div>
                <div>
                    <label for="cpass">Confirm Password</label>
                    <input type="password" id="cpass" name="cpass" placeholder="Enter Password" required>
                </div>
            </div>
            <div>
                <button type="submit" class="change__button button" name="change">Change Password</button>
            </div>
        </form>
    </div>
</div>
<!--FOOTER-->
<?php include 'footer.php'; ?> 
</body>
</html>
