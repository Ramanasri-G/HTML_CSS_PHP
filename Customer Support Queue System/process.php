<!DOCTYPE html>
<html>
<head>
    <title>Queue Status</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>🎧 Queue Status</h1>
        <p>Customer Support Request Management</p>
    </div>

    <div class="result">

<?php

session_start();

/* Create queue if it does not exist */

if (!isset($_SESSION["queue"])) {
    $_SESSION["queue"] = [
        [
            "customer" => "Anitha",
            "request" => "Payment Issue"
        ],
        [
            "customer" => "Rahul",
            "request" => "Login Problem"
        ],
        [
            "customer" => "Priya",
            "request" => "Order Status"
        ]
    ];
}


/* Add new request to queue */

if (isset($_POST["add"])) {

    $customer = $_POST["customer"];
    $request = $_POST["request"];

    $newRequest = [
        "customer" => $customer,
        "request" => $request
    ];

    // array_push() adds request at the end
    array_push($_SESSION["queue"], $newRequest);

    echo "<h2>✓ Request Added Successfully</h2>";
}


/* Process request using FIFO */

if (isset($_POST["process"])) {

    if (!empty($_SESSION["queue"])) {

        // array_shift() removes first request
        $processed = array_shift($_SESSION["queue"]);

        echo "<h2>✓ Request Processed</h2>";

        echo "<div class='queue'>";
        echo "<strong>Customer:</strong> "
             . htmlspecialchars($processed["customer"]);
        echo "<br>";
        echo "<strong>Request:</strong> "
             . htmlspecialchars($processed["request"]);
        echo "</div>";

    } else {

        echo "<h2>Queue is Empty</h2>";
    }
}


/* Display queue status */

echo "<h2>📋 Current Queue</h2>";

if (!empty($_SESSION["queue"])) {

    $position = 1;

    foreach ($_SESSION["queue"] as $customer) {

        echo "<div class='queue'>";

        echo "<strong>Position $position</strong><br>";

        echo "Customer: "
             . htmlspecialchars($customer["customer"]);

        echo "<br>";

        echo "Request: "
             . htmlspecialchars($customer["request"]);

        echo "</div>";

        $position++;
    }

} else {

    echo "<p>No pending customer requests.</p>";
}

?>

<a href="index.html" class="back">← Back to Queue</a>

    </div>

</div>

</body>
</html>