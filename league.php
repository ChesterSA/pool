<?php
// Number of players
//$players = 13;

// Generate an array of players

$playerList = [
    'Nathan',
    'Chester',
    'Harry',
    'Sam',
    'Matty',
    'Iyaad',
    'Michael',
    'Cal'
];
//$playerList = range(1, $players);

// Function to create a round-robin schedule
function generateRoundRobinSchedule($playerList) {
    $numPlayers = count($playerList);

    // If the number of players is odd, add a bye (null value)
    if ($numPlayers % 2 !== 0) {
        $playerList[] = null;
        $numPlayers++;
    }

    // Number of rounds
    $rounds = $numPlayers - 1;

    // Half the players to rotate
    $half = $numPlayers / 2;

    $schedule = [];

    for ($round = 0; $round < $rounds; $round++) {
        $matches = [];

        for ($i = 0; $i < $half; $i++) {
            $home = $playerList[$i];
            $away = $playerList[$numPlayers - 1 - $i];

            if ($home !== null && $away !== null) {
                // Schedule the match
                $matches[] = "$home vs $away";
            }
        }

        // Add this round's matches to the schedule
        $schedule[] = $matches;

        // Rotate the players (except the first one)
        $newPlayerList = [$playerList[0]];
        $newPlayerList = array_merge($newPlayerList, array_slice($playerList, -1), array_slice($playerList, 1, -1));
        $playerList = $newPlayerList;
    }

    return $schedule;
}

// Generate the schedule
$schedule = generateRoundRobinSchedule($playerList);

// Output the schedule
foreach ($schedule as $roundNumber => $matches) {
    echo "Round " . ($roundNumber + 1) . ":<br>";
    foreach ($matches as $match) {
        echo $match . "<br>";
    }
    echo "<br>";
}
?>
