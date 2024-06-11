<div class="page-header">
    <h1>
        <?php if($_SESSION['type'] == 'sadmin'):  ?>
            <?= 'admin' ?>
        <?php else : ?>
            <?= 'membre' ?>
        <?php endif; ?>
        <?= htmlspecialchars($_SESSION['username']); ?>
    </h1>
</div>
<div>
    <a href="logout.php" class="btn btn-danger">D&eacute;connexion</a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header clearfix">
                <a href="dashboard.php" class="btn pull-left">Accueil</a>
                <a href="addDoc.php" class="btn pull-left">Cr&eacute;er Document</a>
                <?php if ($_SESSION['type'] == 'sadmin') : ?>
                    <a href="addUser.php" class="btn pull-left">Ajouter Membre</a>
                    <a href="gestUser.php" class="btn pull-left">Gestion Membres</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>