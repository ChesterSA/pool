<?php

include('functions.php');
$players = loadPlayers();
$games = loadGames();

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
    <h1>Add a Game</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="new-player.php">Add a Player</a>
        <a href="new-game.php">Add a Game</a>
    </nav>
</header>

<main>
    <div>
        <form action="/backend.php" method="POST">

            <div style="display: flex; justify-content: center; gap: 1rem">
                <label for="winner">Winner</label>

                <select id="winner" name="winner" style="min-width: 20rem">
                    <option disabled selected>-</option>
                    <?php
                    foreach ($players as $name) {
                        echo "<option>$name</option>";
                    }
                    ?>
                </select>
            </div>
            <div style="display: flex; justify-content: center; gap: 1rem">
                <label for="loser">Loser</label>

                <select id="loser" name="loser" style="min-width: 20rem">
                    <option disabled selected>-</option>
                    <?php
                    foreach ($players as $name) {
                        echo "<option>$name</option>";
                    }
                    ?>
                </select>
            </div>
            <div style="display: flex; justify-content: center;">
                <div>
                    <label for="date">Date</label>

                    <input type="datetime-local" id="date" name="date"
                           value="<?php
                           $now = new DateTime("now", new DateTimeZone('Europe/London'));
                           echo $now->format('Y-m-d H:i');
                           ?>">
                </div>

            </div>
            <div style="display: flex; justify-content: center;">
                <label for="submit">Submit Form</label>
                <input type="submit" id="submit">
            </div>
        </form>
    </div>
    <div>
        <details open>
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
