<!DOCTYPE html>
<html>
<head>
    <title>Music Search Result</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>🎵 Music Search & Playlist Analysis</h1>

<?php

// Song details stored in a multidimensional array

$playlist = [
    [
        "title" => "Shape of You",
        "artist" => "Ed Sheeran",
        "album" => "Divide",
        "genre" => "Pop"
    ],
    [
        "title" => "Believer",
        "artist" => "Imagine Dragons",
        "album" => "Evolve",
        "genre" => "Rock"
    ],
    [
        "title" => "Perfect",
        "artist" => "Ed Sheeran",
        "album" => "Divide",
        "genre" => "Pop"
    ],
    [
        "title" => "Blinding Lights",
        "artist" => "The Weeknd",
        "album" => "After Hours",
        "genre" => "Pop"
    ],
    [
        "title" => "Senorita",
        "artist" => "Shawn Mendes",
        "album" => "Shawn Mendes",
        "genre" => "Pop"
    ]
];

// Count total songs

$totalSongs = count($playlist);

// Search song

if (isset($_POST["search"])) {

    $searchSong = trim($_POST["song"]);
    $found = false;

    foreach ($playlist as $song) {

        if (strcasecmp($song["title"], $searchSong) == 0) {

            $found = true;

            echo "<div class='result'>";

            echo "<h2>🎶 Song Found</h2>";

            echo "<table>";

            echo "<tr>
                    <th>Song</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                  </tr>";

            echo "<tr>";

            echo "<td>" . $song["title"] . "</td>";
            echo "<td>" . $song["artist"] . "</td>";
            echo "<td>" . $song["album"] . "</td>";
            echo "<td>" . $song["genre"] . "</td>";

            echo "</tr>";

            echo "</table>";

            echo "</div>";

            break;
        }
    }

    if (!$found) {

        echo "<div class='notfound'>";
        echo "❌ Song not found in the playlist.";
        echo "</div>";
    }
}

?>

<h2>📊 Playlist Analysis</h2>

<div class="result">
    <h3>Total Songs Available: <?php echo $totalSongs; ?></h3>
</div>

<h2>🎼 Available Playlist</h2>

<table>

<tr>
    <th>S.No</th>
    <th>Song</th>
    <th>Artist</th>
    <th>Album</th>
    <th>Genre</th>
</tr>

<?php

$i = 1;

foreach ($playlist as $song) {

    echo "<tr>";

    echo "<td>" . $i . "</td>";
    echo "<td>" . $song["title"] . "</td>";
    echo "<td>" . $song["artist"] . "</td>";
    echo "<td>" . $song["album"] . "</td>";
    echo "<td>" . $song["genre"] . "</td>";

    echo "</tr>";

    $i++;
}

?>

</table>

<a href="index.html" class="back">← Search Again</a>

</div>

</body>
</html>