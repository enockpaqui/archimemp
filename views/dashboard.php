<?php $title = "Tableau de bord"; ?>

<link rel="stylesheet" href="../public/css/home.css">

<?php ob_start(); ?>

<?php
//on détermine le nombre d'articles par page
$parPage = 20;

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = (int) $_GET['page'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $parPage;

host($start_from, $parPage);
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>