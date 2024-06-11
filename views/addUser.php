<?php $title = "Creation Membre"; ?>

<?php ob_start(); ?>

<?php
$postData = $_POST;

$username = $type = $password = $active = "";

$username_err = $password_err = "";

// Validate title
if (!empty($postData['username'])) {
    $username = donnees($postData['username']);
}

// Validate references
if (!empty($postData['password'])) {
    $password = donnees($postData['password']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $verifyUser = verifyUser($username);

    if ($verifyUser) {
        $username_err = "Membre existant";
    } else {
        $username = $username;
    }

    if (strlen($password) < 6) {
        $password_err = "Mot de passe doit contenir au moins 6 caractères";
    } else {
        $password = $password;
    }

    if (empty($username_err) && empty($password_err)) {

        if (empty($type) && empty($active)) {
            $type = "admin";
            $active = true;
        }

        $addUser = addUser($username, password_hash($password, PASSWORD_DEFAULT), $type, $active);

        if ($addUser) {
            $message = 'Sauvegardé';
        } else {
            $message = 'Erreur lors de l\'enregistrement';
        }
    }
}

?>
<?php
if ($_SESSION['type'] == 'sadmin') {
?>
    <div class="wrapper">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?= (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required value="<?= $username; ?>">
                <span class="help-block"><?= $username_err; ?></span>
            </div>
            <div class="form-group <?= (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required">
                <span class="help-block"><?= $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Créer membre">
            </div>
        </form>

        <?php if (isset($message)) : ?>
            <p class="btn btn-success"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
    </div>
<?php
} else {
?>
    <p><?php require('alert.php'); ?></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>