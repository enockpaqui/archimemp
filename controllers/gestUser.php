<?php

require_once('models/db.php');
require_once('models/user.php');
require('verifyActivity.php');
require('verifyData.php');

function gestUsers()
{
    $gestUsers = getUserByType();
    require('views/gestUser.php');
}
