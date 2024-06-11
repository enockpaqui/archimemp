<?php

function donnees($donnees)
{
    $donnees = htmlspecialchars($donnees);
    $donnees = stripslashes($donnees);
    $donnees = trim($donnees);
    $donnees = strip_tags($donnees);

    return $donnees;
}
