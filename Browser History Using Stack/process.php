<?php

session_start();

/* Create browser history stack */

if (!isset($_SESSION["history"])) {

    $_SESSION["history"] = [
        "Google",
        "YouTube",
        "Wikipedia"
    ];
}

$message = "";

$operation = $_POST["operation"] ?? "";
$page = trim($_POST["page"] ?? "");


/* Visit Page - PUSH */

if ($operation == "visit" && $page != "") {

    array_push($_SESSION["history"], $page);

    $message = "$page added to browser history.";
}


/* Go Back - POP */

elseif ($operation == "back") {

    if (count($_SESSION["history"]) > 1) {

        $lastPage = array_pop($_SESSION["history"]);

        $message = "Went back from $lastPage.";

    } else {

        $message = "No previous page available.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Browser History Status</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>🌐 Browser History</h1>
        <p>Stack Based History Management</p>
    </div>

    <div class="report">

        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>

        <h2>📚 Recently Visited Pages</h2>

        <?php

        if (!empty($_SESSION["history"])) {

            /*
             Display stack from TOP to BOTTOM
            */

            $pages = array_reverse($_SESSION["history"]);

            foreach ($pages as $index => $pageName) {

                echo "<div class='history'>";

                if ($index == 0) {
                    echo "⬆ TOP → ";
                } else {
                    echo "Page " . ($index + 1) . " → ";
                }

                echo htmlspecialchars($pageName);

                echo "</div>";
            }

        } else {

            echo "<p>No browser history available.</p>";
        }

        ?>

        <a href="index.html" class="back">
            ← Back to Browser
        </a>

    </div>

</div>

</body>
</html>