<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortune Small Finance Bank - Create User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <h1 class="logo">Fortune Small Finance Bank</h1>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="transaction.php">Transaction</a></li>
            <li><a href="transaction_hist.php">Transaction Management</a></li>
            <li><a href="create_user.php">Create User</a></li>
        </ul>
    </div>
</nav>

<!-- Content for Create User Page -->
<div class="create-user" style="display:grid">
     <div class="container form-container"style="
    align-items: center;
    display: grid;
    justify-self: center;
">
        <h2>Create User Page</h2>
        <form action="create_user.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="account_number">Account Number:</label>
                <input type="text" id="account_number" name="account_number" placeholder="Account Number" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="email">Account-Balance:</label>
                <input type="number" id="amount" name="amount" placeholder="Balance" class="form-input" required>
            </div>
            <button type="submit" class="form-button">Create User</button>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Fortune Small Finance Bank</p>
    </div>
</footer>

</body>
</html>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = @$_POST['name'];
$account_number = @$_POST['account_number'];
$email = @$_POST['email'];
$amount=@$_POST['amount'];

// Insert data into database
$sql = "INSERT INTO user_details (name, account_number, email,amount) VALUES ('$name', '$account_number', '$email','$amount')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}

$conn->close();
?>
