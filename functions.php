<?php

function getFileRoot(){
    var_dump($_SERVER['REMOTE_ADDR']);
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
    return array_filter(explode("\n", $root . file_get_contents('players.txt')));
}

function loadScores($games)
{
    $players = updateEloRatings($games);

    arsort($players);

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
