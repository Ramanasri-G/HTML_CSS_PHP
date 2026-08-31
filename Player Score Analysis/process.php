<!DOCTYPE html>
<html>
<head>
    <title>Score Analysis Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>🏆 Score Analysis Report</h1>
        <p>Player Performance Statistics</p>
    </div>

    <div class="report">

<?php

// Store player scores in an array

$scores = [
    "Player 1" => (int)$_POST["score1"],
    "Player 2" => (int)$_POST["score2"],
    "Player 3" => (int)$_POST["score3"],
    "Player 4" => (int)$_POST["score4"],
    "Player 5" => (int)$_POST["score5"]
];

/* Extract only scores */

$scoreValues = array_values($scores);

/* Calculate highest, lowest and average */

$highest = max($scoreValues);
$lowest = min($scoreValues);
$average = array_sum($scoreValues) / count($scoreValues);

?>

<h2>📊 Player Scores</h2>

<table>

<tr>
    <th>Player</th>
    <th>Score</th>
</tr>

<?php

foreach ($scores as $player => $score) {

    echo "<tr>";
    echo "<td>$player</td>";
    echo "<td>$score</td>";
    echo "</tr>";
}

?>

</table>

<div class="result">

    <p>🥇 Highest Score:
        <?php echo $highest; ?>
    </p>

    <p>📉 Lowest Score:
        <?php echo $lowest; ?>
    </p>

    <p>📈 Average Score:
        <?php echo number_format($average, 2); ?>
    </p>

</div>

<a href="index.html" class="back">
    ← Analyze Again
</a>

    </div>

</div>

</body>
</html>