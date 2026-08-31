<!DOCTYPE html>
<html>
<head>
    <title>Customer Validation Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Validation Report</h1>
        <p>Customer Information Analysis</p>
    </div>

    <div class="report">

<?php

$name = trim($_POST["name"]);
$phone = trim($_POST["phone"]);
$email = trim($_POST["email"]);
$account = trim($_POST["account"]);

/*
   Regular Expression Patterns
*/

// Name: alphabets and spaces only
$namePattern = "/^[A-Za-z ]+$/";

// Phone: exactly 10 digits
$phonePattern = "/^[0-9]{10}$/";

// Email validation
$emailPattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";

// Account number: exactly 10 digits
$accountPattern = "/^[0-9]{10}$/";


/*
   Validation
*/

$nameValid = preg_match($namePattern, $name);
$phoneValid = preg_match($phonePattern, $phone);
$emailValid = preg_match($emailPattern, $email);
$accountValid = preg_match($accountPattern, $account);


/*
   Function to display status
*/

function status($value)
{
    if ($value) {
        return "<span class='valid'>✓ Valid</span>";
    } else {
        return "<span class='invalid'>✗ Invalid</span>";
    }
}

?>

<h2>Customer Validation Report</h2>

<table>

    <tr>
        <th>Information</th>
        <th>Entered Value</th>
        <th>Status</th>
    </tr>

    <tr>
        <td>Customer Name</td>
        <td><?php echo htmlspecialchars($name); ?></td>
        <td><?php echo status($nameValid); ?></td>
    </tr>

    <tr>
        <td>Phone Number</td>
        <td><?php echo htmlspecialchars($phone); ?></td>
        <td><?php echo status($phoneValid); ?></td>
    </tr>

    <tr>
        <td>Email ID</td>
        <td><?php echo htmlspecialchars($email); ?></td>
        <td><?php echo status($emailValid); ?></td>
    </tr>

    <tr>
        <td>Account Number</td>
        <td><?php echo htmlspecialchars($account); ?></td>
        <td><?php echo status($accountValid); ?></td>
    </tr>

</table>

<a href="index.html" class="back">← Validate Another Customer</a>

    </div>

</div>

</body>
</html>