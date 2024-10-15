<?php
include('../functions.php');

$players = loadPlayers();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Leagues</title>
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
    <h1>Leagues</h1>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../new-player.php">Add a Player</a>
        <a href="../new-game.php">Add a Game</a>
        <a href="index.php">Leagues</a>
    </nav>
</header>

<main>
    <div style="">
        <form action="../backend.php" method="POST">
            <input type="hidden" name="type" value="league">
            <div>
                <label for="league_players">
                    Add Players
                </label>
                <select multiple style="min-width: 20rem" id="league_players" name="league_players">
                    <option>Test</option>
                    <option>Test2</option>
                    <option>Test3</option>
                    <option>Test4</option>
                    <option>Test5</option>
                    <option>Test6</option>
                    <option>Test7</option>
                    <option>Test8</option>
                </select>
            </div>
            <div>
                <label for="league_name">
                    League Name
                </label>

                <input type="text" name="league_name" id="league_name">
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>


</main>
<footer>
    <p>Made with &lt;3 by Chester</p>
</footer>

</body>
</html>