<?php

class PatientException extends Exception {}

$message = "";
$patient = [];

try {

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new PatientException("Invalid request.");
    }

    // Get and clean input
    $name = trim($_POST["name"] ?? "");
    $age = $_POST["age"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $patient_id = trim($_POST["patient_id"] ?? "");
    $blood_group = $_POST["blood_group"] ?? "";
    $diagnosis = trim($_POST["diagnosis"] ?? "");

    // Validation
    if ($name == "") {
        throw new PatientException("Patient name is required.");
    }

    if (!is_numeric($age) || $age < 1 || $age > 120) {
        throw new PatientException("Age must be between 1 and 120.");
    }

    $valid_genders = ["Male", "Female", "Other"];

    if (!in_array($gender, $valid_genders)) {
        throw new PatientException("Invalid gender selected.");
    }

    if ($patient_id == "") {
        throw new PatientException("Patient ID is required.");
    }

    $valid_blood_groups = [
        "A+", "A-", "B+", "B-",
        "AB+", "AB-", "O+", "O-"
    ];

    if (!in_array($blood_group, $valid_blood_groups)) {
        throw new PatientException("Invalid blood group.");
    }

    if ($diagnosis == "") {
        throw new PatientException("Diagnosis is required.");
    }

    // Store patient details in an array
    $patient = [
        "Patient ID" => $patient_id,
        "Patient Name" => $name,
        "Age" => $age,
        "Gender" => $gender,
        "Blood Group" => $blood_group,
        "Diagnosis" => $diagnosis
    ];

    $message = "Patient record processed successfully.";

} catch (PatientException $e) {

    $message = "Error: " . $e->getMessage();

} catch (Exception $e) {

    $message = "Unexpected error occurred while processing the record.";

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Processing Result</title>
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
            color: #1565c0;
            margin-bottom: 20px;
        }

        .success {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1565c0;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f5f5f5;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
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

<div class="result">

    <h1>Patient Record Result</h1>

    <?php if (!empty($patient)) { ?>

        <div class="success">
            <?php echo htmlspecialchars($message); ?>
        </div>

        <table>
            <tr>
                <th>Field</th>
                <th>Patient Details</th>
            </tr>

            <?php foreach ($patient as $field => $value) { ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($field); ?></strong></td>
                    <td><?php echo htmlspecialchars($value); ?></td>
                </tr>
            <?php } ?>

        </table>

    <?php } else { ?>

        <div class="error">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php } ?>

    <a href="index.html" class="back">Process Another Patient</a>

</div>

</body>
</html>