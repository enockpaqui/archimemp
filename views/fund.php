<div class="container">
    <p class="para">r&eacute;sultas de recherche</p>

    <?php
        $type = donnees($_GET['type']);
    ?>
    <?php if (empty($type)) :?>
        <p>Filtre invalide</p>
    <?php else : ?>

        <?php if ($filters) : ?>
            <?php foreach ($filters as $filter) : ?>

                <div class='doc result'>
                    <p>
                        <?php if ($filter['type_doc'] == 'conseil') :?>
                            <?= 'Conseil des Ministres' ?>
                        <?php else: ?>
                            <?= $filter['type_doc'] . " N° " . $filter['reference'] ?>
                        <?php endif; ?>
                        <?= " du " . $filter['full_date']; ?>
                    </p>
                    <p style="text-transform:lowercase;font-weight:normal;">
                        <?= $filter['title']; ?>
                    </p>
                    <p class="link_share_social_media">
                        <a href="#"><img src="public/images/facebook.png" alt="Share"></a>
                        <a href="#"><img src="public/images/linkedin.png" alt="Share"></a>
                        <a href="#"><img src="public/images/twitter.png" alt="Share"></a>
                    </p>
                    <p>
                        Lecture: | T&eacute;l&eacute;chargements:
                    </p>
                    <p class="lien o">
                        <a href="readDoc.php?file=<?= $filter['paths'] ?>" target="_blank" data-toggle='tooltip'>Lire</a> |
                        <a href="<?= $filter['paths']; ?>" data-toggle='tooltip' download>T&eacute;l&eacute;charger</a>
                    </p>
                    <hr>
                </div>

            <?php endforeach; ?>
            
        <?php else : ?>
            <p>Document(s) introuvable(s)</p>
        <?php endif; ?>

    <?php endif; ?>
    
    <div class="pagination">
        <?php
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int) donnees($_GET['page']);
        } else {
            $page = 1;
        }

        $total_records = $nbByFilter[0];

        echo "</br>";

        //Number of pages required
        $total_pages = ceil($total_records / $parPage);
        ?>
        <?php if (isset($page) && ($page >= 2)) : ?>
            <a href="index.php?filter=f&type=<?= $type ?>&page=<?= ($page - 1); ?>"><</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if (isset($page) && $i == $page) : ?>
                <a class="active" href="index.php?filter=f&type=<?= $type ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php else : ?>
                <a href="index.php?filter=f&type=<?= $type ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if (isset($page) && $page  < $total_pages) : ?>
            <a href="index.php?filter=f&type=<?= $type ?>&page=<?= ($page + 1); ?>">></a>
        <?php endif; ?>

    </div>

</div>