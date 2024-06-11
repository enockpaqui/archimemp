<?php
require_once('models/db.php');
require_once('models/user.php');
require('verifyData.php');

function login()
{
    $username = "";

    if (!empty($_POST['username'])) {
        $username = donnees($_POST['username']);
    }

    $users = getUsers($username);

    require('views/login.php');
}
