<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Odhlásenie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="./../globalRules.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../globalFunctions.js"></script>
    <script>
        function logoutF(){
            const XMLHttp = new XMLHttpRequest();
            XMLHttp.onreadystatechange = function () {
                if (this.readyState != 4 || this.status != 200) {
                    return;
                }
                alert("Odhlásenie prebehlo v poriadku. O 3 sekundy budete presmerovaný na hlavnú stránku.");
                sleep(3000).then(()=>{
                    window.open("./../mainPage/main_page.php", "_self");
                });
            };
            XMLHttp.open("GET", "logout_server.php", true);
            XMLHttp.send();
        }
    </script>
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
            <div class="col-md-3 main_menu"><a class="main_menu" href="../mainPage/main_page.php">Hlavná stránka</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../listProducts/listProducts.php">Zoznam produktov</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../about/about.php">O nás</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../logout/logout_page.php">Odhlásenie</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../userAdministration/user_administration.php">Používateľ</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <img src="../obrazok_reprezentacny_1.jpg" alt="obrazok_reprezentacny_1" class="img-fluid">
        </div>
    </div>
    <div class="row" id="text" style="padding-top: 9px">
        <div class="col-md-12" style="text-align: center">
            <button onclick="logoutF()" type="button">Odhlásiť sa</button>
        </div>
    </div>
</div>
</body>
</html>
