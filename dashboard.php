<?php
session_start();

require_once('controllers/dashboard.php');
require_once('controllers/deleteDoc.php');
require_once('controllers/updateDoc.php');
require_once('controllers/infoDoc.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {

	switch ($_GET['action']) {
		case 'i':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				infoDoc();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour au <a href='dashboard.php'>tableau de bord</a>";
			}
			break;
		case 'd':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				delDoc();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour au <a href='dashboard.php'>tableau de bord</a>";
			}
			break;
		case 'u':
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				majDoc();
			}
			else{
				echo "Erreur 404 : Identifiant invalide. Retour au <a href='dashboard.php'>tableau de bord</a>";
			}
			break;
			
		default:
			echo "Erreur 404 : la page que vous recherchez n'existe pas. Retour au <a href='dashboard.php'>tableau de bord</a>";
			break;
	}
} else {
	dashboard();
}
