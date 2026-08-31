<html>
<head>

<title>Password Validation Result</title>

<style>

body{
    font-family:Arial;
    background:#FFF3E0;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.box{
    background:white;
    width:500px;
    padding:30px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

h2{
    color:#E65100;
    margin-bottom:20px;
}

p{
    margin:12px;
}

.valid{
    color:#2E7D32;
    background:#E8F5E9;
    padding:12px;
    border-radius:6px;
    font-weight:bold;
}

.invalid{
    color:#C62828;
    background:#FFEBEE;
    padding:12px;
    border-radius:6px;
    font-weight:bold;
}

.rules{
    text-align:left;
    background:#FFF8E1;
    padding:15px;
    margin-top:20px;
    border-radius:6px;
}

a{
    display:inline-block;
    text-decoration:none;
    background:#E65100;
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

$name=trim($_POST["name"]);
$empid=trim($_POST["empid"]);
$password=$_POST["password"];


// Regular Expression Security Rules

$length=preg_match("/^.{8,}$/",$password);

$uppercase=preg_match("/[A-Z]/",$password);

$lowercase=preg_match("/[a-z]/",$password);

$number=preg_match("/[0-9]/",$password);

$special=preg_match("/[@$!%*?&]/",$password);


if(empty($name) || empty($empid) || empty($password))
{

    echo "<h2 style='color:red;'>Validation Failed</h2>";

    echo "<p>Please fill all the required fields.</p>";

}

else
{

    echo "<h2>Password Validation Result</h2>";

    echo "<p><b>Employee Name:</b> $name</p>";

    echo "<p><b>Employee ID:</b> $empid</p>";


    echo "<div class='rules'>";

    echo "<h3>Password Security Rules</h3>";

    echo "<p>Minimum 8 characters: " .
         ($length ? "✔ Passed" : "✘ Failed") .
         "</p>";

    echo "<p>At least one uppercase letter: " .
         ($uppercase ? "✔ Passed" : "✘ Failed") .
         "</p>";

    echo "<p>At least one lowercase letter: " .
         ($lowercase ? "✔ Passed" : "✘ Failed") .
         "</p>";

    echo "<p>At least one number: " .
         ($number ? "✔ Passed" : "✘ Failed") .
         "</p>";

    echo "<p>At least one special character: " .
         ($special ? "✔ Passed" : "✘ Failed") .
         "</p>";

    echo "</div>";


    if($length && $uppercase && $lowercase && $number && $special)
    {

        echo "<p class='valid'>✔ Password is VALID and STRONG</p>";

    }
    else
    {

        echo "<p class='invalid'>✘ Password is INVALID</p>";

    }

}

}

?>

<a href="index.html">Back</a>

</div>

</body>
</html>