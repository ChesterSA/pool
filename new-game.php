<?php

include('functions.php');
$players = loadPlayers();
$games = loadGames();

?>

<head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<header>
    <h1>Add a Game</h1>

    <nav>
        <a href="/index.php">Back to home</a>
    </nav>
</header>
<div class="container">

    <div>
        <div class="center">

            <form action="/backend.php" method="POST">
                <input type="hidden" name="type" value="game">

                <div class="center">
                    <div>
                        <label for="winner">Winner</label>

                        <select id="winner" name="winner">
                            <option disabled selected>-</option>
                            <?php
                            foreach ($players as $name) {
                                echo "<option>$name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
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


                </div>
                <div class="center">
                    <div>
                        <label for="date">Date</label>

                        <input type="datetime-local" id="date" name="date"
                               value="<?php
                               $now = new DateTime("now", new DateTimeZone('Europe/London'));
                               echo $now->format('Y-m-d H:i');
                               ?>">
                    </div>

                </div>
                <div class="center">
                    <input type="submit">
                </div>

            </form>
        </div>

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
</div>

</body>
