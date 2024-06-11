<?php $title = "Maj Enregistrement"; ?>

<?php ob_start(); ?>

<?php
$titles = $type = $service = $dateCreate = $references = $username = $fileToUpload = "";
$postData = $_POST;

if (isset($postData['id']) && !empty($postData['id'])) {

    $id = $postData['id'];

    //validate title
    $titles = donnees($postData['title']);

    //validate references
    $references = donnees($postData['references']);

    //validate date
    $dateCreate = $postData['dateCreate'];

    //validate service
    $service = $postData['service'];

    //validate type
    // $type = $postData['type'];

    if (empty($username)) {
        $username = $_SESSION['username'];
    }

    $update = updateDoc($titles, $references, $dateCreate, $service, $user, $id);

    if ($addDoc) {
        $message = 'MAJ DOC';
    } else {
        $message = 'Erreur lors de la MAJ';
    }
} else {
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = trim($_GET['id']);

        $getDoc = getDocById($id);

        if ($getDoc) {

            foreach ($getDoc as $get) {
                $titles = $get["title"];
                // $type = $row["type"];
                $references = $get["reference"];
                $dateCreate = $get["datecreate"];
                // $fileToUpload = $row["paths"];
                $service = $get["services"];
            }
        } else {
            $errorLink = 'dashboard.php';
            header("location: error.php");
            exit();
        }
    }
}
?>

<?php

if ($_SESSION['type'] == 'sadmin') {
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Update document</h2>

                    <form action="<?= htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?= (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $titles; ?>" required>
                        </div>
                        <!-- <div class="form-group <?= (!empty($type_err)) ? 'has-error' : ''; ?>">
                                <label>Type</label>
                                <select class="form-control" name="type" required>
                                    <option value=""></option>
                                    <option value="conseil" <?php if ($type == 'conseil') : ?> selected="selected" <?php endif; ?>>conseil</option>
                                    <option value="decret" <?php if ($type == 'decret') : ?> selected="selected" <?php endif; ?>>decret</option>
                                    <option value="loi" <?php if ($type == 'loi') : ?> selected="selected" <?php endif; ?>>loi</option>
                                    <option value="ordonnance" <?php if ($type == 'ordonnance') : ?> selected="selected" <?php endif; ?> >ordonnance</option>
                                    <option value="accord" <?php if ($type == 'accord') : ?> selected="selected" <?php endif; ?>>accord</option>
                                    <option value="decision" <?php if ($type == 'decision') : ?> selected="selected" <?php endif; ?> >decision</option>
                                </select>
                            </div> -->
                        <div class="form-group <?= (!empty($references_err)) ? 'has-error' : ''; ?>">
                            <label>References</label>
                            <input type="text" name="references" class="form-control" value="<?= $references; ?> " required>
                        </div>
                        <div class="form-group <?= (!empty($dateCreate_err)) ? 'has-error' : ''; ?>">
                            <label>Date Creation</label>
                            <input type="date" name="dateCreate" class="form-control" value="<?= $dateCreate; ?>" required>
                        </div>
                        <!-- <div class="form-group <?= (!empty($fileToUpload_err)) ? 'has-error' : ''; ?>">
                                <label>Filename:</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" value="<?= $fileToUpload; ?>">
                                <span class="help-block"><?= $fileToUpload_err; ?></span>
                            </div> -->
                        <div class="form-group <?= (!empty($service_err)) ? 'has-error' : ''; ?>">
                            <label>Service</label>
                            <select name="service" class="form-control" required>
                                <option value=""></option>
                                <option value="Enseignement Maternel et Primaire" <?php if ($service == 'Enseignement Maternel et Primaire') : ?> selected="selected" <?php endif; ?>>Enseignement Maternel et Primaire</option>
                                <option value="Finances" <?php if ($service == 'Finances') : ?> selected="selected" <?php endif; ?>>Finances</option>
                                <option value="Enseignement Superieur" <?php if ($service == 'Enseignement Superieur') : ?> selected="selected" <?php endif; ?>>Enseignement Superieur</option>
                                <option value="Enseignement Secondaire" <?php if ($service == 'Enseignement Secondaire') : ?> selected="selected" <?php endif; ?>>Enseignement Secondaire</option>
                                <option value="Sante" <?php if ($service == 'Sante') : ?> selected="selected" <?php endif; ?>>Sante</option>
                                <option value="Decentralisation" <?php if ($service == 'Decentralisation') : ?> selected="selected" <?php endif; ?>>Decentralisation</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Mettre à jour">
                        <a href="dashboard.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
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