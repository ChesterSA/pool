<?php

include('functions.php');
createFiles();
$games = loadGames();
$players = loadScores($games);

?>
<head>
    <title>Techquity Pool League</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        :root {
            --accent: #8ECAD2;
        }
        h3 {
            margin-bottom: 10px
        }
    </style>
</head>
<body>
<h1>Techquity Pool League</h1>
<a href="admin.php">Admin</a>

<h3>Players</h3>
<table>
    <tr>
        <th>Player</th>
        <th>Score</th>
    </tr>

    <?php
    foreach ($players as $name => $score) {
        echo "<tr><td>$name</td><td>$score</td></tr>";
    }
    ?>
</table>

<h3>Games</h3>
<table>
    <tr>
        <th>Winner</th>
        <th>Loser</th>
        <th>Date</th>
    </tr>

    <?php
    foreach ($games as $game) {
        echo "<tr><td>{$game['winner']}</td><td>{$game['loser']}</td><td>{$game['date']}</td></tr>";
    }
    ?>
</table>
</body>