<!DOCTYPE html>
<html>
<head>
    <title>Loan Repayment Schedule</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>💰 Loan Repayment Report</h1>
        <p>EMI Calculation and Schedule</p>
    </div>

    <div class="report">

<?php

$amount = (float) $_POST["amount"];
$annualRate = (float) $_POST["rate"];
$years = (int) $_POST["years"];

/* Convert annual rate to monthly rate */

$monthlyRate = $annualRate / 12 / 100;

/* Total number of monthly payments */

$months = $years * 12;

/* Calculate EMI */

if ($monthlyRate > 0) {

    $emi = $amount * $monthlyRate *
           pow(1 + $monthlyRate, $months) /
           (pow(1 + $monthlyRate, $months) - 1);

} else {

    $emi = $amount / $months;
}

/* Total payment and interest */

$totalPayment = $emi * $months;

$totalInterest = $totalPayment - $amount;

?>

<div class="summary">

    <p>Loan Amount:
        ₹<?php echo number_format($amount, 2); ?>
    </p>

    <p>Interest Rate:
        <?php echo $annualRate; ?>%
    </p>

    <p>Loan Tenure:
        <?php echo $years; ?> Years
    </p>

    <p>Monthly EMI:
        ₹<?php echo number_format($emi, 2); ?>
    </p>

    <p>Total Interest:
        ₹<?php echo number_format($totalInterest, 2); ?>
    </p>

    <p>Total Payment:
        ₹<?php echo number_format($totalPayment, 2); ?>
    </p>

</div>

<h2>📊 Repayment Schedule</h2>

<table>

<tr>
    <th>Month</th>
    <th>EMI</th>
    <th>Interest</th>
    <th>Principal</th>
    <th>Balance</th>
</tr>

<?php

$balance = $amount;

for ($month = 1; $month <= $months; $month++) {

    /* Calculate monthly interest */

    $interest = $balance * $monthlyRate;

    /* Calculate principal */

    $principal = $emi - $interest;

    /* Update balance */

    $balance = $balance - $principal;

    if ($balance < 0) {
        $balance = 0;
    }

    echo "<tr>";

    echo "<td>$month</td>";

    echo "<td>₹" . number_format($emi, 2) . "</td>";

    echo "<td>₹" . number_format($interest, 2) . "</td>";

    echo "<td>₹" . number_format($principal, 2) . "</td>";

    echo "<td>₹" . number_format($balance, 2) . "</td>";

    echo "</tr>";
}

?>

</table>

<a href="index.html" class="back">
    ← Calculate Another Loan
</a>

    </div>

</div>

</body>
</html>