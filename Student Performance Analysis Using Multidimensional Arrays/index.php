<!DOCTYPE html>
<html>
<head>
    <title>Student Performance Analysis</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Student Performance Analysis</h1>

    <form action="process.php" method="post">

        <label>Student 1 Name</label>
        <input type="text" name="name1" required>

        <label>PHP Mark</label>
        <input type="number" name="php1" min="0" max="100" required>

        <label>Java Mark</label>
        <input type="number" name="java1" min="0" max="100" required>

        <label>Database Mark</label>
        <input type="number" name="db1" min="0" max="100" required>

        <label>Web Technology Mark</label>
        <input type="number" name="web1" min="0" max="100" required>


        <label>Student 2 Name</label>
        <input type="text" name="name2" required>

        <label>PHP Mark</label>
        <input type="number" name="php2" min="0" max="100" required>

        <label>Java Mark</label>
        <input type="number" name="java2" min="0" max="100" required>

        <label>Database Mark</label>
        <input type="number" name="db2" min="0" max="100" required>

        <label>Web Technology Mark</label>
        <input type="number" name="web2" min="0" max="100" required>


        <label>Student 3 Name</label>
        <input type="text" name="name3" required>

        <label>PHP Mark</label>
        <input type="number" name="php3" min="0" max="100" required>

        <label>Java Mark</label>
        <input type="number" name="java3" min="0" max="100" required>

        <label>Database Mark</label>
        <input type="number" name="db3" min="0" max="100" required>

        <label>Web Technology Mark</label>
        <input type="number" name="web3" min="0" max="100" required>

        <button type="submit">Generate Performance Report</button>

    </form>

</div>

</body>
</html>