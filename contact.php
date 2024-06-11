<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/contact.css">
    <link rel="stylesheet" type="text/css" href="public/css/allpage.css">
    <title>Contact</title>
</head>

<body>
    <h2>Demandes, suggestions</h2>
    <div class="container">
        <form action="">
            <div class="row">
                <div class="col-25">
                    <label for="name">Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="name" name="name" placeholder="Votre nom..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Email</label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name="email" placeholder="Votre email..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Subject</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="subject" placeholder="Demandes, suggestions" style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <a href="index.php">Retour</a>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>