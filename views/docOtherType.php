<?php if ($data) : ?>
    <?php foreach ($data as $doc) : ?>
        <div class='doc'>
            <p>
                <?= $doc['type_doc'] . " N° " . $doc['reference'] . " du " . $doc['full_date']; ?>
            </p>
            <p style="text-transform:lowercase;font-weight:normal;">
                <?= $doc['title']; ?>
            </p>
            <p class="link_share_social_media">
                <a href="#"><img src="public/images/facebook.png" alt="Share"></a>
                <a href="#"><img src="public/images/linkedin.png" alt="Share"></a>
                <a href="#"><img src="public/images/twitter.png" alt="Share"></a>
            </p>
            
            <p class="lien o">
                <a class="read" href="readDoc.php?file=<?= $doc['paths'] ?>" target="_blank" data-toggle='tooltip' >Lire</a>
                <a class="download" href="<?= $doc['paths']; ?>" data-toggle='tooltip' download >T&eacute;l&eacute;charger</a>
            </p>
            <hr>
        </div>
    <?php endforeach; ?>
<?php else : ?>
   <p>Donnée(s) introuvable(s)</p>
<?php endif; ?>