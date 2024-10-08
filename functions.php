<?php

function getFileRoot()
{
    return $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '' : '../';
}

function createFiles()
{
    $root = getFileRoot();

    if (! file_exists($root . 'players.txt')) {
        $f = fopen($root . "players.txt", 'w');
        fclose($f);
    }

    if (! file_exists($root . 'games.csv')) {
        $f = fopen($root . 'games.csv', 'w');
        fwrite($f, "winner,loser,date\r\n");
        fclose($f);
    }
}

function loadPlayers()
{
    $root = getFileRoot();
    return array_filter(explode("\n", file_get_contents($root . 'players.txt')));
}

function loadScores($games)
{
    $players = [];

    $elo = updateEloRatings($games);

    foreach ($elo as $player => $score) {
        $players[$player]['elo'] = $score;
    }

    $winners = array_count_values(array_column($games, 'winner'));
    foreach ($winners as $winner => $wins) {
        $players[$winner]['wins'] = $wins;
    }

    $losers = array_count_values(array_column($games, 'loser'));
    foreach ($losers as $loser => $losses) {
        $players[$loser]['losses'] = $losses;
    }

    foreach ($players as &$player) {
        if (! isset($player['wins'])) {
            $player['wins'] = 0;
        }
        if (! isset($player['losses'])) {
            $player['losses'] = 0;
        }

        $l = $player['losses'] ?: 1;
        $player['ratio'] = $player['wins'] / $l;
    }

    array_multisort(array_column($players, 'elo'), SORT_DESC, $players);

    return $players;
}

function loadGames()
{
    $root = getFileRoot();
    $csv = str_getcsv(file_get_contents($root . 'games.csv'), "\n");

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

    array_multisort(array_column($games, 'date'), SORT_ASC, $games);

    return $games;
}

function calculateElo($winnerRating, $loserRating, $kFactor = 32)
{
    $expectedWinner = 1 / (1 + pow(10, ($loserRating - $winnerRating) / 400));
    $expectedLoser = 1 / (1 + pow(10, ($winnerRating - $loserRating) / 400));

    $newWinnerRating = round($winnerRating + $kFactor * (1 - $expectedWinner));
    $newLoserRating = round($loserRating + $kFactor * (0 - $expectedLoser));

    return [
        'winner' => $newWinnerRating,
        'loser' => $newLoserRating,
    ];
}

function updateEloRatings($matches)
{
    $ratings = []; // associative array to hold player ratings

    foreach ($matches as $match) {
        $winner = $match['winner'];
        $loser = $match['loser'];

        // Set default rating for new players
        if (! isset($ratings[$winner])) {
            $ratings[$winner] = 1000;
        }
        if (! isset($ratings[$loser])) {
            $ratings[$loser] = 1000;
        }

        // Calculate new Elo ratings
        $updatedRatings = calculateElo($ratings[$winner], $ratings[$loser]);

        // Update the ratings
        $ratings[$winner] = $updatedRatings['winner'];
        $ratings[$loser] = $updatedRatings['loser'];
    }

    return $ratings;
}

function savePlayer($data)
{
    $root = getFileRoot();

    if (isset($data['player']) && $player = $data['player']) {
        $file = fopen($root . "players.txt", "a");
        fwrite($file, $player . "\r\n");
        fclose($file);
    }
}

function saveGame($data)
{
    $root = getFileRoot();

    $winner = $data['winner'];
    $loser = $data['loser'];
    $date = $data['date'];

    if ($winner && $loser && $date) {
        $file = fopen($root . "games.csv", "a");
        $line = "$winner,$loser,$date";
        fwrite($file, $line . "\r\n");
        fclose($file);
    }
}

function deletePlayer()
{
    $player = $_POST['del'];
    $root = getFileRoot();

    $players = file_get_contents($root . 'players.txt');
    $updated = str_replace($player, '', $players);

    $filtered = array_filter(explode("\r\n", $updated));

    $imploded = implode("\r\n", $filtered);

    $file = fopen($root . "players.txt", "w");
    fwrite($file, $imploded);
    fclose($file);
}