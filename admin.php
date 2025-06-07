<?php
session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] !== "yes" || $_SESSION['email'] !== 'ad@gmail.com') {
    header("location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$success = false;
$message = "";
$view_books = [];
$view_users = [];
$view_orders = [];
$view_messages = [];
$current_section = isset($_POST['current_section']) ? $_POST['current_section'] : 'manage-books';
if (isset($_POST['addbook'])) {
    // Fetching values from add book form
    $book_title = $_POST['add-book-title'];
    $book_code = $_POST['add-book-code'];
    $book_price = $_POST['add-book-price'];
    $image = $_POST['image'];  
    $sql_insert_data = "INSERT INTO books(title, code, price, bimage) VALUES ('$book_title', '$book_code', '$book_price', '$image')";  
    if ($conn->query($sql_insert_data) === TRUE) {
        $success = true;
        $message = "Data inserted successfully";
    } else {
        $message = "Error inserting data: " . $conn->error;
    }
}
if (isset($_POST['removebook'])) {
    // Fetching values from remove book form
    $book_code = $_POST['remove-book-code'];  
    $sql_remove_data = "DELETE FROM books WHERE code='$book_code'";   
    if ($conn->query($sql_remove_data) === TRUE) {
        $success = true;
        $message = "Data removed successfully";
    } else {
        $message = "Error removing data: " . $conn->error;
    }
}
if (isset($_POST['updatebook'])) {
    // Fetching values from update book form
    $book_code = $_POST['upd-book-code'];
    $book_title = $_POST['upd-book-title'];
    $book_price = $_POST['upd-book-price'];
    $sql_update_data = "UPDATE books SET title='$book_title', price='$book_price' WHERE code='$book_code'";   
    if ($conn->query($sql_update_data) === TRUE) {
        $success = true;
        $message = "Data updated successfully";
    } else {
        $message = "Error updating data: " . $conn->error;
    }
}
if (isset($_POST['viewbooks'])) {
    $sql_view_data = "SELECT * FROM books";
    $result = $conn->query($sql_view_data);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $view_books[] = $row;
        }
    } else {
        $message = "No data found";
    }
}
if (isset($_POST['viewusers'])) {
    $sql_view_users = "SELECT * FROM logins";
    $result = $conn->query($sql_view_users);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $view_users[] = $row;
        }
    } else {
        $message = "No user data found";
    }
}
if (isset($_POST['vieworders'])) {
    $sql_view_orders = "SELECT * FROM orders";
    $result = $conn->query($sql_view_orders);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $view_orders[] = $row;
        }
    } else {
        $message = "No order data found";
    }
}
if (isset($_POST['viewmessage'])) {
    $sql_view_messages = "SELECT * FROM contact";  
    $result = $conn->query($sql_view_messages);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $view_messages[] = $row;
        }
    } else {
        $message = "No messages found";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Admin Panel</title>
    <link rel="stylesheet" href="STYLENEW.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Admin Panel</h1>
            <form method="post" action="logout.php">
                <p> <button type="submit" class="logout-button">Log Out</button></p>
            </form>
        </div>
    </header>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="javascript:void(0)" onclick="showSection('manage-books')">Manage Books</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('manage-users')">Manage Users</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('manage-orders')">Manage Orders</a></li>
                <li><a href="javascript:void(0)" onclick="showSection('message')">Message</a></li>
            </ul>
        </nav>
        <main class="content">
            <section id="manage-books" class="admin-section">
                <h2>Manage Books</h2>
                <div class="book-buttons">
                    <button onclick="showForm('add-book-form')">Add Book</button>
                    <button onclick="showForm('remove-book-form')">Remove Book</button>
                    <button onclick="showForm('update-book-form')">Update Book Info</button>
                    <button onclick="showForm('view-books-form')">View Books</button>
                </div>
                <form id="add-book-form" class="book-form" method="post" action="" style="display: none;">
                    <h3>Add Book</h3>
                    <label for="add-book-title">Book Title:</label>
                    <input type="text" id="add-book-title" name="add-book-title">                  
                    <label for="add-book-code">Book Code:</label>
                    <input type="text" id="add-book-code" name="add-book-code">
                    <label for="add-book-price">Book Price:</label>
                    <input type="text" id="add-book-price" name="add-book-price">
                    <label for="image">Book Image:</label>
                    <input type="file" accept="image/*" id="image" name="image"><br><br>
                    <input type="hidden" name="current_section" value="manage-books">
                    <button type="submit" name="addbook">Add Book</button>
                </form>
                <form id="remove-book-form" class="book-form" method="post" action="" style="display: none;">
                    <h3>Remove Book</h3>
                    <label for="remove-book-code">Book Code:</label>
                    <input type="text" id="remove-book-code" name="remove-book-code">
                    <input type="hidden" name="current_section" value="manage-books">
                    <button type="submit" name="removebook">Remove Book</button>
                </form>
                <form id="update-book-form" class="book-form" method="post" action="" style="display: none;">
                    <h3>Update Book Info</h3>
                    <label for="upd-book-title">New Book Title:</label>
                    <input type="text" id="upd-book-title" name="upd-book-title">
                    <label for="upd-book-price">New Book Price:</label>
                    <input type="text" id="upd-book-price" name="upd-book-price">
                    <label for="upd-book-code">Book Code:</label>
                    <input type="text" id="upd-book-code" name="upd-book-code">
                    <input type="hidden" name="current_section" value="manage-books">
                    <button type="submit" name="updatebook">Update Book</button>
                </form>
                <form id="view-books-form" class="book-form" method="post" action="" style="display: none;">
                    <h3>Viewing The Books In Stock</h3>
                    <input type="hidden" name="current_section" value="manage-books">
                    <button type="submit" name="viewbooks">View Books</button>
                </form>
                <?php if (!empty($view_books)) { ?>
                <div class="book-view" id="view-books">
                    <?php foreach ($view_books as $book) { ?>
                        <div class="viewbks_container">
                            <img src="img/<?php echo $book['bimage']; ?>" alt="" class="bimage">
                            <div class="title"><?php echo $book['title']; ?></div>
                            <div class="code">Code: <?php echo $book['code']; ?></div>
                            <div class="price">₹<?php echo $book['price']; ?></div>
                        </div>
                        <?php } ?>
                        </div>
                        <button class="but" onclick="goBack('manage-books')">Back</button>
                <?php } ?>
               </section>
            <section id="manage-users" class="admin-section" style="display: none;">
                <h2>Manage Users</h2>
                <form id="view-users-form" method="post" action="">
                    <h3>View Users</h3>
                    <input type="hidden" name="current_section" value="manage-users">
                    <button type="submit" name="viewusers">View Users</button>
                </form>
                <?php if (!empty($view_users)) { ?>
                <div id="view-users" class="user-view">
                    <h3>Users List</h3>
                    <table>
                        <thead>
                            <tr><th>Username</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($view_users as $user) { ?>
                            <tr><td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </section>
            <section id="manage-orders" class="admin-section" style="display: none;">
                <h2>Manage Orders</h2>
                <form id="view-orders-form" method="post" action="">
                    <h3>View Orders</h3>
                    <input type="hidden" name="current_section" value="manage-orders">
                    <button type="submit" name="vieworders">View Orders</button>
                </form>
                <?php if (!empty($view_orders)) { ?>
                <div id="view-orders" class="order-view">
                    <h3>Orders List</h3>
                    <?php foreach ($view_orders as $order) { ?>
                        <div class="viewbks_container">                            
                            <div class="title"><?php echo $order['username']; ?></div>
                            <div class="phone">Code: <?php echo $order['phone']; ?></div>
                            <div class="pincode">Pincode :<?php echo $order['pincode']; ?></div>
                            <div class="states">States :<?php echo $order['states']; ?></div>
                            <div class="addr">Address :<?php echo $order['addr']; ?></div>
                            <div class="loc">Locality :<?php echo $order['loc']; ?></div>
                            <div class="books">Books :<?php echo $order['books']; ?></div>
                            <div class="total">Total :<?php echo $order['total']; ?></div>
                            <div class="payment">Payment :<?php echo $order['payment']; ?></div>
                        </div>
                        <?php } ?>                        
                 </div>                
                <?php } ?>
            </section>
            <section id="message" class="admin-section" style="display: none;">
                <h2>Message</h2>
                <form id="view-message-form" method="post" action="">
                    <input type="hidden" name="current_section" value="message">
                    <button type="submit" name="viewmessage">View Messages</button>
                 </form>
                <?php if (!empty($view_messages)) { ?>
                <div id="view-messages" class="message-view">
                    <h3>Messages List</h3>
                    <?php foreach ($view_messages as $contact) { ?>
                        <div class="viewbks_container">                            
                            <div class="title"><?php echo $contact['username']; ?></div>
                            <div class="phone"><?php echo $contact['email']; ?></div>
                            <div class="pincode">Message :<?php echo $contact['msg']; ?></div>
                        </div>
                        <?php } ?>                  
                </div>
                <?php } else { echo $message; } ?>
            </section>
        </main>
    </div>
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.admin-section');
            sections.forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }
        function showForm(formId) {
            const forms = document.querySelectorAll('.book-form');
            forms.forEach(form => form.style.display = 'none');
            document.getElementById(formId).style.display = 'block';
        }
        document.addEventListener('DOMContentLoaded', () => {
            const currentSection = "<?php echo $current_section; ?>";
            showSection(currentSection);
        });
        window.onload = function() {
            const success = "<?php echo $success ? '1' : '0'; ?>";
            const message = "<?php echo $message; ?>";
            if (success === "1") {
                alert(message);
            } else if (message !== "") {
                alert(message);
            }
        };
        function goBack(sectionId) {
            const viewBooksSection = document.getElementById('view-books');
            if (viewBooksSection) {
                viewBooksSection.style.display = 'none';
            }
            showSection(sectionId);
        }
    </script>
</body>
</html>
