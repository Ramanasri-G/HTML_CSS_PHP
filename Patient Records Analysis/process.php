<?php

// Get patient data from the form
$patients = [
    [
        "name" => $_POST["name1"],
        "age" => $_POST["age1"],
        "department" => $_POST["department1"],
        "treatment" => $_POST["treatment1"]
    ],
    [
        "name" => $_POST["name2"],
        "age" => $_POST["age2"],
        "department" => $_POST["department2"],
        "treatment" => $_POST["treatment2"]
    ],
    [
        "name" => $_POST["name3"],
        "age" => $_POST["age3"],
        "department" => $_POST["department3"],
        "treatment" => $_POST["treatment3"]
    ]
];


// Department-wise analysis
$departmentReport = [];

foreach ($patients as $patient) {

    $department = $patient["department"];

    if (!isset($departmentReport[$department])) {

        $departmentReport[$department] = [
            "count" => 0,
            "totalAge" => 0,
            "treatments" => []
        ];
    }

    $departmentReport[$department]["count"]++;
    $departmentReport[$department]["totalAge"] += $patient["age"];

    $treatment = $patient["treatment"];

    if (!isset($departmentReport[$department]["treatments"][$treatment])) {
        $departmentReport[$department]["treatments"][$treatment] = 0;
    }

    $departmentReport[$department]["treatments"][$treatment]++;
}


// Overall calculations
$totalPatients = count($patients);

$totalAge = 0;

foreach ($patients as $patient) {
    $totalAge += $patient["age"];
}

$averageAge = $totalAge / $totalPatients;

?>

<!DOCTYPE html>
<html>

<head>

    <title>Patient Report</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #E8F5E9, #E3F2FD);
            min-height: 100vh;
            padding: 40px 20px;
            color: #263238;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            background: linear-gradient(135deg, #00695C, #00897B);
            color: white;
            padding: 25px 30px;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
        }

        .content {
            background: white;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.12);
        }

        .title {
            border-left: 5px solid #00897B;
            padding-left: 15px;
            margin-bottom: 25px;
        }

        .title h2 {
            color: #00695C;
            font-size: 22px;
        }

        .title p {
            color: #78909C;
            margin-top: 5px;
        }

        /* Summary Cards */

        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            padding: 20px;
            border-radius: 10px;
            background: #E0F2F1;
            border-left: 5px solid #00897B;
            text-align: center;
        }

        .summary-card h3 {
            color: #00695C;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .summary-card p {
            font-size: 28px;
            font-weight: bold;
            color: #263238;
        }

        /* Patient Table */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 35px;
        }

        th {
            background: #00695C;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #E0E0E0;
        }

        tr:nth-child(even) {
            background: #F5FAFA;
        }

        /* Department Report */

        .department-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .department-card {
            border: 1px solid #B2DFDB;
            border-radius: 10px;
            padding: 20px;
            background: #FAFFFF;
        }

        .department-card h3 {
            color: #00695C;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .department-card p {
            margin: 8px 0;
            color: #455A64;
        }

        .treatment {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #E0E0E0;
        }

        .treatment strong {
            color: #00695C;
        }

        /* Back Button */

        .button-area {
            text-align: center;
            margin-top: 30px;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #00695C, #00897B);
            color: white;
            text-decoration: none;
            padding: 13px 30px;
            border-radius: 8px;
            font-weight: bold;
        }

        .button:hover {
            background: #004D40;
        }

        .footer {
            background: #263238;
            color: #CFD8DC;
            text-align: center;
            padding: 15px;
            border-radius: 0 0 15px 15px;
            font-size: 13px;
        }

        @media(max-width: 700px) {

            .summary {
                grid-template-columns: 1fr;
            }

            .department-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }

            table {
                font-size: 13px;
            }

        }

    </style>

</head>


<body>

<div class="container">

    <div class="header">

        <h1>Patient Records Analysis</h1>

        <p>Patient Information & Department-wise Treatment Report</p>

    </div>


    <div class="content">

        <div class="title">

            <h2>Patient Report</h2>

            <p>Summary of registered patient records</p>

        </div>


        <!-- Summary -->

        <div class="summary">

            <div class="summary-card">

                <h3>Total Patients</h3>

                <p><?php echo $totalPatients; ?></p>

            </div>


            <div class="summary-card">

                <h3>Total Age</h3>

                <p><?php echo $totalAge; ?></p>

            </div>


            <div class="summary-card">

                <h3>Average Age</h3>

                <p><?php echo number_format($averageAge, 2); ?></p>

            </div>

        </div>


        <!-- Patient Records -->

        <div class="title">

            <h2>Patient Records</h2>

            <p>Individual patient information</p>

        </div>


        <table>

            <tr>

                <th>No.</th>

                <th>Patient Name</th>

                <th>Age</th>

                <th>Department</th>

                <th>Treatment</th>

            </tr>


            <?php

            $number = 1;

            foreach ($patients as $patient) {

            ?>

            <tr>

                <td><?php echo $number; ?></td>

                <td><?php echo htmlspecialchars($patient["name"]); ?></td>

                <td><?php echo $patient["age"]; ?></td>

                <td><?php echo htmlspecialchars($patient["department"]); ?></td>

                <td><?php echo htmlspecialchars($patient["treatment"]); ?></td>

            </tr>

            <?php

                $number++;

            }

            ?>

        </table>


        <!-- Department Report -->

        <div class="title">

            <h2>Department-wise Analysis</h2>

            <p>Patient distribution and treatment information</p>

        </div>


        <div class="department-grid">

            <?php foreach ($departmentReport as $department => $data) { ?>

                <div class="department-card">

                    <h3>
                        <?php echo htmlspecialchars($department); ?>
                    </h3>

                    <p>
                        <strong>Number of Patients:</strong>
                        <?php echo $data["count"]; ?>
                    </p>

                    <p>
                        <strong>Average Age:</strong>
                        <?php
                        echo number_format(
                            $data["totalAge"] / $data["count"],
                            2
                        );
                        ?>
                    </p>


                    <div class="treatment">

                        <strong>Treatments:</strong>

                        <?php

                        foreach ($data["treatments"] as $treatment => $count) {

                            echo "<p>" .
                                 htmlspecialchars($treatment) .
                                 " : " .
                                 $count .
                                 "</p>";

                        }

                        ?>

                    </div>

                </div>

            <?php } ?>

        </div>


        <div class="button-area">

            <a href="index.html" class="button">
                ← Back to Patient Form
            </a>

        </div>

    </div>


    <div class="footer">

        Patient Records Analysis System © 2026

    </div>

</div>

</body>

</html>