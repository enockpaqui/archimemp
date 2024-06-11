<?php

require_once('models/db.php');
require_once('models/doc.php');
require_once('controllers/docType.php');
require_once('controllers/docOtherType.php');
require_once('controllers/fund.php');
require_once('controllers/search.php');
require('verifyData.php');

function homepage()
{
    require('views/homepage.php');
}
