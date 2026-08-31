<?php

// Store book information in an array
$books = [
    "Ponniyin Selvan",
    "Sivagamiyin Sabatham",
    "Parthiban Kanavu",
    "Velpari",
    "Yavana Rani",
    "Kadal Pura",
    "Kayalvizhi",
    "Vengayin Maindan"
];

// Get requested book title
$requested_book = trim($_POST["book_title"] ?? "");

// Search the book using array functions
$search_result = array_filter($books, function ($book) use ($requested_book) {
    return strtolower($book) == strtolower($requested_book);
});

// Check availability
if (!empty($search_result)) {
    $status = "Available";
    $message = "The requested book is available in the library.";
} else {
    $status = "Not Available";
    $message = "The requested book is not available in the library.";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Book Search Result</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .result {
            width: 650px;
            background: white;
            padding: 35px;
            border-radius: 15px;

            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .result h1 {
            text-align: center;
            color: #6d4c41;
            margin-bottom: 25px;
        }

        .search {
            background: #fff3e0;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .status {
            padding: 18px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .available {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .not-available {
            background: #ffebee;
            color: #c62828;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #6d4c41;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f5f5f5;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 12px;

            background: #6d4c41;
            color: white;

            text-decoration: none;
            border-radius: 7px;
        }

        .back:hover {
            background: #4e342e;
        }

    </style>

</head>

<body>

<div class="result">

    <h1>Book Search Result</h1>

    <div class="search">

        <strong>Requested Book:</strong>

        <?php
        echo htmlspecialchars($requested_book);
        ?>

    </div>

    <div class="status 
        <?php
        echo ($status == "Available")
            ? "available"
            : "not-available";
        ?>">

        <?php
        echo $message;
        ?>

    </div>

    <table>

        <tr>
            <th>S.No</th>
            <th>Historical Book</th>
        </tr>

        <?php

        $number = 1;

        foreach ($books as $book) {

            echo "<tr>";

            echo "<td>" . $number . "</td>";

            echo "<td>" . htmlspecialchars($book) . "</td>";

            echo "</tr>";

            $number++;
        }

        ?>

    </table>

    <a href="index.html" class="back">
        Search Another Book
    </a>

</div>

</body>
</html>