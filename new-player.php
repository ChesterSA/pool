<?php

include('functions.php');
$players = loadPlayers();

?>
<!doctype html>
<html lang="en">
<head>
    <title>Admin Panel</title>
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
    <h1>Add A Player</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="new-player.php">Add a Player</a>
        <a href="new-game.php">Add a Game</a>
    </nav>
</header>

<main>
    <div>
        <form action="/backend.php" method="POST">
            <input type="hidden" name="type" value="add-player">

            <div style="display: flex; justify-content: center; gap: 1rem">
                <div>
                    <label for="player">Player</label>

                    <input type="text" id="player" name="player">
                </div>

            </div>
            <div style="display: flex; justify-content: center; gap: 1rem">
                <input type="submit">
            </div>

        </form>
    </div>
    <div>
        <details open>
            <summary>Players</summary>
            <ul>
                <?php
                foreach ($players as $player) {
                    echo "<li>$player</li>";
                }
                ?>
            </ul>

            <form action="/backend.php" method="POST">
                <input type="hidden" name="type" value="delete-player">

                <div style="display: flex; justify-content: center; gap: 1rem">
                    <div>
                        <label for="del">Delete Player</label>

                        <select id="del" name="del" style="min-width: 20rem">
                            <option disabled selected>-</option>
                            <?php
                            foreach ($players as $name) {
                                echo "<option>$name</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div style="display: flex; justify-content: center; gap: 1rem">
                    <input type="submit">
                </div>

            </form>
        </details>
    </div>
</main>

<footer>
    <p>Made with &lt;3 by Chester</p>
</footer>

</body>
</html>
