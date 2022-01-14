<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>O nás</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="./../globalRules.css">
    <link rel="stylesheet" type="text/css" href="./localRulse.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./data.js"></script>
    <script src="dataCreation.js"></script>
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
            <div class="col-md-3 main_menu"><a class="main_menu" href="../mainPage/main_page.php">Hlavná stránka</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../listProducts/listProducts.php">Zoznam produktov</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="about.php">O nás</a></div>
            <?php
            if(isset($_SESSION['isLoggedIn'])){
                echo '<div class="col-md-3 main_menu"><a class="main_menu" href="../logout/logout_page.php">Odhlásenie</a></div>
                <div class="col-md-3 main_menu"><a class="main_menu" href="../userAdministration/user_administration.php">Používateľ</a></div>';
            }else{
                echo '<div class="col-md-3 main_menu"><a class="main_menu" href="../login/prihlasenie_page.php">Prihlásenie</a></div>
                <div class="col-md-3 main_menu"><a class="main_menu" href="../registration/registracia_page.php">Registracia</a></div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <img src="../obrazok_reprezentacny_1.jpg" alt="obrazok_reprezentacny_1" class="img-fluid">
        </div>
    </div>
    <div class="row" id="text" style="padding-top: 9px">
        <h3>
            O nás:
        </h3>
        <p>
            Spoločnosť Záhrada, s. r. o. sa venuje návrhu dizajnu a starostlivosti o záhrady a predaju živých rastlín a pomôcok.
        </p>
        <h3>
            Konatelia:
        </h3>
        <p>
            Ing. Jozef Mrkvička, Ing. Marta Mrkvičková
        </p>
    </div>
    <div class="row" style="padding-top: 9px">
        <div class="col-md-12" id="miesta">
        </div>
    </div>
</div>
</body>
</html>