<?php

require_once('models/db.php');
require_once('models/user.php');

if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin' && isset($_SESSION['active'])) {

    $id = $_SESSION['id'];

    $getAdmins = getAdmin($id);

    if ($getAdmins) {
        foreach ($getAdmins as $admin) {
            $admini = $admin['user_id'];
            $adminp = $admin['user_password'];
            $admint = $admin['user_type'];
            $admina = $admin['user_active'];

            if ($admint == 'admin') {
                if ($admina == false) {
                    header("location:logout.php?message=Compte desactive. Contactez administrateur");
                }
                if ($adminp != $_SESSION['hash']) {
                    header("location:logout.php?message= Mot de passe changé. Contactez administrateur");
                }
            }
        }
    }
}


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php?message=Reconnectez vous");
    exit;
}
