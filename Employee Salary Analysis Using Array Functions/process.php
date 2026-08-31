<html>
<head>

<title>Employee Salary Report</title>

<style>

body{
    font-family:Arial;
    background:#EDE7F6;
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
    color:#6A1B9A;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th,td{
    border:1px solid #ccc;
    padding:10px;
}

th{
    background:#6A1B9A;
    color:white;
}

tr:nth-child(even){
    background:#F3E5F5;
}

.result{
    margin-top:20px;
    padding:15px;
    background:#EDE7F6;
    border-radius:5px;
}

a{
    display:inline-block;
    text-decoration:none;
    background:#6A1B9A;
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

if($_SERVER["REQUEST_METHOD"]=="POST")
{

$name1=trim($_POST["name1"]);
$id1=trim($_POST["id1"]);
$salary1=trim($_POST["salary1"]);

$name2=trim($_POST["name2"]);
$id2=trim($_POST["id2"]);
$salary2=trim($_POST["salary2"]);

$name3=trim($_POST["name3"]);
$id3=trim($_POST["id3"]);
$salary3=trim($_POST["salary3"]);


if(empty($name1) || empty($id1) || empty($salary1) ||
   empty($name2) || empty($id2) || empty($salary2) ||
   empty($name3) || empty($id3) || empty($salary3))
{
    echo "<h2 style='color:red;'>Analysis Failed</h2>";
    echo "<p>Please fill all the required fields.</p>";
}

else
{

// Employee Details Array

$employees=array(

    array(
        "name"=>$name1,
        "id"=>$id1,
        "salary"=>$salary1
    ),

    array(
        "name"=>$name2,
        "id"=>$id2,
        "salary"=>$salary2
    ),

    array(
        "name"=>$name3,
        "id"=>$id3,
        "salary"=>$salary3
    )

);


// Store Salaries in Separate Array

$salaries=array_column($employees,"salary");


// Highest Salary

$highestSalary=max($salaries);


// Lowest Salary

$lowestSalary=min($salaries);


// Average Salary

$averageSalary=array_sum($salaries)/count($salaries);


// Find Employee with Highest Salary

$highestIndex=array_search($highestSalary,$salaries);

$highestEmployee=$employees[$highestIndex]["name"];


// Find Employee with Lowest Salary

$lowestIndex=array_search($lowestSalary,$salaries);

$lowestEmployee=$employees[$lowestIndex]["name"];


echo "<h2>Employee Salary Report</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Employee ID</th>";
echo "<th>Name</th>";
echo "<th>Salary</th>";
echo "</tr>";


foreach($employees as $employee)
{

echo "<tr>";

echo "<td>".$employee["id"]."</td>";

echo "<td>".$employee["name"]."</td>";

echo "<td>₹".$employee["salary"]."</td>";

echo "</tr>";

}

echo "</table>";


echo "<div class='result'>";

echo "<h3>Salary Analysis</h3>";

echo "<p><b>Highest Salary:</b> ₹$highestSalary</p>";

echo "<p><b>Highest Paid Employee:</b> $highestEmployee</p>";

echo "<p><b>Lowest Salary:</b> ₹$lowestSalary</p>";

echo "<p><b>Lowest Paid Employee:</b> $lowestEmployee</p>";

echo "<p><b>Average Salary:</b> ₹".number_format($averageSalary,2)."</p>";

echo "</div>";

}

}

?>

<br>

<a href="index.html">Back</a>

</div>

</body>
</html>