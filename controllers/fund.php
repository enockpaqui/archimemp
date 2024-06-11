<?php

function filterByMenu($type, $start_from, $parPage)
{
    $filters = getDocByFilter($type, $start_from, $parPage);
    $nbByFilter = getNumber($type);
    require('views/fund.php');
}
