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

<div class="container">
    <div class="container">
        <div style="display: flex; justify-content: center;">

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
                        $key = ($loop == 1) ? "&#127942;" : "$loop.";
                        echo "<tr><td>$key $player</td><td>{$stats['wins']}</td><td>{$stats['losses']}</td><td>{$stats['elo']}</td></tr>";
                        $loop++;
                    }
                    ?>
                </table>


        </div>
            <details>
                <summary>Games</summary>
                <table>
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
    </div>

</div>

</body>