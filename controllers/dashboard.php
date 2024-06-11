<?php
require_once('models/db.php');
require_once('models/doc.php');
require('controllers/host.php');
require('verifyData.php');
require('verifyActivity.php');

function dashboard()
{
    require('views/dashboard.php');
}
