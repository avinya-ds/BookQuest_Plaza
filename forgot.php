<?php 
$conn = new mysqli('localhost', 'root', '', 'book');   
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST ['forgot'])){
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $query = "SELECT email, phone FROM logins WHERE email = '$email' AND phone = '$phone'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $email = $_POST["email"]; 
        echo '<script>window.location.href="changepass.php?email=' . $email . '";</script>';

    } else {
        echo ("<script language='javascript'>
        window.alert('Email and phone number do not match')
        window.location.href='forgot.php'
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
                    <label for="email" class="login__label">Email</label>
                    <input type="email" id="email" name="email" class="login__input" placeholder="Enter your email-id" required>
                </div>
                <div>
                    <label for="phone" class="signup__label">Phone Number</label>
                    <input type="tel" pattern="[0-9]{10}" title="Phonenumber should contain only 10 digits" id="phone" name="phone" class="signup__input" placeholder="Enter phone number" required>
                </div>
            </div>
            <div>
                <span class="login__signup">
                   
                </span>
                <button type="submit" name="forgot" class="login__button button">Verify</button>
            </div>
        </form>
    </section>
</body>
</html>
