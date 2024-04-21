<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortune Small Finance Bank - Transaction History</title>
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

<!-- Content for Transaction History Page -->
<div class="transaction-history">
    <div class="container">
        <h2>Transaction Management</h2>
        <form action="transaction_hist.php" method="post">
        <div class="form-group">
        <?php include_once "database.php"; ?>
        <?php
        $sql_from = "SELECT name, account_number, amount FROM user_details";
        $result_from = $conn->query($sql_from);?>
    <label for="from">From:</label>
    <select id="from" name="from_account">
    <option> Select---</option>   
    <?php
    if ($result_from->num_rows > 0) {
        while ($row = $result_from->fetch_assoc()) {
            echo '<option value="' . $row["account_number"] . '">' . $row["name"] . ' - ' . $row["account_number"] . ' (Amount: ' . $row["amount"] . ')</option>';
        }
    } else {
        echo '<option value="">No accounts found</option>';
    }
    ?>
        
    </select>
    <!-- Display account balance here based on selected account -->
    <span id="from-balance"></span>
</div>
<div class="form-group">
<?php include_once "database.php"; ?>
        <?php
        $sql_from = "SELECT name, account_number, amount FROM user_details";
        $result_from = $conn->query($sql_from);?>
    <label for="to">To:</label>
    <select id="to" name="to_account">
        <option> Select---</option>   
    <?php
    if ($result_from->num_rows > 0) {
        while ($row = $result_from->fetch_assoc()) {
            echo '<option value="' . $row["account_number"] . '">' . $row["name"] . ' - ' . $row["account_number"] . ' (Amount: ' . $row["amount"] . ')</option>';
        }
    } else {
        echo '<option value="">No accounts found</option>';
    }
    ?>
    </select>
</div>
<div class="amount-btn">
<label>Amount:</label><br>
<input type="number" required name="amount" placeholder="Value"><br><br>

            <button type="submit" class="transaction-button">Make a Transaction</button></div>
            
          
        </form>
    </div>
 
    
</div>
<!-- Transaction handling-->
<?php
// Include database connection code
include_once "database.php";

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $from_account_number = isset($_POST["from_account"]) ? $_POST["from_account"] : "";
    $to_account_number = isset($_POST["to_account"]) ? $_POST["to_account"] : "";
    $amount = isset($_POST["amount"]) ? $_POST["amount"] : "";
// Fetch balance of the "from" account
$sql_from_balance = "SELECT amount FROM user_details WHERE account_number = '$from_account_number'";
$result_from_balance = $conn->query($sql_from_balance);

if ($result_from_balance->num_rows > 0) {
    $row = $result_from_balance->fetch_assoc();
    $from_balance = $row["amount"];

    // Check if transaction amount exceeds the balance
    if ($amount > $from_balance) {
        echo "<script>alert('Transaction error: Insufficient balance in the selected account.');</script>";
    } else {
        // Perform transaction
        $new_from_balance = $from_balance - $amount;
        
        // Update balance of the "from" account
        $sql_update_from = "UPDATE user_details SET amount = $new_from_balance WHERE account_number = '$from_account_number'";
        $conn->query($sql_update_from);

        // Fetch balance of the "to" account
        $sql_to_balance = "SELECT amount FROM user_details WHERE account_number = '$to_account_number'";
        $result_to_balance = $conn->query($sql_to_balance);
        
        if ($result_to_balance->num_rows > 0) {
            $row = $result_to_balance->fetch_assoc();
            $to_balance = $row["amount"];

            // Update balance of the "to" account
            $new_to_balance = $to_balance + $amount;
            $sql_update_to = "UPDATE user_details SET amount = $new_to_balance WHERE account_number = '$to_account_number'";
            $conn->query($sql_update_to);

            // Display success message
            echo "<script>alert('Transaction successful!');</script>";
        } else {
            echo "<script>alert('Transaction error: Invalid destination account.');</script>";
        }
    }
} else {
    echo "<script>alert('Transaction error: Invalid source account.');</script>";
}}

// Close connection
$conn->close();
?>



<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Fortune Small Finance Bank</p>
    </div>
</footer>

</body>
</html>
