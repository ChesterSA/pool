<?php
//Create Files
if (! file_exists('players.txt')) {
    $f = fopen("players.txt", "w");
    fclose($f);
}

if (! file_exists('games.csv')) {
    $f = fopen("games.csv", "w");
    fwrite($f, "winner,loser,date\r\n");
    fclose($f);
}

// Load Players
$winners = [];
$names = array_filter(explode("\n", file_get_contents('players.txt')));

foreach ($names as $name) {
    $winners[$name] = 0;
}

// Load Games
$csv = str_getcsv(file_get_contents('games.csv'), "\n");

$header = null;
$games = [];

foreach ($csv as $row) {
    $row = str_getcsv($row);

    if (! $header) {
        $header = $row;
    } else {
        $games[] = array_combine($header, $row);
    }
}

// Format Winners Array
$winners = array_merge($winners, array_count_values(array_column($games, 'winner')));
arsort($winners);
?>
<head>
    <title>Pool</title>
</head>
<body>
<h1>Pool</h1>
<a href="admin.php">Admin</a>


<h2>Players</h2>
<table>
    <tr>
        <th>Player</th>
        <th>Score</th>
    </tr>

    <?php
    foreach ($winners as $name => $score) {
        echo "<tr><td>$name</td><td>$score</td></tr>";
    }
    ?>
</table>

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