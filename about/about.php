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
    <link rel="stylesheet" type="text/css" href="./../globalRules.css">
    <link rel="stylesheet" type="text/css" href="./localRulse.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./data.js"></script>
    <script>
        window.onload=function (){
            createData(data);
        }
        function createData(paData){
            let dataOfPlaces=paData;
            let element=document.getElementById("miesta");
            element.innerHTML="";
            element.innerHTML+=`<h3>Naše predajne:</h3>`;
            let content="";
            let buttons="";
            let municipalities = [];
            let keys=Object.keys(dataOfPlaces[0]);
            dataOfPlaces.forEach((object)=>{
                let item="";
                keys.forEach((att)=>{
                    if(att!="municipality"){
                        if(object["municipality"]=="Bratislava"){
                            if(item==""){
                                item+=`<div id="municipality_bratislava">`;
                            }
                            item+=`<strong>${att}</strong>`;
                            item+=`${object[att]}<br>`;
                        }else{
                            if(item==""){
                                item+=`<div id="municipalities_others">`;
                                item+=`<strong>${att}</strong>`;
                                item+=`${object[att]}<br>`;
                            }else{
                                item+=`<strong>${att}</strong>`;
                                item+=`${object[att]}<br>`;
                            }
                        }

                    }else{
                        if(municipalities.indexOf(object[att])==-1){
                            municipalities.push(object[att]);
                            buttons+=`<button class="by_municipality" onclick="vytvorDataPodlaOblasti(this)" type="button" id="${object[att]}">${object[att]}</button>`;
                        }
                    }
                });
                content+=`${item}</div><br>`;
            });
            element.innerHTML+=`${buttons}<br>`;
            element.innerHTML+=`${content}`;
        }
        function vytvorDataPodlaOblasti(paTlacidlo){
            let id=paTlacidlo.id;
            let dataMiest=data;
            let html=document.getElementById("miesta");
            html.innerHTML="";
            html.innerHTML+=`<h3>Naše predajne</h3>`;
            let htmlTela="";
            let htmlTlacidiel="";
            let oblast = [];
            let keys=Object.keys(dataMiest[0]);
            dataMiest.forEach((object)=>{
                let textRiadku="";
                keys.forEach((atribut)=>{
                    if(object["municipality"]==id){
                        if(atribut!="municipality"){
                            if(textRiadku==""){
                                textRiadku+=`<div class="by_municipality">`;
                            }
                            textRiadku+=`<strong>${atribut}</strong>`;
                            textRiadku+=`${object[atribut]}<br>`;
                        }
                    }else{
                        if(atribut=="municipality" && oblast.indexOf(object[atribut])==-1){
                            oblast.push(object[atribut]);
                            htmlTlacidiel+=`<button class="by_municipality" onclick="vytvorDataPodlaOblasti(this)" type="button" id="${object[atribut]}">${object[atribut]}</button>`;
                        }
                    }
                });
                if(textRiadku!=""){
                    htmlTela+=`${textRiadku}</div><br>`;
                }
            });
            html.innerHTML+=`<div>Načítané dáta pre oblasť: ${id}</div><br>`;
            html.innerHTML+=`<button class="all_municipalities" onclick="createData(data)" type="button" id="vsetkyOblasti">Načítať všetky oblasti</button>`;
            html.innerHTML+=`${htmlTlacidiel}<br><br>`;
            html.innerHTML+=`${htmlTela}`;
        }
    </script>
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
        <div class="col-12">
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