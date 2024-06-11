<?php

function filterBySearch($type, $keywords, $begin, $end, $start_from, $parPage)
{
    $searchsDocs = getDocBySearch($type, $keywords, $begin, $end, $start_from, $parPage);
    $nbDocs = getNumberDoc($type, $keywords, $begin, $end);
    require('views/search.php');
}
