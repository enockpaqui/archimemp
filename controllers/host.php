<?php

function host($start_from, $parPage)
{
    $getDocs = getAllDoc($start_from, $parPage);
    $getNb = getAllNb();
    require('views/host.php');
}
