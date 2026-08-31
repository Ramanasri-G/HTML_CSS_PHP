<?php

class BankingException extends Exception {}

try {

    // Check whether form was submitted
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new BankingException("Invalid request. Please submit the form.");
    }

    // Get form values
    $name = trim($_POST["name"] ?? "");
    $amount = $_POST["amount"] ?? "";
    $transactions = $_POST["transactions"] ?? "";
    $type = $_POST["type"] ?? "";

    // Validate name
    if ($name == "") {
        throw new BankingException("Account holder name cannot be empty.");
    }

    // Validate amount
    if ($amount == "" || !is_numeric($amount) || $amount < 0) {
        throw new BankingException("Invalid transaction amount.");
    }

    // Validate number of transactions
    if ($transactions == "" || !is_numeric($transactions)) {
        throw new BankingException("Invalid number of transactions.");
    }

    $transactions = (int)$transactions;

    // Division-by-zero handling
    if ($transactions == 0) {
        throw new DivisionByZeroError(
            "Cannot calculate the average transaction because the number of transactions is zero."
        );
    }

    // Validate transaction type
    if ($type != "Deposit" && $type != "Withdrawal") {
        throw new BankingException("Please select a valid transaction type.");
    }

    // Calculate average transaction
    $average = $amount / $transactions;

    // Display successful result
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaction Result</title>
        <link rel="stylesheet" href="style.css">

        <style>
            .result {
                text-align: center;
            }

            .success {
                background: #e8f5e9;
                color: #2e7d32;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-weight: bold;
            }

            .details {
                text-align: left;
                background: #f5f7fa;
                padding: 20px;
                border-radius: 10px;
                line-height: 2;
            }

            .details strong {
                color: #1565c0;
            }

            .back {
                display: block;
                text-align: center;
                margin-top: 20px;
                padding: 12px;
                background: #1565c0;
                color: white;
                text-decoration: none;
                border-radius: 7px;
            }

            .back:hover {
                background: #0d47a1;
            }
        </style>
    </head>

    <body>

    <div class="container result">

        <h1>Transaction Result</h1>

        <div class="success">
            Transaction processed successfully!
        </div>

        <div class="details">
            <p><strong>Account Holder:</strong> <?php echo htmlspecialchars($name); ?></p>

            <p><strong>Transaction Type:</strong>
                <?php echo htmlspecialchars($type); ?>
            </p>

            <p><strong>Total Amount:</strong>
                ₹<?php echo number_format((float)$amount, 2); ?>
            </p>

            <p><strong>Number of Transactions:</strong>
                <?php echo $transactions; ?>
            </p>

            <p><strong>Average Transaction:</strong>
                ₹<?php echo number_format($average, 2); ?>
            </p>
        </div>

        <a href="index.html" class="back">Process Another Transaction</a>

    </div>

    </body>
    </html>

    <?php

} catch (DivisionByZeroError $e) {

    // Handle division-by-zero error
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Transaction Error</title>
        <link rel="stylesheet" href="style.css">

        <style>
            .error {
                background: #ffebee;
                color: #c62828;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                margin-top: 20px;
            }

            .back {
                display: block;
                text-align: center;
                margin-top: 20px;
                padding: 12px;
                background: #1565c0;
                color: white;
                text-decoration: none;
                border-radius: 7px;
            }
        </style>
    </head>

    <body>

    <div class="container">
        <h1>Transaction Error</h1>

        <div class="error">
            <strong>Division by Zero Error</strong>
            <p><?php echo htmlspecialchars($e->getMessage()); ?></p>
        </div>

        <a href="index.html" class="back">Go Back</a>
    </div>

    </body>
    </html>

    <?php

} catch (BankingException $e) {

    // Handle invalid input errors
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Invalid Input</title>
        <link rel="stylesheet" href="style.css">

        <style>
            .error {
                background: #fff3e0;
                color: #e65100;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                margin-top: 20px;
            }

            .back {
                display: block;
                text-align: center;
                margin-top: 20px;
                padding: 12px;
                background: #1565c0;
                color: white;
                text-decoration: none;
                border-radius: 7px;
            }
        </style>
    </head>

    <body>

    <div class="container">
        <h1>Invalid Input</h1>

        <div class="error">
            <strong>Error:</strong>
            <p><?php echo htmlspecialchars($e->getMessage()); ?></p>
        </div>

        <a href="index.html" class="back">Go Back</a>
    </div>

    </body>
    </html>

    <?php

} catch (Throwable $e) {

    // Prevent unexpected errors
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>System Error</title>
        <link rel="stylesheet" href="style.css">

        <style>
            .error {
                background: #ffebee;
                color: #b71c1c;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                margin-top: 20px;
            }

            .back {
                display: block;
                text-align: center;
                margin-top: 20px;
                padding: 12px;
                background: #1565c0;
                color: white;
                text-decoration: none;
                border-radius: 7px;
            }
        </style>
    </head>

    <body>

    <div class="container">
        <h1>System Error</h1>

        <div class="error">
            <strong>Unexpected Error</strong>
            <p>The transaction could not be processed safely.</p>
        </div>

        <a href="index.html" class="back">Try Again</a>
    </div>

    </body>
    </html>

    <?php
}
?>