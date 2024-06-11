<?php if (isset($_GET['message'])) : ?>
    <p class="btn btn-success"><?= htmlspecialchars($_GET['message']); ?></p>'
<?php endif; ?>

<div class="form-group">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <div class="form-group">
            <label>Type de document</label>
            <select name="type">
                <option value=""></option>
                <option value="all">Tous les documents</option>
                <option value="conseil">Conseil des ministres</option>
                <option value="decret">decrets</option>
                <option value="loi">lois</option>
                <option value="ordonnance">ordonnances</option>
                <option value="accord">accords</option>
                <option value="decision">decisions</option>
            </select>
            <label>De la période du</label>
            <input type="date" name="begin">
            <label>Au</label>
            <input type="date" name="end">
        </div>
        <div class="form-group">
            <label>Mots clés</label>
            <input type="text" name="keywords">
            <label>Service</label>
            <select name="service">
                <option value=""></option>
                <option value="Enseignement Maternel et Primaire">Enseignement Maternel et Primaire</option>
                <option value="Finances">Finances</option>
                <option value="Enseignement Superieur">Enseignement Superieur</option>
                <option value="Enseignement Secondaire">Enseignement Secondaire</option>
                <option value="Sante">Sante</option>
                <option value="Decentralisation">Decentralisation</option>
            </select>
            <input type="submit" class="btn btn-primary" value="Rechercher">
        </div>

    </form>
</div><br>
<?php if (isset($GET['type']) && isset($GET['keywords']) && isset($_GET['begin']) && isset($_GET['end'])) : ?>

     <!-- require_once('fund.php'); -->

<?php else : ?>

    <table class="table table-bordered table-sliped">
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>Title</th>
                <th>Type</th>
                <th>References</th>
                <th>Date d'apparution</th>
                <th>Service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($getDocs) : ?>
                <?php foreach ($getDocs as $getDoc) : ?>
                    <tr>
                    
                        <td><input type="checkbox"></td>
                        <td><?= $getDoc['title']; ?></td>
                        <td><?= $getDoc['type_doc']; ?></td>
                        <td><?= $getDoc['reference']; ?></td>
                        <td><?= $getDoc['full_date']; ?></td>
                        <td><?= $getDoc['services']; ?></td>
                        <td>
                            <?php if ($_SESSION['type'] == "sadmin" || $_SESSION['username'] == $getDoc['username']) : ?>
                                <a href="dashboard.php?action=i&id=<?= $getDoc['id']; ?>"><span class='glyphicon glyphicon-eye-open'></span></a>
                                <a href="dashboard.php?action=u&id=<?= $getDoc['id']; ?>"><span class='glyphicon glyphicon-pencil'></span></a>
                            <?php endif; ?>
                            <?php if ($_SESSION['type'] == "sadmin") : ?>
                                <a href="dashboard.php?action=d&id=<?= $getDoc['id']; ?>"><span class='glyphicon glyphicon-trash'></span></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                No data found
            <?php endif; ?>
        </tbody>
    </table>
    <div style="width: 125px;margin: 0 auto;">
        <?php
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int) $_GET['page'];
        } else {
            $page = 1;
        }

        $total_records = $getNb[0];

        //Number of pages required
        $total_pages = ceil($total_records / $parPage);
        ?>
        <?php if ($page >= 2) : ?>
            <a href="dashboard.php?page=<?= ($page - 1); ?>"><</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if ($i == $page) : ?>
                <a class="active" href="dashboard.php?page=<?= $i ?>"><?= $i ?></a>
            <?php else : ?>
                <a href="dashboard.php?page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($page  < $total_pages) : ?>
            <a href="dashboard.php?page=<?= ($page + 1); ?>">></a>
        <?php endif; ?>
    </div>

<?php endif; ?>