<!DOCTYPE html>
<html>
<head>
    <title>Sorted Product List</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .result {
            width: 650px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .result h1 {
            color: #4a148c;
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #7b1fa2;
            color: white;
            padding: 13px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f3e5f5;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 12px;
            background: #4a148c;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }
    </style>
</head>

<body>

<div class="result">

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Store product details in an array
    $products = [
        [
            "name" => $_POST["product1"],
            "price" => (float)$_POST["price1"]
        ],
        [
            "name" => $_POST["product2"],
            "price" => (float)$_POST["price2"]
        ],
        [
            "name" => $_POST["product3"],
            "price" => (float)$_POST["price3"]
        ],
        [
            "name" => $_POST["product4"],
            "price" => (float)$_POST["price4"]
        ]
    ];

    // Sort products based on price
    usort($products, function ($a, $b) {
        return $a["price"] <=> $b["price"];
    });

    echo "<h1>Sorted Product List</h1>";

    echo "<table>";
    echo "<tr>";
    echo "<th>Rank</th>";
    echo "<th>Product Name</th>";
    echo "<th>Price (₹)</th>";
    echo "</tr>";

    $rank = 1;

    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . $rank . "</td>";
        echo "<td>" . htmlspecialchars($product["name"]) . "</td>";
        echo "<td>₹" . number_format($product["price"], 2) . "</td>";
        echo "</tr>";

        $rank++;
    }

    echo "</table>";

    echo "<a class='back' href='index.html'>Sort Another List</a>";

} else {
    echo "<h1>Invalid Request</h1>";
    echo "<a class='back' href='index.html'>Go Back</a>";
}

?>

</div>

</body>
</html>