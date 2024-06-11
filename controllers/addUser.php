<?php

require_once('models/db.php');
require_once('models/user.php');
require('verifyActivity.php');
require('verifyData.php');

function addNewUser()
{
    require('views/addUser.php');
}
