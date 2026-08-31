<!DOCTYPE html>
<html>
<head>
    <title>Stock Analysis Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>📊 Stock Analysis Report</h1>
        <p>Investor Performance Summary</p>
    </div>

    <div class="report">

<?php

$stock = trim($_POST["stock"]);

/* Store stock prices in an array */

$prices = [
    "Day 1" => (float)$_POST["day1"],
    "Day 2" => (float)$_POST["day2"],
    "Day 3" => (float)$_POST["day3"],
    "Day 4" => (float)$_POST["day4"],
    "Day 5" => (float)$_POST["day5"]
];

/* Numerical calculations */

$total = array_sum($prices);

$average = $total / count($prices);

$highest = max($prices);

$lowest = min($prices);

/* Find highest and lowest day */

$highestDay = array_search($highest, $prices);

$lowestDay = array_search($lowest, $prices);

/* Calculate overall percentage change */

$firstPrice = reset($prices);

$lastPrice = end($prices);

if ($firstPrice > 0) {
    $percentageChange =
        (($lastPrice - $firstPrice) / $firstPrice) * 100;
} else {
    $percentageChange = 0;
}

/* Determine performance */

if ($percentageChange > 0) {

    $performance = "Positive ↑";
    $class = "positive";

} elseif ($percentageChange < 0) {

    $performance = "Negative ↓";
    $class = "negative";

} else {

    $performance = "Stable →";
    $class = "";
}

?>

<h2><?php echo htmlspecialchars($stock); ?></h2>

<table>

<tr>
    <th>Day</th>
    <th>Stock Price</th>
</tr>

<?php

foreach ($prices as $day => $price) {

    echo "<tr>";
    echo "<td>$day</td>";
    echo "<td>₹" . number_format($price, 2) . "</td>";
    echo "</tr>";
}

?>

</table>

<div class="summary">

    <p>
        💰 Average Price:
        ₹<?php echo number_format($average, 2); ?>
    </p>

    <p>
        📈 Highest Price:
        ₹<?php echo number_format($highest, 2); ?>
        (<?php echo $highestDay; ?>)
    </p>

    <p>
        📉 Lowest Price:
        ₹<?php echo number_format($lowest, 2); ?>
        (<?php echo $lowestDay; ?>)
    </p>

    <p>
        📊 Overall Change:
        <?php echo number_format($percentageChange, 2); ?>%
    </p>

    <p class="<?php echo $class; ?>">
        📌 Performance:
        <?php echo $performance; ?>
    </p>

</div>

<a href="index.html" class="back">
    ← Analyze Another Stock
</a>

    </div>

</div>

</body>
</html>