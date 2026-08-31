<?php

// Multidimensional array for student placement data
$students = [];

$names = $_POST["name"];
$departments = $_POST["department"];
$packages = $_POST["package"];

for ($i = 0; $i < count($names); $i++) {

    $students[] = [
        "name" => $names[$i],
        "department" => $departments[$i],
        "package" => (float)$packages[$i]
    ];
}


// Sort students by package in descending order
usort($students, function ($a, $b) {
    return $b["package"] <=> $a["package"];
});


// Calculate statistics
$total_students = count($students);

$total_package = array_sum(
    array_column($students, "package")
);

$average_package = $total_package / $total_students;

$highest_package = max(
    array_column($students, "package")
);

$highest_package = round($highest_package, 2);


// Department-wise grouping
$departments_data = [];

foreach ($students as $student) {

    $dept = $student["department"];

    if (!isset($departments_data[$dept])) {
        $departments_data[$dept] = [];
    }

    $departments_data[$dept][] = $student;
}


// Sort each department by package
foreach ($departments_data as $dept => &$data) {

    usort($data, function ($a, $b) {
        return $b["package"] <=> $a["package"];
    });
}

unset($data);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Placement Report</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .report {
            width: 900px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .report h1 {
            text-align: center;
            color: #283593;
            margin-bottom: 25px;
        }

        .summary {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1;
            padding: 20px;
            background: #e8eaf6;
            border-radius: 10px;
            text-align: center;
        }

        .card h3 {
            color: #283593;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        h2 {
            color: #283593;
            margin: 25px 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background: #283593;
            color: white;
            padding: 12px;
        }

        td {
            padding: 11px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f5f5f5;
        }

        .rank {
            font-weight: bold;
            color: #283593;
        }

        .back {
            display: block;
            width: 250px;
            margin: 25px auto 0;
            padding: 12px;
            background: #283593;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 7px;
        }

        .back:hover {
            background: #1a237e;
        }

    </style>

</head>

<body>

<div class="report">

    <h1>Student Placement Report</h1>


    <!-- Overall Statistics -->

    <div class="summary">

        <div class="card">
            <h3>Total Students</h3>
            <p><?php echo $total_students; ?></p>
        </div>

        <div class="card">
            <h3>Average Package</h3>
            <p><?php echo number_format($average_package, 2); ?> LPA</p>
        </div>

        <div class="card">
            <h3>Highest Package</h3>
            <p><?php echo number_format($highest_package, 2); ?> LPA</p>
        </div>

    </div>


    <!-- Overall Ranking -->

    <h2>Overall Student Ranking</h2>

    <table>

        <tr>
            <th>Rank</th>
            <th>Student Name</th>
            <th>Department</th>
            <th>Package (LPA)</th>
        </tr>

        <?php

        $rank = 1;

        foreach ($students as $student) {

            echo "<tr>";

            echo "<td class='rank'>" . $rank . "</td>";

            echo "<td>" .
                htmlspecialchars($student["name"]) .
                "</td>";

            echo "<td>" .
                htmlspecialchars($student["department"]) .
                "</td>";

            echo "<td>" .
                number_format($student["package"], 2) .
                "</td>";

            echo "</tr>";

            $rank++;
        }

        ?>

    </table>


    <!-- Department-wise Rankings -->

    <h2>Department-wise Rankings</h2>

    <?php foreach ($departments_data as $dept => $data) { ?>

        <h3 style="margin:15px 0;color:#444;">
            <?php echo htmlspecialchars($dept); ?>
        </h3>

        <table>

            <tr>
                <th>Rank</th>
                <th>Student Name</th>
                <th>Package (LPA)</th>
            </tr>

            <?php

            $dept_rank = 1;

            foreach ($data as $student) {

                echo "<tr>";

                echo "<td class='rank'>" .
                    $dept_rank .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($student["name"]) .
                    "</td>";

                echo "<td>" .
                    number_format($student["package"], 2) .
                    "</td>";

                echo "</tr>";

                $dept_rank++;
            }

            ?>

        </table>

    <?php } ?>


    <a href="index.html" class="back">
        Enter New Placement Data
    </a>

</div>

</body>
</html>