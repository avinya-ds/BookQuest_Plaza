<?php
    $conn = new mysqli("localhost", "root", "", "book");
    if ($conn->connect_error) {
        die("Connection Failed:" . $conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST['username'];
        $email =$_POST['email'];
        $phone=$_POST['phone'];
        $pass = $_POST['pass'];
        $cpass =$_POST['cpass'];
        $query="SELECT * FROM logins WHERE email='$email'";
        $query1="SELECT *FROM logins WHERE phone='$phone'";
        $result=$conn->query($query);
        $result1=$conn->query($query1);
        if($result->num_rows>0){
            echo "<script>
            alert('Email already exist');
            window.location.href='signup.php';
            </script>";
        }elseif($result1->num_rows>0){
            echo "<script>
            alert('Phone Number already exist');
            window.location.href='signup.php';
            </script>";
        }
        elseif($pass == $cpass){ 
            $sql="INSERT INTO logins(username,email,phone,pass,cpass) VALUES('$username','$email','$phone','$pass','$cpass')";
            if($conn->query($sql)===TRUE){
                echo "<script>
                alert('Registration Successfull');
                window.location.href='login.php';
                </script>";
            }
            else{
                echo "<script>
                alert('Invalid credentials');
                window.location.href='signup.php';
                </script>";
            }
        }
        else{
            echo "<script>
            alert('Password does not match');
            window.location.href='signup.php';
            </script>";
        }
        if($phonenumber>10){
            echo"<script>
            alert('Phonenumber should contain only 10 digits');
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
</head>
<body>
    <section class="signup grid" id="signup-content">
        <form action="" method="post" class="signup__form grid">
            <h3 class="signup__title">Sign Up</h3>
            <div class="signup__group grid">
                <div>
                    <label for="username" class="signup__label">Name</label>
                    <input type="text" id="username" name="username" class="signup__input" placeholder="Enter username" pattern="[a-zA-Z ]{1,}" title="only alphabets allowed" required>
                </div>
                <div>
                    <label for="email" class="signup__label">Email</label>
                    <input type="email" id="email" name="email" class="signup__input" placeholder="Enter email-id" required>
                </div>
       	        <div>
                    <label for="phone" class="signup__label">Phone Number</label>
                    <input type="tel" pattern="[0-9]{10}" title="Phonenumber should contain only 10 digits" id="phone" name="phone" class="signup__input" placeholder="Enter phone number" required>
                </div>
                <div>
                    <label for="pass" class="signup__label">Password</label>
                    <input type="password" id="pass" name="pass" class="signup__input" placeholder="Enter Password" required>
                </div>
                <div>
                    <label for="cpass" class="signup__label">Confirm Password</label>
                    <input type="password" id="cpass" name="cpass" class="signup__input" placeholder="Enter Password" required>
                </div>
            </div>
            <div>
                <span class="signup__login">
                    Already have an account ? <a href="login.php">Log In</a>
                </span>
                <button type="submit" class="signup__button button">Sign Up</button>
            </div>
        </form>
    </section>
</body>
</html>