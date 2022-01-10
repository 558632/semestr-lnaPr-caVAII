<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>list of products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./../globalRules.css">
    <link rel="stylesheet" type="text/css" href="localRules.css">
    <script src="DynTable.js"></script>
    <script src="tableData.js"></script>
    <script id="dyn_table">
        window.onload=function (){
            let table = new DynTable(tableData, document.getElementById("rowNaTabulku"));
        }
    </script>
    <script id="server_table">
        function generujTabulku(){
            document.getElementById("nacitanieTabulky").remove();
            document.getElementById("tabulka_zo_servera").innerHTML=`<button type="button" id="odstranenieTabulky" onclick="odstranTabulku()">Odstrániť</button>`;
            prekresliTabulku()
        }
        function odstranTabulku(){
            document.getElementById("odstranenieTabulky").remove();
            document.getElementById("tabulka_zo_servera").innerHTML=`<button type="button" id="nacitanieTabulky" onclick="generujTabulku()">Načítať</button>`;
            document.getElementById("tabulka_zo_servera_themselve").innerHTML="";
        }
        function prekresliTabulku(){
            const XMLHttp = new XMLHttpRequest();
            XMLHttp.onreadystatechange = function () {
                if (this.readyState != 4 || this.status != 200) {
                    return;
                }
                document.getElementById("tabulka_zo_servera_themselve").innerHTML=this.responseText;
            };
            XMLHttp.open("GET", "TableCreation.php", true);
            XMLHttp.send();
        }
    </script>
    <script id="table_insertion">
        function tryInsert(){
            let category = document.getElementById("category_p_i").value;
            let productName = document.getElementById("name_p_i").value;
            let productDesc = document.getElementById("desc_p_i").value;
            const XMLHttp = new XMLHttpRequest();
            XMLHttp.onreadystatechange = function () {
                if (this.readyState != 4 || this.status != 200) {
                    return;
                }
                if(document.getElementById("serverResponse_insertion")!=null){
                    document.getElementById("serverResponse_insertion").remove();
                }
                let elemnt = document.createElement("div");
                elemnt.id="serverResponse_insertion";
                elemnt.innerText=this.responseText;
                document.getElementById("odstranenieTabulky").after(elemnt);
                prekresliTabulku()
            };
            XMLHttp.open("POST", "itemInsertion.php", true);
            XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XMLHttp.send("category_p_i=" + category + "&name_p_i=" + productName + "&desc_p_i=" + productDesc);
        }
    </script>
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
            <div class="col-md-3 main_menu"><a class="main_menu" href="../mainPage/main_page.php">Hlavná stránka</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="listProducts.php">Zoznam produktov</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../about/about.php">O nás</a></div>
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
            <img src="../obrazok_reprezentacny_1.jpg" alt="uvod" class="img-fluid">
        </div>
    </div>
    <div style="text-align: center"><h4>Dynamická tabuľka produktov</h4></div>
    <div class="row" style="padding-top: 9px; padding-bottom: 9px" id="rowNaTabulku">
    </div>
    <!--Tabuľka produktov z databázy generovaná pomocou ajax    -->
    <div style="text-align: center" id="nadpis_tabulka_zo_servera"><h4>Tabuľka produktov z databázy</h4></div>
    <div class="row" id="tabulka_zo_servera_row">
        <div class="col-12" style="text-align: center" id="tabulka_zo_servera">
            <button type="button" id="nacitanieTabulky" onclick="generujTabulku()">Načítať</button>
        </div>
    </div>
    <div class="row" style="padding-top: 9px; padding-bottom: 9px" id="tabulka_zo_servera_themselve">
    </div>
</div>
</body>
</html>