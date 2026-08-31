<!DOCTYPE html>
<html>
<head>
    <title>Registration Validation Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Validation Report</h1>
        <p>Customer Registration Analysis</p>
    </div>

    <div class="report">

<?php

$name = trim($_POST["name"]);
$phone = trim($_POST["phone"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$pincode = trim($_POST["pincode"]);

/* Regular Expression Patterns */

$namePattern = "/^[A-Za-z ]+$/";

$phonePattern = "/^[0-9]{10}$/";

$emailPattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";

$passwordPattern = "/^(?=.*[A-Za-z])(?=.*[0-9]).{6,}$/";

$pincodePattern = "/^[0-9]{6}$/";

/* Validation */

$nameValid = preg_match($namePattern, $name);
$phoneValid = preg_match($phonePattern, $phone);
$emailValid = preg_match($emailPattern, $email);
$passwordValid = preg_match($passwordPattern, $password);
$pincodeValid = preg_match($pincodePattern, $pincode);

/* Display Status */

function showStatus($value)
{
    if ($value) {
        return "<span class='valid'>✓ Valid</span>";
    } else {
        return "<span class='invalid'>✗ Invalid</span>";
    }
}

?>

<h2>Customer Registration Report</h2>

<table>

<tr>
    <th>Field</th>
    <th>Entered Information</th>
    <th>Result</th>
</tr>

<tr>
    <td>Customer Name</td>
    <td><?php echo htmlspecialchars($name); ?></td>
    <td><?php echo showStatus($nameValid); ?></td>
</tr>

<tr>
    <td>Phone Number</td>
    <td><?php echo htmlspecialchars($phone); ?></td>
    <td><?php echo showStatus($phoneValid); ?></td>
</tr>

<tr>
    <td>Email Address</td>
    <td><?php echo htmlspecialchars($email); ?></td>
    <td><?php echo showStatus($emailValid); ?></td>
</tr>

<tr>
    <td>Password</td>
    <td>********</td>
    <td><?php echo showStatus($passwordValid); ?></td>
</tr>

<tr>
    <td>PIN Code</td>
    <td><?php echo htmlspecialchars($pincode); ?></td>
    <td><?php echo showStatus($pincodeValid); ?></td>
</tr>

</table>

<a href="index.html" class="back">← Register Another Customer</a>

    </div>

</div>

</body>
</html>