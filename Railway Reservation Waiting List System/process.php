<?php
session_start();

/* Available confirmed seats */
$totalSeats = 3;

/* Create arrays */
if (!isset($_SESSION["confirmed"])) {
    $_SESSION["confirmed"] = [
        "Anitha",
        "Rahul",
        "Priya"
    ];
}

if (!isset($_SESSION["waiting"])) {
    $_SESSION["waiting"] = [];
}

$message = "";

/* Add Passenger */
if (isset($_POST["action"]) && $_POST["action"] == "book") {

    $name = trim($_POST["name"]);

    /* Check duplicate passenger */
    if (
        in_array($name, $_SESSION["confirmed"]) ||
        in_array($name, $_SESSION["waiting"])
    ) {
        $message = "Passenger already exists.";
    }

    /* Allocate confirmed seat */
    elseif (count($_SESSION["confirmed"]) < $totalSeats) {

        array_push($_SESSION["confirmed"], $name);

        $message = "$name received a confirmed seat.";
    }

    /* Add to waiting list */
    else {

        array_push($_SESSION["waiting"], $name);

        $position = count($_SESSION["waiting"]);

        $message = "$name added to waiting list at position $position.";
    }
}


/* Cancel Passenger */
if (isset($_POST["action"]) && $_POST["action"] == "cancel") {

    $cancelName = trim($_POST["cancel_name"]);

    $index = array_search(
        $cancelName,
        $_SESSION["confirmed"]
    );

    if ($index !== false) {

        /* Remove cancelled passenger */
        array_splice(
            $_SESSION["confirmed"],
            $index,
            1
        );

        $message = "$cancelName cancelled successfully.";

        /* Allocate seat to first waiting passenger */
        if (!empty($_SESSION["waiting"])) {

            $nextPassenger = array_shift(
                $_SESSION["waiting"]
            );

            array_push(
                $_SESSION["confirmed"],
                $nextPassenger
            );

            $message .=
                " $nextPassenger received the confirmed seat.";
        }

    } else {

        $message = "Passenger not found in confirmed list.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Railway Reservation Status</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>🚆 Reservation Status</h1>
        <p>Confirmed Seats & Waiting List</p>
    </div>

    <div class="report">

        <div class="status">
            <?php echo htmlspecialchars($message); ?>
        </div>

        <h2>✅ Confirmed Passengers</h2>

        <?php

        if (!empty($_SESSION["confirmed"])) {

            foreach ($_SESSION["confirmed"] as $index => $passenger) {

                echo "<div class='confirmed'>";
                echo "Seat " . ($index + 1) . " - ";
                echo htmlspecialchars($passenger);
                echo "</div>";
            }

        } else {

            echo "<p>No confirmed passengers.</p>";
        }

        ?>

        <h2>⏳ Waiting List</h2>

        <?php

        if (!empty($_SESSION["waiting"])) {

            foreach ($_SESSION["waiting"] as $index => $passenger) {

                echo "<div class='waiting'>";
                echo "Waiting Position " . ($index + 1);
                echo " - ";
                echo htmlspecialchars($passenger);
                echo "</div>";
            }

        } else {

            echo "<p>No passengers in waiting list.</p>";
        }

        ?>

        <a href="index.html" class="back">
            ← Back to Reservation
        </a>

    </div>

</div>

</body>
</html>