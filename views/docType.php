<?php if ($data) : ?>
    <?php foreach ($data as $doc) : ?>
        <p>
            <?= "Compte rendu du Conseil des Ministres du " . $doc['full_date']; ?>
        </p>
        <p class="lien c">
            <a href="readDoc.php?file=<?= $doc['paths'] ?>" target="_blank" data-toggle='tooltip'>Lire</a>
            <a href="<?= $doc['paths']; ?>" data-toggle='tooltip' download>T&eacute;l&eacute;charger</a>
        </p>
    <?php
    endforeach;
    ?>
<?php else : ?>
    <p>Donnée(s) introuvable(s)</p>
<?php endif; ?>