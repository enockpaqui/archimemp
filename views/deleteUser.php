<?php $title = "Suppression Membre"; ?>

<?php ob_start(); ?>

<?php

$postData = $_POST;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($postData['id']) && !empty($postData['id'])) {
        $id = $postData['id'];
    } else {
        // Check existence of id parameter
        if (empty(trim($_GET['id']))) {
            // URL doesn't contain id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }

    $deleteUser = deletedUser($id);

    if ($deleteUser) {
        $message = 'Membre supprimé';
    } else {
        $message = 'Erreur lors de la suppression. Retour en ';
        $message .= '<a href=\'gestUser.php\'>arrière</a>';
    }
}

?>

<?php if ($_SESSION['type'] == 'sadmin') : ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Supprimer Membre</h1>
                    </div>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?= trim($_GET["id"]); ?>" readonly />

                            <p>Cette action est irreversible.Êtes vous sûr?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="gestUser.php" class="btn btn-default">No</a>
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