<?php
function dbConnection()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "memp";

    // Create connection
    try {
        $link = new mysqli($servername, $username, $password, $dbname);
        return $link;
    } catch (Exception $e) {
        die("Connection failed" . $link->connect_error);
    }
}
