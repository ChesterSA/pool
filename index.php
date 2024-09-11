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
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Techquity Pool League</h1>
    <nav>
        <a href="new-player.php">Add a Player</a>
        <a href="new-game.php">Add a Game</a>
    </nav>
</header>
<h3>Players</h3>
<table>
    <tr>
        <th>Player</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Score</th>
    </tr>

    <?php
    $loop = 1;

    foreach ($players as $player => $stats) {
//        U+1F3C6
        $num = ($loop == 1) ? "&#127942;" : "$loop.";
        echo "<tr><td>$num $player</td><td>{$stats['wins']}</td><td>{$stats['losses']}</td><td>{$stats['elo']}</td></tr>";
        $loop++;
    }
    ?>
</table>

<details>
    <summary>Games</summary>
    <table style="width:100%">
        <tr>
            <th>Winner</th>
            <th>Loser</th>
            <th>Date</th>
        </tr>

        <?php
        foreach ($games as $game) {
            echo "<tr>
                    <td>{$game['winner']}</td>
                    <td>{$game['loser']}</td>
                    <td>{$game['date']}</td>
                  </tr>";
        }
        ?>
    </table>
</details>

<div style="height:400px"></div>

</body>