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
    <h3>Players</h3>
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

    <input type="submit">

    <hr>

    <h3>New Game</h3>
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
        <input type="date" name="date"
               value="<?php echo date('Y-m-d'); ?>">
    </label>

    <input type="submit">
</form>
</body>
