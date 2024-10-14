<?php

include('functions.php');
createFiles();
$games = loadGames();
$players = loadScores($games);

?>
<!doctype html>
<html lang="en">
<head>
    <title>Techquity Pool League</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        :root {
            --accent: #8ECAD2;
        }
    </style>
</head>

<body>
<header>
    <h1>Techquity Pool League</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="new-player.php">Add a Player</a>
        <a href="new-game.php">Add a Game</a>
    </nav>
</header>

<main>
    <div style="display: flex; justify-content: center;">
        <table>
            <tr>
                <th>Player</th>
                <th>Wins</th>
                <th>Losses</th>
                <th>Ratio</th>
                <th>Score</th>
            </tr>

            <?php
            $loop = 1;

            foreach ($players as $player => $stats) {
                $key = match ($loop) {
                    1 => '&#127942;',
                    8 => '&#127921;',
                    default => "$loop."
                };
                echo "<tr><td>$key $player</td><td>{$stats['wins']}</td><td>{$stats['losses']}</td><td>{$stats['ratio']}</td><td>{$stats['elo']}</td></tr>";
                $loop++;
            }
            ?>
        </table>
    </div>
    <div>
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

</main>
<footer>
    <p>Made with &lt;3 by Chester</p>
</footer>

</body>
</html>