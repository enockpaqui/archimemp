<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <title><?= $title ?></title>
   <link rel="stylesheet" type="text/css" href="public/css/styles.css">
   <link rel="stylesheet" type="text/css" href="public/css/allpage.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<body>
   <?php require_once('header.php'); ?>
   <?= $content ?>
</body>

</html>