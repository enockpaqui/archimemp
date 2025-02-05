<?php

// Unset all of the session variables
$_SESSION = array();

if (ini_get("session.use_cookies")) {
$params = session_get_cookie_params();
setcookie(session_name(),'',time()-42000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
}

ini_set('session.gc_max_lifetime', 0);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);

// Destroy the session.
session_destroy();

// Redirect to login page
if (!empty($_GET['message'])) {
    header("location: login.php?message=". $_GET['message']."");
}else{
    header("location: login.php");
}
exit;
