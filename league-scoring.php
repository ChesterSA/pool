<?php
// Function to read the CSV and return match results
function readMatchResults($csvFile) {
    $matches = [];
    if (($handle = fopen($csvFile, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Assuming the CSV format is: Team1, Team2, Winner
            $matches[] = [
                'team1' => $data[0],
                'team2' => $data[1],
                'winner' => $data[2] // The winning team from the match
            ];
        }
        fclose($handle);
    }
    return $matches;
}

// Function to generate the scoring grid
function generateScoringGrid($teams, $matches) {
    // Create an empty grid
    $grid = [];
    foreach ($teams as $team) {
        foreach ($teams as $opponent) {
            if ($team == $opponent) {
                $grid[$team][$opponent] = "/"; // Initialize with "-"

            } else {
                $grid[$team][$opponent] = "-"; // Initialize with "-"
            }
        }
    }

    // Fill in the grid based on match results
    foreach ($matches as $match) {
        $team1 = $match['team1'];
        $team2 = $match['team2'];
        $winner = $match['winner'];

        if ($team1 == $winner) {
            $grid[$team1][$team2] = $team1; // Team1 won
            $grid[$team2][$team1] = $team2; // Team2 lost
        } elseif ($team2 == $winner) {
            $grid[$team2][$team1] = "x"; // Team2 won
            $grid[$team1][$team2] = "o"; // Team1 lost
        }
    }

    return $grid;
}

// Function to print the scoring grid
function printScoringGrid($grid) {
    echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; text-align: center;'>";

    // Print header row
    echo "<tr><th></th>";
    foreach (array_keys($grid) as $team) {
        echo "<th>$team</th>";
    }
    echo "</tr>";

    // Print each row with team names and results
    foreach ($grid as $team => $row) {
        echo "<tr><th>$team</th>";
        foreach ($row as $result) {
            echo "<td>$result</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

// List of teams (should match the teams in your CSV)
$teams = ["TeamA", "TeamB", "TeamC", "TeamD", "TeamE", "TeamF", "TeamG", "TeamH"];

// Path to your CSV file (make sure it's properly formatted)
$csvFile = "league.csv";

// Read match results from CSV
$matches = readMatchResults($csvFile);

// Generate the scoring grid
$grid = generateScoringGrid($teams, $matches);

// Print the grid
//echo "<pre>";
printScoringGrid($grid);

?>
