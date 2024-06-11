<div class="container">
    <p class="para">r&eacute;sultas de recherche</p>

    <?php
        $keywords = donnees($_GET['keywords']);
        $begin = donnees($_GET['begin']);
        $end = donnees($_GET['end']);
        $type = donnees($_GET['type']);
    ?>
    <?php if (empty($type) && empty($keywords) && empty($begin) && empty($end)) : ?>
        <p>Aucune(s) donnée(s) saisie(s)</p>
    <?php else : ?>
    
        <?php if ($searchsDocs) : ?>
            <?php foreach ($searchsDocs as $search) : ?>
        
                <div class='doc result'>
                    <p>
                        <?php if ($search['type_doc'] == 'conseil') :?>
                                <?= 'Conseil des Ministres' ?>
                        <?php else: ?>
                            <?= $search['type_doc'] . " N° " . $search['reference'] ?>
                        <?php endif; ?>
                        <?= " du " . $search['full_date']; ?>
                    </p>
                    <p style="text-transform:lowercase;font-weight:normal;">
                        <?= $search['title']; ?>
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
                        <a href="readDoc.php?file=<?= $search['paths'] ?>" target="_blank" data-toggle='tooltip'>Lire</a> |
                        <a href="<?= $search['paths']; ?>" data-toggle='tooltip' download>T&eacute;l&eacute;charger</a>
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

        $total_records = $nbDocs[0];

        echo "</br>";

        //Number of pages required
        $total_pages = ceil($total_records / $parPage);
        ?>
        <?php if (isset($page) && ($page >= 2)) : ?>
            <a href="index.php?type=<?= $type ?>&begin=<?= $begin ?>&end=<?= $end ?>&keywords=<?= $keywords ?>&page=<?= ($page - 1); ?>"><</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if (isset($page) && $i == $page) : ?>
                <a class="active" href="index.php?type=<?= $type ?>&begin=<?= $begin ?>&end=<?= $end ?>&keywords=<?= $keywords ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php else : ?>
                <a href="index.php?type=<?= $type ?>&begin=<?= $begin ?>&end=<?= $end ?>&keywords=<?= $keywords ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if (isset($page) && $page  < $total_pages) : ?>
            <a href="index.php?type=<?= $type ?>&begin=<?= $begin ?>&end=<?= $end ?>&keywords=<?= $keywords ?>&page=<?= ($page + 1); ?>">></a>
        <?php endif; ?>

    </div>

</div>