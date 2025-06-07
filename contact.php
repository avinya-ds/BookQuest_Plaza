<?php
    session_start();
    $conn=new mysqli("localhost","root","","book");
    if($conn->connect_error){
        die("Connection Failed:".$conn->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $msg=$_POST['msg'];
        $result=$conn->query("SELECT * FROM contact WHERE username = '$username' AND email = '$email' AND msg = '$msg'") or die('query failed');
        if($result->num_rows>0){
            echo("<script language='javascript'>
            window.alert('Message is already sent')
            window.location.href='contact.php'
            </script>");
        }
        else{
            $sql="INSERT INTO contact(username,email,msg) VALUES('$username','$email','$msg')";
            if($conn->query($sql)===TRUE){
                echo "<script>
                alert('Message Sent Succesfully');
                window.location.href='home.php';
                </script>";
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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" referrerpolicy="n0-referrer">
      <!--REMIXICONS-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
      <!--CSS-->
      <link rel="stylesheet" href="css/styles.css">
      <title>Contact Form</title>
    </head>
    <body>    
        <!--HEADER-->
        <?php include 'header.php'; ?>
        <section class="contactus section">
        <div class="contactus__container container grid">
        <div class="contactus">
            <form action="" method="post">
                <h3>Say Something</h3>
                <input type="text" name="username" placeholder="Enter Your Name" class="box" required> <br>
                <input type="email" name="email" placeholder="Enter Your Email-Id" class="box" required> <br>
                <textarea name="msg" placeholder="Enter Your Message" cols="30" rows="5" class="box" required></textarea> <br>
                <input type="submit" class="button" value="Submit">
            </form>
        </div>
        </div>
        </section>
        <!--FOOTER-->
        <?php include 'footer.php'; ?>  
    </body>
</html>

