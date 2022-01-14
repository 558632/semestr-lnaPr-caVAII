<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>main page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="./../globalRules.css">
    <link rel="stylesheet" type="text/css" href="./localRules.css">
    <script>
        let povodne;
        function otvorObrazok(paObrazok, paNumber){
            povodne=document.getElementById("containter1").innerHTML;
            document.getElementById("containter1").innerHTML="";
            let src=paObrazok.src;
            let row = document.createElement("div");
            row.className="row";
            let col = document.createElement("div");
            col.className="col-md-12";
            col.style.textAlign="center";
            col.innerHTML=`<button class="view_abolition" onclick="zrusNahlad()" type="button">Zrušiť náhľad</button><a  target="_blank" href="${src}"><img src=${src} class="img-fluid clickable notZoomed1" alt=${paNumber}></a>`;
            row.appendChild(col);
            document.getElementById("containter1").append(row);
        }
        function zrusNahlad(){
            document.getElementById("containter1").innerHTML=povodne;
        }
    </script>
</head>
<body>
<div class="container" id="containter1">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
            <div class="col-md-3 main_menu"><a href="main_page.php" class="main_menu">Hlavná stránka</a></div>
            <div class="col-md-3 main_menu"><a href="../listProducts/listProducts.php" class="main_menu">Zoznam produktov</a></div>
            <div class="col-md-3 main_menu"><a href="../about/about.php" class="main_menu">O nás</a></div>
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
            <img src="../obrazok_reprezentacny_1.jpg" alt="uvod" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center"><p>Prezentácia záhrad, ktorých sme tvorcami:</p></div>
    </div>
    <div class="row images">
        <div class="col-md-4" style="padding-bottom: 9px" id="obrazok1">
            <img onclick="otvorObrazok(this, 1)" src="obrazok1.jpg" class="img-fluid clickable notZoomed2" alt="1">
        </div>
        <div class="col-md-4" style="padding-bottom: 9px" id="obrazok2">
            <img onclick="otvorObrazok(this, 2)" src="obrazok2.jpg" class="img-fluid clickable notZoomed2" alt="2">
        </div>
        <div class="col-md-4" style="padding-bottom: 9px" id="obrazok3">
            <img onclick="otvorObrazok(this, 3)" src="obrazok3.jpg" class="img-fluid clickable notZoomed2" alt="3">
        </div>
        <div class="col-md-4" style="padding-bottom: 9px" id="obrazok4">
            <img onclick="otvorObrazok(this, 4)" src="obrazok4.jpg" class="img-fluid clickable notZoomed2" alt="4">
        </div>
        <div class="col-md-4" style="padding-bottom: 9px" id="obrazok5">
            <img onclick="otvorObrazok(this, 5)" src="obrazok5.jpg" class="img-fluid clickable notZoomed2" alt="5">
        </div>
        <div class="col-md-4" style="padding-bottom: 9px" id="obrazok6">
            <img onclick="otvorObrazok(this, 6)" src="obrazok6.jpg" class="img-fluid clickable notZoomed2" alt="6">
        </div>
    </div>
</div>
</body>
</html>