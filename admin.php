<head>
    <title>Admin Panel </title>
</head>
<body>
<h1>Admin Panel</h1>

<a href="index.php">Back to home</a>

<form action="/backend.php" method="POST">
    <h2>Players</h2>
    <?php
    $names = explode("\n", file_get_contents('players.txt'));

    foreach ($names as $name) {
        echo "<p>$name</p>";
    }
    ?>
    <label>
        New Player
        <input type="text" name="player">
    </label>

    <hr>
    <h2>New Game</h2>
    <label>
        Winner
        <input type="text" name="winner">
    </label>

    <label>
        Loser
        <input type="text" name="loser">
    </label>

    <label>
        Date
        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
    </label>

    <input type="submit">
</form>
</body>
