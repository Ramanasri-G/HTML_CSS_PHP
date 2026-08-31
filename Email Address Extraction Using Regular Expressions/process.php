<!DOCTYPE html>
<html>
<head>
    <title>Email Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>📧 Valid Email Addresses</h1>

<?php

$text = $_POST["text"];

$pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';

preg_match_all($pattern, $text, $matches);

if (!empty($matches[0])) {

    echo "<h3>Identified Email Addresses:</h3>";

    foreach ($matches[0] as $email) {
        echo "<p>✔ " . htmlspecialchars($email) . "</p>";
    }

    echo "<h3>Total Valid Emails: " . count($matches[0]) . "</h3>";

} else {
    echo "<p>No valid email addresses found.</p>";
}

?>

<br>
<a href="index.html">← Back</a>

</div>

</body>
</html>