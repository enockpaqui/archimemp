<?php $title = "Enregistrment Document"; ?>

<link rel="stylesheet" href="public/css/style.css">
<?php ob_start(); ?>
<?php

$fileToUpload_err = "";
$postData  = $_POST;

$titles = $type = $service = $dateCreate = $reference = $paths = $username = "";
$fileToUpload = "";


// Validate title
if (!empty($postData['title'])) {
    $titles = donnees($postData['title']);
}

// Validate references
if (!empty($postData['references'])) {
    $reference = donnees($postData['references']);
}

// Validate type
if (!empty($postData['type'])) {
    $type = $postData['type'];
}

// Validate date
if (!empty($postData['dateCreate'])) {
    $dateCreate = $postData['dateCreate'];
}

// Validate service
if (!empty($postData['service'])) {
    $service = $postData['service'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES['fileToUpload']['name'])) {
        $target_dir = "docs/" . $type . "/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $fileToUpload_err =  "Fichier existant";
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 250000000) {
            $fileToUpload_err = "Fichier volumineux. Taille doit être inférieure à 250Mo";
        }

        // Allow certain file formats
        if ($fileType != "pdf") {
            $fileToUpload_err = "Fichiers PDF seulement acceptés";
        }
    }
    if (!isset($fileToUpload_err)  || ($fileToUpload_err === '')) {

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        if (empty($paths) && empty($username)) {
            $paths = $target_file;
            $username = $_SESSION['username'];
        }

        $addDoc = addDoc($titles, $type, $reference, $dateCreate, $paths, $service, $username);

        if ($addDoc) {
            $message = 'Fichier envoyé';
        } else {
            $message = 'Erreur lors de l\'envoi. Informations documents non envoyées';
        }
    }
}

?>

<?php
if ($_SESSION['type'] == 'sadmin' || $_SESSION['type'] == 'admin') {
?>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="contain">
            <div class="sous-container">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?= $titles; ?>" required>
                </div>
                <div class="form-group ">
                    <label>Type</label>
                    <select class="form-control" name="type" required>
                        <option value=""></option>
                        <option value="conseil" <?php if ((isset($type)) && ($type == 'conseil')) : ?> selected="selected" <?php endif; ?>>conseil</option>
                        <option value="decret" <?php if ((isset($type)) && ($type == 'decret')) : ?> selected="selected" <?php endif; ?>>decret</option>
                        <option value="loi" <?php if ((isset($type)) && ($type == 'loi')) : ?> selected="selected" <?php endif; ?>>loi</option>
                        <option value="ordonnance" <?php if ((isset($type)) && ($type == 'ordonnance')) : ?> selected="selected" <?php endif; ?> >ordonnance</option>
                        <option value="accord" <?php if ((isset($type)) && ($type == 'accord')) : ?> selected="selected" <?php endif; ?>>accord</option>
                        <option value="decision" <?php if ((isset($type)) && ($type == 'decision')) : ?> selected="selected" <?php endif; ?> >decision</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label>References</label>
                    <input type="text" name="references" class="form-control" value="<?= $reference; ?>" required>
                </div>
            </div>
            <div class="sous-container">
                <div class="form-group ">
                    <label>Date Creation</label>
                    <input type="date" name="dateCreate" class="form-control" value="<?= $dateCreate; ?>" required>
                </div>
                <div class="form-group <?= (!empty($fileToUpload_err)) ? 'has-error' : ''; ?>">
                    <label>Filename:</label>
                    <input type="file" name="fileToUpload" value="<?= $fileToUpload; ?>" required>
                    <span class="help-block"><?= $fileToUpload_err; ?></span>
                </div>
                <div class="form-group ">
                    <label>Service</label>
                    <select name="service" class="form-control" required>
                        <option value=""></option>
                        <option value="Enseignement Maternel et Primaire" <?php if ((isset($service)) && ($service == 'Enseignement Maternel et Primaire')) : ?> selected="selected" <?php endif; ?>>Enseignement Maternel et Primaire</option>
                        <option value="Finances" <?php if ((isset($service)) && ($service == 'Finances')) : ?> selected="selected" <?php endif; ?>>Finances</option>
                        <option value="Enseignement Superieur" <?php if ((isset($service)) && ($service == 'Enseignement Superieur')) : ?> selected="selected" <?php endif; ?>>Enseignement Superieur</option>
                        <option value="Enseignement Secondaire" <?php if ((isset($service)) && ($service == 'Enseignement Secondaire')) : ?> selected="selected" <?php endif; ?>>Enseignement Secondaire</option>
                        <option value="Sante" <?php if ((isset($service)) && ($service == 'Sante')) : ?> selected="selected" <?php endif; ?>>Sante</option>
                        <option value="Decentralisation" <?php if ((isset($service)) && ($service == 'Decentralisation')) : ?> selected="selected" <?php endif; ?>>Decentralisation</option>
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </form><br>

    <?php if (isset($message)) : ?>
        <p class="btn btn-success"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

<?php
} else {
?>
    <p><?php require('alert.php'); ?></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>