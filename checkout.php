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
if (isset($_POST['order'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $addr = mysqli_real_escape_string($conn, $_POST['addr']);
    $loc = mysqli_real_escape_string($conn, $_POST['loc']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $total = 0;
    $bks = array();
    $sql = "SELECT * FROM cart WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bks[] = $row['title'] . ' (' . $row['qty'] . ') ';
            $amt = ($row['price'] * $row['qty']);
            $total += $amt;
        }
    }

    if ($total == 0) {
        echo '<p class="empty" style="color:red;">Your Cart Is Empty!</p>';
    } else {
        $books_str = implode(', ', $bks);
        $sql = "INSERT INTO orders (email, username, phone, pincode, states, addr, loc, city, books, total, payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssds", $email, $username, $phone, $pincode, $state, $addr, $loc, $city, $books_str, $total, $payment);
        if ($stmt->execute()) {
            $sql = "DELETE FROM cart WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            echo ("<script language='javascript'>
                window.alert('Order Has Been Placed Successfully')
                window.location.href='user.php'
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
<!--User Info for checkout-->
<div class="checkout__header">
    <h3 class="checkout__title">Checkout</h3>
</div>
<div class="checkout">
    <div class="items__container">
        <h3 class="items__title">Selected Items For Purchase</h3>
        <?php  
        $total_amt = 0;
        $sql = "SELECT * FROM cart WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total = ($row['price'] * $row['qty']);
                $total_amt += $total;
                ?>
                <p><?php echo $row['title']; ?> <span> : <?php echo '₹' . $row['price'] . ' x ' . $row['qty']; ?></span> </p>
                <?php
            }
        } else {
            echo '<p class="empty">Cart Is Empty!</p>';
        }
        ?>
        <div class="checkout_total"> Total Amount : ₹<?php echo $total_amt; ?> </div>
    </div>
    <div class="checkout__container">
        <form id="payment-form" method="post" action="" class="order__form grid">
            <h3 class="order__title">Place Your Order</h3>
            <div class="row">
                <div class="col-md-6">
                    <label for="username">Name</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Name" pattern="[a-zA-Z ]{1,}" title="only alphabets allowed" required>
                </div>
                <div class="col-md-6">
                    <label for="phone">Mobile Number</label>
                    <input type="tel" pattern="[0-9]{10}" title="Phonenumber should contain only 10 digits" id="phone" name="phone" class="form-control" placeholder="Enter Mobile Number" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="pincode">Pin Code</label>
                    <input type="number" min="0" id="pincode" name="pincode" class="form-control" placeholder="Enter Pin Code" required>
                </div>
                <div class="col-md-6">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" class="form-control" placeholder="Enter State" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="addr">Address (House No, Building, Street, Area)</label>
                    <input type="text" id="addr" name="addr" class="form-control" placeholder="Enter Address" required>
                </div>
                <div class="col-md-6">
                    <label for="loc">Locality/Town</label>
                    <input type="text" id="loc" name="loc" class="form-control" placeholder="Enter Locality/Town" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="city">City/District</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter City/District" required>
                </div>
                <div class="col-md-6">
                    <label for="payment">Mode Of Payment </label><br>
                    <select name="payment" id="payment" class="form-select">
                        <option value="cash on delivery">Cash On Delivery</option>
                        <option value="credit card">Credit Card</option>
                        <option value="debit">Debit Card</option>
                        <option value="net">Net Banking</option>
                    </select>
                </div>
            </div>
            <div id="payment-details" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <label for="account-number">Account Number</label>
                        <input type="text" id="account-number" name="account_number" class="form-control" placeholder="Enter Account Number" pattern="\d{10,16}" title="Enter Only Digits And Should Contain 10-16 Digits!" maxlength="16">
                    </div>
                    <div class="col-md-6">
                        <label for="expiry-date">Expiry Date</label>
                        <input type="text" id="expiry-date" name="expiry_date" class="form-control" placeholder="Enter Expiry Date (MM/YY)">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="account-holder-name">Account Holder Name</label>
                        <input type="text" id="account-holder-name" name="account_holder_name" class="form-control" placeholder="Enter Account Holder Name" pattern="[a-zA-Z ]{1,}" title="only alphabets allowed">
                    </div>
                    <div class="col-md-6">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" class="form-control" placeholder="Enter CVV" pattern="\d{3,4}" maxlength="4">
                    </div>
                </div>
            </div>
            <input type="submit" name="order" class="btn btn-primary" value="Place Order">
        </form>
    </div>
</div>
<!--FOOTER-->
<?php include 'footer.php'; ?>
<!--JavaScript-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentSelect = document.getElementById('payment');
        const paymentDetails = document.getElementById('payment-details');
        const form = document.getElementById('payment-form');
        const expiryDateInput = document.getElementById('expiry-date');
        const accountNumber = document.getElementById('account-number');
        const accountHolderName = document.getElementById('account-holder-name');
        const cvv = document.getElementById('cvv');
        paymentSelect.addEventListener('change', function() {
            if (this.value === 'credit card' || this.value === 'debit' || this.value === 'net') {
                paymentDetails.style.display = 'block';
                accountNumber.required = true;
                expiryDateInput.required = true;
                accountHolderName.required = true;
                cvv.required = true;
            } else {
                paymentDetails.style.display = 'none';
                accountNumber.required = false;
                expiryDateInput.required = false;
                accountHolderName.required = false;
                cvv.required = false;
            }
        });
        form.addEventListener('submit', function(event) {
            if (paymentDetails.style.display === 'block') {
                if (!validateExpiryDate(expiryDateInput.value)) {
                    alert('Your Card Is Expired');
                    event.preventDefault(); // Prevent form submission
                }
                if (!accountNumber.value || !expiryDateInput.value || !accountHolderName.value || !cvv.value) {
                    alert('Please fill out all payment details.');
                    event.preventDefault();
                }
            }
        });
        function validateExpiryDate(expiryDateValue) {
            const [month, year] = expiryDateValue.split('/').map(Number);
            if (!month || !year || month < 1 || month > 12) return false;
            const now = new Date();
            const expiry = new Date(`20${year}`, month - 1); // Assuming year is in YY format
            return expiry > now;
        }
    });
</script>
</body>
</html>
