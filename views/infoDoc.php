<?php $title = "Données Enregistrement" ?>
<style type="text/css">
    .contain {
        display: flex;
        flex-direction: row;

    }

    .sous-container {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        width: 50%;
        margin: 20px;
    }
</style>

<?php ob_start(); ?>

<?php
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

    $id = $_GET['id'];

    $infoDoc = getDocById($id);

    if ($infoDoc) {
        foreach ($infoDoc as $info) {
            // Retrieve individual field value
            $titles = $info["title"];
            $type = $info["type_doc"];
            $references = $info["reference"];
            $dateCreate = $info["datecreate"];
            $service = $info["services"];
            $created_at = $info["created_at"];
            $update_date = $info["update_date"];
            $username = $info["username"];
            $username_update = $info["username_update"];
        }
    }
}
?>
<div class="contain">
    <div class="sous-container">
        <div>
            <label>Titre</label>
            <p><?= $titles; ?></p>
        </div>
        <div>
            <label>Type de document</label>
            <p><?= $type; ?></p>
        </div>
        <div>
            <label>References</label>
            <p><?= $references; ?></p>
        </div>
        <div>
            <label>Date d'apparution</label>
            <p><?= $dateCreate; ?></p>
        </div>
        <div>
            <label>Service</label>
            <p><?= $service; ?></p>
        </div>
    </div>
    <div class="sous-container">
        <div>
            <label>Date d'enregistrement</label>
            <p><?= $created_at; ?></p>
        </div>
        <div>
            <label>Enregistré par</label>
            <p><?= $username; ?></p>
        </div>
        <div>
            <label>Mis à jour le / Par : </label>
            <p><?= $update_date . " / " . $username_update ?></p>
        </div>
        <p><a href="dashboard.php" class="btn btn-primary">Retour</a></p>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>