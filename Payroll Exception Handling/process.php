<?php

class PayrollException extends Exception {}

function calculatePayroll($name, $salary, $days, $bonus, $deduction)
{
    try {

        // Validate employee name
        if (trim($name) == "") {
            throw new PayrollException("Employee name cannot be empty.");
        }

        // Validate salary
        if (!is_numeric($salary) || $salary < 0) {
            throw new PayrollException("Invalid salary amount.");
        }

        // Validate working days
        if (!is_numeric($days) || $days < 0 || $days > 31) {
            throw new PayrollException(
                "Working days must be between 0 and 31."
            );
        }

        // Validate bonus
        if (!is_numeric($bonus) || $bonus < 0) {
            throw new PayrollException("Invalid bonus amount.");
        }

        // Validate deduction
        if (!is_numeric($deduction) || $deduction < 0) {
            throw new PayrollException("Invalid deduction amount.");
        }

        // Runtime exception example
        if ($days == 0) {
            throw new PayrollException(
                "Working days cannot be zero for payroll calculation."
            );
        }

        // Calculate salary per day
        $dailySalary = $salary / $days;

        // Calculate earned salary
        $earnedSalary = $dailySalary * $days;

        // Calculate gross salary
        $grossSalary = $earnedSalary + $bonus;

        // Calculate net salary
        $netSalary = $grossSalary - $deduction;

        if ($netSalary < 0) {
            throw new PayrollException(
                "Deduction cannot be greater than the gross salary."
            );
        }

        return [
            "name" => $name,
            "salary" => $salary,
            "days" => $days,
            "bonus" => $bonus,
            "deduction" => $deduction,
            "gross" => $grossSalary,
            "net" => $netSalary
        ];

    } catch (PayrollException $e) {

        // Return error instead of stopping the application
        return [
            "name" => $name,
            "error" => $e->getMessage()
        ];
    }
}


// Process form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"] ?? "";
    $salary = $_POST["salary"] ?? "";
    $days = $_POST["days"] ?? "";
    $bonus = $_POST["bonus"] ?? "";
    $deduction = $_POST["deduction"] ?? "";

    $result = calculatePayroll(
        $name,
        $salary,
        $days,
        $bonus,
        $deduction
    );

} else {

    $result = [
        "error" => "Invalid request. Please submit the payroll form."
    ];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Result</title>

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
            margin: 20px 0;
            font-weight: bold;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 18px;
            border-radius: 8px;
            margin: 20px 0;
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

    <?php if (isset($result["error"])): ?>

        <h1>Payroll Error</h1>

        <div class="error">
            <strong>⚠ Error:</strong>
            <p><?php echo htmlspecialchars($result["error"]); ?></p>
        </div>

        <p>The application handled the error successfully and is ready to continue.</p>

    <?php else: ?>

        <h1>Payroll Result</h1>

        <div class="success">
            ✓ Payroll calculated successfully!
        </div>

        <div class="details">

            <p>
                <strong>Employee Name:</strong>
                <?php echo htmlspecialchars($result["name"]); ?>
            </p>

            <p>
                <strong>Basic Salary:</strong>
                ₹<?php echo number_format($result["salary"], 2); ?>
            </p>

            <p>
                <strong>Working Days:</strong>
                <?php echo $result["days"]; ?>
            </p>

            <p>
                <strong>Bonus:</strong>
                ₹<?php echo number_format($result["bonus"], 2); ?>
            </p>

            <p>
                <strong>Deduction:</strong>
                ₹<?php echo number_format($result["deduction"], 2); ?>
            </p>

            <p>
                <strong>Gross Salary:</strong>
                ₹<?php echo number_format($result["gross"], 2); ?>
            </p>

            <p>
                <strong>Net Salary:</strong>
                ₹<?php echo number_format($result["net"], 2); ?>
            </p>

        </div>

    <?php endif; ?>

    <a href="index.html" class="back">
        Process Another Employee
    </a>

</div>

</body>
</html>