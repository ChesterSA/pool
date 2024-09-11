<?php

if (isset($_POST['player']) && $player = $_POST['player']) {
    $file = fopen("players.txt", "a");
    fwrite($file, $player . "\r\n");
    fclose($file);
}

$winner = $_POST['winner'];
$loser = $_POST['loser'];
$date = $_POST['date'];

if ($winner && $loser && $date) {
    $file = fopen("games.csv", "a");
    $line = "$winner,$loser,$date";
    fwrite($file, $line . "\r\n");
    fclose($file);
}

header('Location: /admin.php');
