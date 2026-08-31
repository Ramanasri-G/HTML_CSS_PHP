<!DOCTYPE html>
<html>
<head>
    <title>Sales Analysis Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>📊 Sales Analysis Report</h1>
        <p>Sales Growth and Trend Analysis</p>
    </div>

    <div class="report">

<?php

// Historical sales records stored in an array

$sales = [
    "January"  => (float)$_POST["jan"],
    "February" => (float)$_POST["feb"],
    "March"    => (float)$_POST["mar"],
    "April"    => (float)$_POST["apr"],
    "May"      => (float)$_POST["may"]
];

/* Calculate total and average sales */

$totalSales = array_sum($sales);
$averageSales = $totalSales / count($sales);

/* Find highest and lowest sales */

$highestSales = max($sales);
$lowestSales = min($sales);

$highestMonth = array_search($highestSales, $sales);
$lowestMonth = array_search($lowestSales, $sales);

?>

<h2>📈 Monthly Sales</h2>

<table>

<tr>
    <th>Month</th>
    <th>Sales</th>
    <th>Growth %</th>
    <th>Trend</th>
</tr>

<?php

$previousSales = null;

foreach ($sales as $month => $currentSales) {

    if ($previousSales === null) {

        $growth = 0;
        $trend = "Starting Point";
        $class = "stable";

    } else {

        if ($previousSales != 0) {

            $growth = (($currentSales - $previousSales)
                      / $previousSales) * 100;

        } else {

            $growth = 0;
        }

        if ($growth > 0) {

            $trend = "Increasing ↑";
            $class = "growth";

        } elseif ($growth < 0) {

            $trend = "Decreasing ↓";
            $class = "decline";

        } else {

            $trend = "Stable →";
            $class = "stable";
        }
    }

    echo "<tr>";

    echo "<td>$month</td>";

    echo "<td>₹" . number_format($currentSales, 2) . "</td>";

    echo "<td>" . number_format($growth, 2) . "%</td>";

    echo "<td class='$class'>$trend</td>";

    echo "</tr>";

    $previousSales = $currentSales;
}

?>

</table>

<div class="summary">

    <p>
        💰 Total Sales:
        ₹<?php echo number_format($totalSales, 2); ?>
    </p>

    <p>
        📊 Average Sales:
        ₹<?php echo number_format($averageSales, 2); ?>
    </p>

    <p>
        🥇 Highest Sales:
        <?php echo $highestMonth; ?>
        (₹<?php echo number_format($highestSales, 2); ?>)
    </p>

    <p>
        📉 Lowest Sales:
        <?php echo $lowestMonth; ?>
        (₹<?php echo number_format($lowestSales, 2); ?>)
    </p>

</div>

<a href="index.html" class="back">
    ← Analyze Again
</a>

    </div>

</div>

</body>
</html>