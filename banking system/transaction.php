<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortune Small Finance Bank - Transaction</title>
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

<!-- Content for Transaction Page -->
<div class="transaction">
    <div class="container">
        <h1>Transactions</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Account Number</th>
                

                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
    
   
                <?php
                
                
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT name,account_number FROM user_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in a table format
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["account_number"] . "</td></tr>";
    }

} else {
    echo "0 results";
}

$conn->close();
?>
               
            </tbody>
        </table>
    </div>
</div>

            <button class="transaction-button"><a style='color:white' href="transaction_hist.php">Make a Transaction</a></button>
            

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Fortune Small Finance Bank</p>
    </div>
</footer>

</body>
</html>
