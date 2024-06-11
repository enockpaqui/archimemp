<?php

function docOtherType($type)
{
    $data = getDocOtherType($type);
    require('views/docOtherType.php');
}
