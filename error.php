<?php
session_start();
// require ('verifyActivity.php');
?>

<?php $title = "Error"; ?>

<?php ob_start(); ?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Requete invalide</h1>
                </div>
                <div class="alert alert-danger fade in">
                    <p>Opération impossible. Svp <a href="dashboard.php" class="alert-link">retour en arriere</a> et ressayez.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>