<?php

include('functions.php');

if ($_POST['type'] == 'player') {
    savePlayer($_POST);
    header('Location: /new-player.php');
} elseif ($_POST['type'] == 'game') {
    saveGame($_POST);
    header('Location: /new-game.php');
}

