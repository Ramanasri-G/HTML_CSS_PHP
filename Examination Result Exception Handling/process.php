<?php

// Function to record runtime errors
function recordError($message)
{
    $logFile = "error_log.txt";

    $time = date("Y-m-d H:i:s");

    $errorMessage = "[" . $time . "] " . $message . PHP_EOL;

    file_put_contents($logFile, $errorMessage, FILE_APPEND);
}


// Custom exception class
class ResultException extends Exception
{
}


// Function to calculate result
function generateResult($marks)
{
    try {

        // Check for invalid marks
        foreach ($marks as $subject => $mark) {

            if (!is_numeric($mark)) {
                throw new ResultException(
                    "Invalid mark entered for " . $subject
                );
            }

            if ($mark < 0 || $mark > 100) {
                throw new ResultException(
                    "Mark for " . $subject . " must be between 0 and 100"
                );
            }
        }

        // Calculate total and average
        $total = array_sum($marks);

        $average = $total / count($marks);

        // Grade calculation
        if ($average >= 90) {
            $grade = "A+";
        } elseif ($average >= 80) {
            $grade = "A";
        } elseif ($average >= 70) {
            $grade = "B";
        } elseif ($average >= 60) {
            $grade = "C";
        } elseif ($average >= 50) {
            $grade = "D";
        } else {
            $grade = "F";
        }

        return [
            "total" => $total,
            "average" => $average,
            "grade" => $grade
        ];

    } catch (ResultException $e) {

        // Record error
        recordError($e->getMessage());

        // Continue processing
        return [
            "total" => 0,
            "average" => 0,
            "grade" => "Error"
        ];
    }
}


// Check request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        $name = trim($_POST["name"] ?? "");
        $register_no = trim($_POST["register_no"] ?? "");

        if ($name == "" || $register_no == "") {
            throw new ResultException(
                "Student name and register number are required."
            );
        }

        // Store marks in an array
        $marks = [
            "PHP" => $_POST["php"] ?? "",
            "Database" => $_POST["database"] ?? "",
            "Web Technology" => $_POST["web"] ?? "",
            "Java" => $_POST["java"] ?? ""
        ];

        // Generate result
        $result = generateResult($marks);

    } catch (ResultException $e) {

        recordError($e->getMessage());

        $error = $e->getMessage();

    } catch (Exception $e) {

        recordError("Unexpected runtime error: " . $e->getMessage());

        $error = "An unexpected error occurred. Result processing continued.";

    }

} else {

    $error = "Invalid request.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Examination Result</title>
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
            color: #6a1b9a;
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

        .student {
            background: #f3e5f5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .student p {
            text-align: left;
            margin: 7px 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #6a1b9a;
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

        .grade {
            font-size: 20px;
            font-weight: bold;
            color: #6a1b9a;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 12px;
            background: #6a1b9a;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .back:hover {
            background: #4a148c;
        }
    </style>
</head>

<body>

<div class="result">

    <h1>Examination Result</h1>

    <?php if (isset($result)) { ?>

        <div class="success">
            Result generated successfully.
        </div>

        <div class="student">
            <p><strong>Student Name:</strong>
                <?php echo htmlspecialchars($name); ?>
            </p>

            <p><strong>Register Number:</strong>
                <?php echo htmlspecialchars($register_no); ?>
            </p>
        </div>

        <table>

            <tr>
                <th>Subject</th>
                <th>Marks</th>
            </tr>

            <?php foreach ($marks as $subject => $mark) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($subject); ?></td>
                    <td><?php echo htmlspecialchars($mark); ?></td>
                </tr>

            <?php } ?>

            <tr>
                <th>Total</th>
                <th><?php echo $result["total"]; ?></th>
            </tr>

            <tr>
                <th>Average</th>
                <th>
                    <?php echo number_format($result["average"], 2); ?>
                </th>
            </tr>

            <tr>
                <th>Grade</th>
                <th class="grade">
                    <?php echo $result["grade"]; ?>
                </th>
            </tr>

        </table>

    <?php } else { ?>

        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php } ?>

    <a href="index.html" class="back">
        Process Another Result
    </a>

</div>

</body>
</html>