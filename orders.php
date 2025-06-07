<?php
session_start();
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection Failed:" . $conn->connect_error);
}
$email = $_SESSION['email'];
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
<div class="orders__header">
    <h3 class="orders__title">Orders</h3>
</div>
<div class="orders__container">
    <?php
    $sql = "SELECT * FROM orders WHERE email= '$email' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
        <div class="order-container"> 
            <div class="orders">
                <p><strong>Name:</strong> <?php echo $row['username']; ?></p>
                <p><strong>Mobile Number:</strong> <?php echo $row['phone']; ?></p>
                <p><strong>Pin Code:</strong> <?php echo $row['pincode']; ?></p>
                <p><strong>State:</strong> <?php echo $row['states']; ?></p>
                <p><strong>Address:</strong> <?php echo $row['addr']; ?></p>
                <p><strong>Locality:</strong> <?php echo $row['loc']; ?></p>
                <p><strong>City:</strong> <?php echo $row['city']; ?></p>
                <p><strong>Books Ordered:</strong> <?php echo $row['books']; ?></p>
                <p><strong>Total Amount:</strong> $<?php echo $row['total']; ?>/-</p>
                <p><strong>Mode Of Payment:</strong> <?php echo $row['payment']; ?></p>
            </div>
        </div>
    <?php
        }
    } else {
        echo '<p class="empty">No Orders!</p>';
    }
    $conn->close();
    ?>
   </div>
</body>
<!--FOOTER-->
<?php include 'footer.php'; ?> 
</html>
