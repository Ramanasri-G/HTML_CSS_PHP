<html>

<head>

    <title>Course Enrolment Report</title>

    <style>

        body{
            font-family:Arial;
            background:#E0F2F1;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .box{
            background:white;
            width:650px;
            padding:30px;
            border-radius:10px;
            text-align:center;
            box-shadow:0 5px 12px rgba(0,0,0,0.2);
        }

        h2{
            color:#00695C;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th,td{
            border:1px solid #ccc;
            padding:12px;
        }

        th{
            background:#00695C;
            color:white;
        }

        tr:nth-child(even){
            background:#E0F2F1;
        }

        .result{
            margin-top:20px;
            padding:20px;
            background:#E0F2F1;
            border-radius:5px;
        }

        .success{
            color:#00695C;
            font-weight:bold;
        }

        a{
            display:inline-block;
            text-decoration:none;
            background:#00695C;
            color:white;
            padding:10px 20px;
            border-radius:5px;
            margin-top:20px;
        }

    </style>

</head>

<body>

<div class="box">

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $course1 = trim($_POST["course1"]);
    $students1 = trim($_POST["students1"]);

    $course2 = trim($_POST["course2"]);
    $students2 = trim($_POST["students2"]);

    $course3 = trim($_POST["course3"]);
    $students3 = trim($_POST["students3"]);

    $course4 = trim($_POST["course4"]);
    $students4 = trim($_POST["students4"]);


    // Validate fields

    if(empty($course1) || $students1 == "" ||
       empty($course2) || $students2 == "" ||
       empty($course3) || $students3 == "" ||
       empty($course4) || $students4 == "")
    {

        echo "<h2 style='color:red;'>Analysis Failed</h2>";

        echo "<p>Please enter all course details.</p>";

    }

    else
    {

        // Course Enrolment Array

        $enrolment = array(

            $course1 => $students1,

            $course2 => $students2,

            $course3 => $students3,

            $course4 => $students4

        );


        // Calculate Total Students

        $totalStudents = array_sum($enrolment);


        // Find Most Popular Course

        $highestStudents = max($enrolment);

        $popularCourse = array_search(
            $highestStudents,
            $enrolment
        );


        // Calculate Average Enrolment

        $averageStudents =
            $totalStudents / count($enrolment);


        // Display Report

        echo "<h2>Course Enrolment Summary</h2>";

        echo "<table>";

        echo "<tr>";
        echo "<th>Course Name</th>";
        echo "<th>Students Enrolled</th>";
        echo "</tr>";


        foreach($enrolment as $course => $students)
        {

            echo "<tr>";

            echo "<td>$course</td>";

            echo "<td>$students</td>";

            echo "</tr>";

        }

        echo "</table>";


        // Summary

        echo "<div class='result'>";

        echo "<h3>Enrolment Analysis</h3>";

        echo "<p><b>Total Students:</b> $totalStudents</p>";

        echo "<p><b>Total Courses:</b> "
             . count($enrolment)
             . "</p>";

        echo "<p><b>Average Enrolment:</b> "
             . number_format($averageStudents, 2)
             . "</p>";

        echo "<p class='success'>
                Most Popular Course: $popularCourse
              </p>";

        echo "<p>
                <b>Students in Popular Course:</b>
                $highestStudents
              </p>";

        echo "</div>";

    }

}

?>

<a href="index.html">Back</a>

</div>

</body>

</html>