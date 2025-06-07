<?php 
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST ['change'])){
    $email = $_GET["email"]; 
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    if ($pass == $cpass) {
        $query = "UPDATE logins SET pass = '$pass', cpass='$cpass' WHERE email = '$email'";
        $conn->query($query);
        echo ("<script language='javascript'>
        window.alert('Password changed successfully')
        window.location.href='login.php'
        </script>");
        exit();     
    } else {
        echo ("<script language='javascript'>
        window.alert('Passwords do not match')
        window.location.href='changepass.php'
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
    <title>Log In</title>
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
    <section class="login grid" id="login-content">
        <form action="" method="POST" class="login__form grid">
            <h3 class="login__title">Forgot Password</h3>
            <div class="login__group grid">
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
                <span class="login__signup"></span>
                <button type="submit" name="change" class="login__button button">Update</button>
            </div>
        </form>
    </section>
</body>
</html>
