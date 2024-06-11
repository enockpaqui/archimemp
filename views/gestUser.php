<?php $title = "Gestion Membres"; ?>

<?php ob_start(); ?>

<?php if ($_SESSION['type'] == 'sadmin') : ?>
    <div class="form-group">
        <form action="" method="post">
            <label>Status</label>
            <select name="type" autocomplete="off">
                <option value=""></option>
                <option value="">actif</option>
                <option value="">inactif</option>
            </select>
            <label>Nom membre</label>
            <input type="text" name="">
            <input type="submit" name="" class="btn btn-primary" value="Rechercher">
            <!-- <div class="result"></div> -->
        </form>
    </div>
    <?php
    if ($gestUsers) {
    ?>
        <table class="table table-bordered table-sliped">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="check()"></th>
                    <th>Membres</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($gestUsers as $user) {
                ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $user['user_name']; ?></td>
                        <?php if ($user['user_active'] == true) : ?>
                            <td>Actif</td>
                        <?php else : ?>
                            <td>Inactif</td>
                        <?php endif; ?>
                        <td>
                            <?php if ($user['user_active'] == false) : ?>
                                <a href="gestUser.php?action=a&id=<?= $user['user_id']; ?>">Activer | </a>
                                <a href="gestUser.php?action=s&id=<?= $user['user_id']; ?>">Supprimer | </a>
                                <a href="gestUser.php?action=c&id=<?= $user['user_id']; ?>">Changer mot de passe</a>
                            <?php else : ?>
                                <a href="gestUser.php?action=d&id=<?= $user['user_id']; ?>">D&eacute;sactiver</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    <?php

    } else {
        echo 'Pas de membres trouvés';
    }

    ?>
    <?php if (isset($message)) : ?>
        <p class="btn btn-success"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

<?php else : ?>
    <p class=""><?php require('alert.php'); ?></p>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>