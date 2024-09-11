<?php

include('functions.php');
$players = loadPlayers();

?>

<head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
    <h1>Add a Player</h1>

    <nav>
        <a href="/index.php">Back to home</a>
    </nav>
</header>

<div class="container">
    <div style="display: flex; justify-content: center;">

        <form action="/backend.php" method="POST">
            <input type="hidden" name="type" value="player">

            <div class="center">
                <div>
                    <label for="player">Player</label>

                    <input type="text" id="player" name="player">
                </div>

            </div>
            <div class="center">
                <input type="submit">
            </div>

        </form>
        
    </div>
    <details open>
        <summary>Players</summary>
        <ul>
            <?php
            foreach ($players as $player) {
                echo "<li>$player</li>";
            }
            ?>
        </ul>
    </details>
</div>


</body>
