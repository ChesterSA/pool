<?php

include('functions.php');
$players = loadPlayers();

?>

<head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        :root {
            --accent: #8ECAD2;
        }
    </style>
</head>
<body>
<h1>Admin Panel</h1>

<a href="/index.php">Back to home</a>

<form action="/backend.php" method="POST">

    <h3>New Game</h3>
    <label>
        Winner
        <select name="winner">
            <option disabled selected>-</option>
            <?php
                foreach ($players as $name) { echo "<option>$name</option>"; }
            ?>
        </select>
    </label>

    <label>
        Loser
        <select name="loser">
            <option disabled selected>-</option>
            <?php
                foreach ($players as $name) { echo "<option>$name</option>";}
            ?>
        </select>
    </label>

    <label>
        Date
        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
    </label>

    <input type="submit">

    <hr>

    <h3>Players</h3>
    <?php

    foreach ($players as $name) {
        echo "<p>$name</p>";
    }
    ?>
    <label>
        New Player
        <input type="text" name="player">
    </label>

    <input type="submit">
</form>
</body>
