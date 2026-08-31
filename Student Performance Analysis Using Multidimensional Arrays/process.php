<!DOCTYPE html>
<html>
<head>
    <title>Performance Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Student Performance Report</h1>

<?php

// Multidimensional Array

$students = [

    [
        "name" => $_POST["name1"],
        "marks" => [
            "PHP" => $_POST["php1"],
            "Java" => $_POST["java1"],
            "Database" => $_POST["db1"],
            "Web Technology" => $_POST["web1"]
        ]
    ],

    [
        "name" => $_POST["name2"],
        "marks" => [
            "PHP" => $_POST["php2"],
            "Java" => $_POST["java2"],
            "Database" => $_POST["db2"],
            "Web Technology" => $_POST["web2"]
        ]
    ],

    [
        "name" => $_POST["name3"],
        "marks" => [
            "PHP" => $_POST["php3"],
            "Java" => $_POST["java3"],
            "Database" => $_POST["db3"],
            "Web Technology" => $_POST["web3"]
        ]
    ]

];

$subjects = ["PHP", "Java", "Database", "Web Technology"];


// Student Performance Table

echo "<h2>Student Details</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Name</th>";
echo "<th>PHP</th>";
echo "<th>Java</th>";
echo "<th>Database</th>";
echo "<th>Web Technology</th>";
echo "<th>Total</th>";
echo "<th>Average</th>";
echo "<th>Result</th>";
echo "</tr>";


foreach ($students as $student) {

    $total = array_sum($student["marks"]);
    $average = $total / count($subjects);

    if ($average >= 50) {
        $result = "PASS";
    } else {
        $result = "FAIL";
    }

    echo "<tr>";

    echo "<td>" . $student["name"] . "</td>";

    foreach ($student["marks"] as $mark) {
        echo "<td>" . $mark . "</td>";
    }

    echo "<td>" . $total . "</td>";
    echo "<td>" . number_format($average, 2) . "</td>";
    echo "<td>" . $result . "</td>";

    echo "</tr>";
}

echo "</table>";


// Subject-wise Toppers

echo "<h2>Subject-wise Toppers</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Subject</th>";
echo "<th>Topper</th>";
echo "<th>Highest Mark</th>";
echo "</tr>";


foreach ($subjects as $subject) {

    $highest = 0;
    $topper = "";

    foreach ($students as $student) {

        $mark = $student["marks"][$subject];

        if ($mark > $highest) {
            $highest = $mark;
            $topper = $student["name"];
        }
    }

    echo "<tr>";
    echo "<td>" . $subject . "</td>";
    echo "<td>" . $topper . "</td>";
    echo "<td>" . $highest . "</td>";
    echo "</tr>";
}

echo "</table>";


// Class Average

echo "<h2>Class Average</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Subject</th>";
echo "<th>Class Average</th>";
echo "</tr>";


foreach ($subjects as $subject) {

    $totalMarks = 0;

    foreach ($students as $student) {
        $totalMarks += $student["marks"][$subject];
    }

    $classAverage = $totalMarks / count($students);

    echo "<tr>";
    echo "<td>" . $subject . "</td>";
    echo "<td>" . number_format($classAverage, 2) . "</td>";
    echo "</tr>";
}

echo "</table>";

?>

<a href="index.php">
    <button>Back to Home</button>
</a>

</div>

</body>
</html>