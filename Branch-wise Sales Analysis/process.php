<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Consolidated Sales Report</h1>

<?php

// Multidimensional Array

$sales = [

    "Chennai" => [
        "Product 1" => $_POST["chennai_p1"],
        "Product 2" => $_POST["chennai_p2"],
        "Product 3" => $_POST["chennai_p3"]
    ],

    "Coimbatore" => [
        "Product 1" => $_POST["coimbatore_p1"],
        "Product 2" => $_POST["coimbatore_p2"],
        "Product 3" => $_POST["coimbatore_p3"]
    ],

    "Salem" => [
        "Product 1" => $_POST["salem_p1"],
        "Product 2" => $_POST["salem_p2"],
        "Product 3" => $_POST["salem_p3"]
    ]

];


// Branch-wise Sales Report

echo "<h2>Branch-wise Sales</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Branch</th>";
echo "<th>Product 1</th>";
echo "<th>Product 2</th>";
echo "<th>Product 3</th>";
echo "<th>Total Sales</th>";
echo "</tr>";

$branchTotals = [];

foreach ($sales as $branch => $products) {

    // array_sum() calculates total sales
    $total = array_sum($products);

    $branchTotals[$branch] = $total;

    echo "<tr>";

    echo "<td>" . $branch . "</td>";

    foreach ($products as $amount) {
        echo "<td>₹" . $amount . "</td>";
    }

    echo "<td><b>₹" . $total . "</b></td>";

    echo "</tr>";
}

echo "</table>";


// Compare Branch Sales

echo "<h2>Branch Comparison</h2>";

$highestSales = max($branchTotals);
$lowestSales = min($branchTotals);

$highestBranch = array_search($highestSales, $branchTotals);
$lowestBranch = array_search($lowestSales, $branchTotals);

echo "<div class='result'>";
echo "Highest Sales Branch: <b>" . $highestBranch . "</b><br>";
echo "Highest Sales: <b>₹" . $highestSales . "</b><br><br>";

echo "Lowest Sales Branch: <b>" . $lowestBranch . "</b><br>";
echo "Lowest Sales: <b>₹" . $lowestSales . "</b>";
echo "</div>";


// Consolidated Sales

$totalSales = array_sum($branchTotals);

$averageSales = $totalSales / count($branchTotals);

echo "<h2>Consolidated Summary</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Total Sales</th>";
echo "<th>Average Branch Sales</th>";
echo "<th>Number of Branches</th>";
echo "</tr>";

echo "<tr>";
echo "<td>₹" . $totalSales . "</td>";
echo "<td>₹" . number_format($averageSales, 2) . "</td>";
echo "<td>" . count($sales) . "</td>";
echo "</tr>";

echo "</table>";

?>

<a href="index.php">
    <button>Back to Home</button>
</a>

</div>

</body>
</html>