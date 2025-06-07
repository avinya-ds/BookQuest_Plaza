<?php
session_start();
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection Failed:" . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];   
    if (empty($email) || empty($pass)) {
        echo ("<script language='javascript'>
        window.alert('You did not complete all the required fields')
        window.location.href='login.php'
        </script>");
        exit();
    }
    if ($email === 'ad@gmail.com' && $pass === 'ad') {
        $_SESSION['log'] = "yes";
        $_SESSION['email'] = $email;
        header("location:adminlog.php");
        exit();
    }
    $sql = "SELECT username FROM logins WHERE email='$email' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $_SESSION['log'] = "yes";
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        echo ("<script language='javascript'>
        window.alert('Logged in successfully')
        window.location.href='user.php'
        </script>");
        exit();
    } else {
        echo ("<script language='javascript'>
        window.alert('Wrong email or password')
        window.location.href='login.php'
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
            <h3 class="login__title">Log In</h3>
            <div class="login__group grid">
                <div>
                    <label for="email" class="login__label">Email</label>
                    <input type="email" id="email" name="email" class="login__input" placeholder="Enter your email-id" required>
                </div>
                <div>
                    <label for="pass" class="login__label">Password</label>
                    <input type="password" id="pass" name="pass" class="login__input" placeholder="Enter your password" required>
                </div>
            </div>
            <div>
                <span class="login__signup">
                    Don't have an account? <a href="signup.php">Sign up</a>
                </span>
                <a href="forgot.php" class="login__forgot">You forgot your password</a><br>
                <button type="submit" class="login__button button">Log In</button>
            </div>
        </form>
    </section>
</body>
</html>
