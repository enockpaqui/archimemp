<?php
define('DB_SERVER', '*****');
define('DB_USER', '****');
define('DB_PASSWORD', '*****');
define('DB_NAME', '****');

try {
    $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
} catch (Exception $e) {
    die("Connection failed".mysqli_connect_error());
}
?>
