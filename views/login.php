<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/css/allpage.css">
</head>

<body>
    <div>
        <img src="public/images/banner_memp.png" alt="logo MEMP" style="width: 400px;height: 50px;margin: 0 auto;display: block;">
    </div>
    <h2>Plateforme documents archives</h2>
    <div class="imgcontainer">
        <img src="public/images/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <?php
    $password = "";
    $username_error = $password_error = "";

    if (!empty($_POST['password'])) {
        $password = donnees($_POST['password']);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($username_error) && empty($password_error)) {

            if ($users) {

                foreach ($users as $user) {
                    $useri = $user['user_id'];
                    $usern = $user['user_name'];
                    $userp = $user['user_password'];
                    $usert = $user['user_type'];
                    $usera = $user['user_active'];

                    if (password_verify($password, $userp)) {

                        if ($usert == 'sadmin' || $usert == 'admin') {

                            if ($usera == true) {

                                header("location: dashboard.php");
                                $_SESSION['loggedin'] = true;
                                $_SESSION['id'] = $useri;
                                $_SESSION['username'] = $usern;
                                $_SESSION['hash'] = $userp;
                                $_SESSION['type'] = $usert;
                                $_SESSION['active'] = $usera;
                            } else {
                                header("location:login.php?message=Compte desactive. Contactez administrateur");
                            }
                        }
                    } else {
                        $password_error = "Mot de passe incorrect";
                    }
                }
            } else {
                $username_error = "Compte utilisateur non identifié";
            }
        }
    }

    ?>

    <div class="wrapper">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?= (!empty($username_error)) ? 'has-error' : ''; ?>">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required value="<?= $username; ?>">
                <span class="help-block"><?= $username_error; ?></span>
            </div>

            <div class="form-group <?= (!empty($password_error)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
                <span class="help-block"><?= $password_error; ?></span>
            </div>

            <div class="form-group" style="text-align: center;">
                <input type="submit" name="submit" class="btn btn-primary" value="Se connecter">
            </div>
        </form>

        <?php if (isset($_GET['message'])) : ?>
            <p class="btn btn-danger"><?= htmlspecialchars($_GET['message']) ?></p>
        <?php endif; ?>
    </div>
    <hr>
    <footer>
        <p>&copy; Ministère des Enseignement Maternel et Primaire - <?= date("Y"); ?></p>
    </footer>

</body>

</html>