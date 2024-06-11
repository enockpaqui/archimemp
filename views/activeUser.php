<?php $title = "Activation Membre" ?>

<?php ob_start(); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['type']) && $_POST['type'] == 'submit') {

        if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

            setActivity(true, $_GET['id']);
    
            // if ($user_activity) {
            //     $message = 'Membre désactivé';
            // } else {
            //     $message = 'Erreur lors de l\'activation du membre. Retour en ';
            //     $message .= '<a href=\'gestUser.php\'>arrière</a>';
            // }
        }
    }
}
?>

<?php if ($_SESSION['type'] == 'sadmin') : ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Activer membre</h1>
                    </div>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="alert alert-danger fade in">

                            <input type="hidden" name="member_id" value="<?= trim($_GET['id']); ?>" readonly />

                            <p>Etes vous sur?</p><br>
                            <p>
                                <input type="submit" value="Valider" class="btn btn-danger">
                                <a href="gestUser.php" class="btn btn-default">Non</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <p><?php require('alert.php'); ?></p>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>