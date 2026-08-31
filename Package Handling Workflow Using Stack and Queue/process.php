<?php

session_start();

/* Create Stack and Queue */

if (!isset($_SESSION["queue"])) {
    $_SESSION["queue"] = [];
}

if (!isset($_SESSION["stack"])) {
    $_SESSION["stack"] = [];
}

$message = "";

/* Get operation */

$operation = $_POST["operation"] ?? "";
$package = trim($_POST["package"] ?? "");


/* ---------------- QUEUE OPERATIONS ---------------- */

/* Add package to Queue */

if ($operation == "add_queue" && $package != "") {

    array_push($_SESSION["queue"], $package);

    $message = "$package added to the processing queue.";
}


/* Process package from Queue - FIFO */

elseif ($operation == "process_queue") {

    if (!empty($_SESSION["queue"])) {

        $processed = array_shift($_SESSION["queue"]);

        $message = "$processed processed from the queue.";

    } else {

        $message = "Queue is empty.";
    }
}


/* ---------------- STACK OPERATIONS ---------------- */

/* Push package into Stack */

elseif ($operation == "push_stack" && $package != "") {

    array_push($_SESSION["stack"], $package);

    $message = "$package pushed onto the stack.";
}


/* Pop package from Stack - LIFO */

elseif ($operation == "pop_stack") {

    if (!empty($_SESSION["stack"])) {

        $processed = array_pop($_SESSION["stack"]);

        $message = "$processed removed from the stack.";

    } else {

        $message = "Stack is empty.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Package Processing Workflow</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>📦 Package Workflow</h1>
        <p>Stack & Queue Processing Status</p>
    </div>

    <div class="report">

        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>


        <!-- Queue -->

        <h2>🚚 Queue - FIFO</h2>

        <?php

        if (!empty($_SESSION["queue"])) {

            foreach ($_SESSION["queue"] as $index => $item) {

                echo "<div class='item queue'>";
                echo "Position " . ($index + 1);
                echo " → ";
                echo htmlspecialchars($item);
                echo "</div>";
            }

        } else {

            echo "<p>No packages in queue.</p>";
        }

        ?>


        <!-- Stack -->

        <h2>📦 Stack - LIFO</h2>

        <?php

        if (!empty($_SESSION["stack"])) {

            foreach (array_reverse($_SESSION["stack"]) as $index => $item) {

                echo "<div class='item stack'>";
                echo "Top → ";
                echo htmlspecialchars($item);
                echo "</div>";
            }

        } else {

            echo "<p>No packages in stack.</p>";
        }

        ?>


        <a href="index.html" class="back">
            ← Back to Package Handling
        </a>

    </div>

</div>

</body>
</html>