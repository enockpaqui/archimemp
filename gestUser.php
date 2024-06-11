<?php
session_start();

require_once('controllers/gestUser.php');
require_once('controllers/deleteUser.php');
require_once('controllers/changePassword.php');
require_once('controllers/activeUser.php');
require_once('controllers/desactiveUser.php');


if (isset($_GET['action']) && $_GET['action'] !== '') {

	switch ($_GET['action']) {
		case 'a':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				activeUser();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour à la page <a href='gestUser.php'>gestion des membres</a>";
			}
			break;
		case 'd':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				desactiveUser();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour à la page <a href='gestUser.php'>gestion des membres</a>";
			}
			break;
		case 's':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				deleteUser();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour à la page <a href='gestUser.php'>gestion des membres</a>";
			}
			break;
		case 'c':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				changedPassword();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour à la page <a href='gestUser.php'>gestion des membres</a>";
			}
			break;	
		default:
			echo "Erreur 404 : la page que vous recherchez n'existe pas. Retour à la page <a href='gestUser.php'>gestion des membres</a>";
			break;
	}

}else {
	gestUsers();
}
