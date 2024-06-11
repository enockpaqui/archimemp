<?php $title = "Changement Mdp Membre"; ?>

<?php ob_start(); ?>

<?php
// Define variables and initialize with empty values
$new_password = $confirm_new_password = $id = "";
$new_password_err = $confirm_new_password_err = "";
$postData = $_POST;

if (!empty($_GET['id'])) {
    $id = donnees($_GET['id']);
    echo $id;
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
}

if (!empty($postData['new_password'])) {
    $new_password = $postData['new_password'];
}

if (!empty($postData['confirm_new_password'])) {
    $confirm_new_password = $postData['confirm_new_password'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (strlen($new_password) < 6) {
        $new_password_err = "Au moins 6 cractères";
    }

    if ($new_password != $confirm_new_password) {
        $confirm_new_password_err = "Mot de passe non identiques";
    }

    if (empty($new_password_err) && empty($confirm_new_password_err)) {

        if (empty($id) && empty($new_password)) {
            $id = $id;
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        }
        $changedPassword = changedPassword($new_password, $id);

        if ($changedPassword) {
            $message = 'Mot de passe changé';
        } else {
            $message = 'Oops!!! Erreur lors du changement. Retour en ';
            $message .= '<a href=\'gestUser.php\'>arrière</a>';
        }
    }
}


?>

<?php if ($_SESSION['type'] == 'sadmin') : ?>

    <div class="wrapper">

        <h2>Changement de mot de passe</h2>

        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <input type="hidden" name="id" readonly value="<?= (isset($_GET['id'])) ? $_GET['id'] : $_GET['id']; ?>" />

            <div class="form-group <?= (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="text" name="new_password" class="form-control" value="<?= $new_password; ?>" required>
                <span class="help-block"><?= $new_password_err; ?></span>
            </div>

            <div class="form-group <?= (!empty($confirm_new_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="text" name="confirm_new_password" class="form-control" value="<?= $confirm_new_password; ?>" required>
                <span class="help-block"><?= $confirm_new_password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Modifier">
                <a class="btn btn-default" href="gestUser.php">Cancel</a>
            </div>
        </form>

    </div>

<?php else : ?>
    <p><?php require('alert.php'); ?></p>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>