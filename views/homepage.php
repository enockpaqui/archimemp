<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Plateforme documents archives MEMP">
    <link rel="shortcut icon" href="public/images/fav_memp.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/menu.css">
    <link rel="stylesheet" type="text/css" href="public/css/allpage.css">
    <link rel="stylesheet" type="text/css" href="public/css/search.css">
    <link rel="stylesheet" type="text/css" href="public/css/top.css">
    <title>Archives MEMP</title>
    <style>
        .item_container .search {
            height: 50px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div id="header">
        <div id="logo">
            <a href="index.php"><img src="public/images/banner_memp.jpg" alt="logo_MEMP" ></a>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="#" id="closeBtn" class="close">&times;</a>
            <ul>
                <li><a href="index.php?filter=f&type=all">Tous les documents</a></li>
                <li><a href="index.php?filter=f&type=conseil">Conseil des ministres</a></li>
                <li><a href="index.php?filter=f&type=decret">D&eacute;crets</a></li>
                <li><a href="index.php?filter=f&type=loi">Lois</a></li>
                <li><a href="index.php?filter=f&type=ordonnance">Ordonnances</a></li>
                <li><a href="index.php?filter=f&type=accord">Accords</a></li>
                <li><a href="index.php?filter=f&type=decision">D&eacute;cisions</a></li>
            </ul>
        </div>
        <a href="#" id="openBtn">
            <img src="public/images/toogle_menu3.png" alt="">
        </a>
    </div>
    <div id="banner">
        <?php
        docType();
        ?>
        <p>
            <a href="#"><<</a>
            <a href="#">>></a>
        </p>
    </div>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" id="contain">
        <div class="item_container">
            <p>Type de document</p>
            <select class="item" name="type" id="type">
                <option value=""></option>
                <option value="all">Tous les documents</option>
                <option value="conseil">Conseils des ministres</option>
                <option value="decret">D&eacute;crets</option>
                <option value="loi">Lois</option>
                <option value="ordonnance">Ordonnances</option>
                <option value="accord">Accords</option>
                <option value="decision">D&eacute;cisions</option>
            </select>
        </div>
        <div class="item_container">
            <p>De la p&eacute;riode</p>
            <input type="date" class="item" name="begin" id="begin">
        </div>
        <div class="item_container">
            <p>Au</p>
            <input type="date" class="item" name="end" id="end">
        </div>
        <div class="item_container">
            <p>Mots cl&eacute;s</p>
            <input type="text" class="item" name="keywords" id="keywords" placeholder="Saisissez des mots clés">
        </div>
        <div class="item_container">
            <input type="submit" value="Rechercher" class="search">
        </div>
    </form>
    <div id="section">
        <?php
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int) donnees($_GET['page']);
        } else {
            $page = 1;
        }

        if (isset($_GET['filter']) && $_GET['filter'] !== '') {
            if ($_GET['filter'] === 'f') {

                if (isset($_GET['type'])) {

                    // on détermine le nombre d'articles par page
                    $parPage = 20;

                    $start_from = ($page - 1) * $parPage;

                    filterByMenu($_GET['type'], $start_from, $parPage);
                }
            }else{
                echo 'Oops. ERROR';
            }
        } else {

            if (isset($_GET['type']) && isset($_GET['keywords']) && isset($_GET['begin']) && isset($_GET['end'])) {

                // on détermine le nombre d'articles par page
                $parPage = 20;

                $start_from = ($page - 1) * $parPage;

                filterBySearch($_GET['type'], $_GET['keywords'], $_GET['begin'], $_GET['end'], $start_from, $parPage);
            } else {
        ?>
                <div class="container">
                    <div  id="first_sous_container" class="sous_container">
                        <p id="fcontainer" class="para">Les lois les plus r&eacute;cents</p>
                        <?php
                        docOtherType('loi');
                        ?>
                    </div>

                    <div  id="second_sous_container" class="sous_container">
                        <p id="tcontainer" class="para">Les d&eacute;crets les plus r&eacute;cents</p>
                        <?php
                        docOtherType('decret');
                        ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <div id="action">
            <legend>Recevez chaque semaine en exclusivit&eacute; des lois,d&eacute;crets,les ordonnances,d&eacute;cisions, etc.</legend>
            <form id="envoi">
                <input type="email" name="email" placeholder="Votre adresse email" autocomplete="off"> <br>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
    
    <div id="footer">
        <p>
            <a href="#">Pr&eacute;sentation</a>
            <a href="#">Mentions l&eacute;gales</a>
            <a href="contact.php">Contact</a>
        </p>
        <p>&copy; Minist&egrave;re des Enseignements Maternel et Primaire - <?= date("Y"); ?></p>
    </div>
    <div id="drapeau">
        <span id="gcolor"></span>
        <span id="ycolor"></span>
        <span id="rcolor"></span>
    </div>
    <span id="viewButton"><a href="#top"><img src="public/images/to_top.png" alt=""></a></span>

    <script src="public/js/menu.js"></script>
    <script src="public/js/top.js"></script>
    <!-- <script src="public/js/interaction.js"></script> -->
</body>

</html>