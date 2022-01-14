<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>registracia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="client-side-form-check.js"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="./../globalRules.css">
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
          <div class="col-md-3 main_menu"><a class="main_menu" href="../mainPage/main_page.php">Hlavná stránka</a></div>
          <div class="col-md-3 main_menu"><a class="main_menu" href="../listProducts/listProducts.php">Zoznam produktov</a></div>
          <div class="col-md-3 main_menu"><a class="main_menu" href="../about/about.php">O nás</a></div>
          <div class="col-md-3 main_menu"><a class="main_menu" href="../login/prihlasenie_page.php">Prihlásenie</a></div>
          <div class="col-md-3 main_menu"><a class="main_menu" href="registracia_page.php">Registracia</a></div>
        </div>
    </div>
    <div class="row" id="imgRow">
        <div class="col-md-12">
          <img src="../obrazok_reprezentacny_1.jpg" alt="uvod" class="img-fluid">
        </div>
    </div>
    <div class="row" id="serverResponseRow">
        <div class="col-md-12" style="text-align: center">
            <?php
            require "server_response.php";
            if(isset($_POST['Odoslat1'])){
                $instancia=new serverResponseRegistration();
                echo $instancia;
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="accordion accordion-flush" id="accordion1">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Vykonať registráciu
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordion1">
                        <div class="accordion-body">
                            <form method="post">
                                <p>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#osInf" aria-expanded="false" aria-controls="osInf">
                                        Osobné informácie
                                    </button>
                                </p>
                                <div class="collapse" id="osInf">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="Meno">Meno:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="Meno" id="Meno">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="Priezvisko">Priezvisko:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="Priezvisko" id="Priezvisko">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="Cislo_op">Číslo občianskeho preukazu:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="Cislo_op" id="Cislo_op">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="Datum_narodenia">Dátum narodenia:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="Datum_narodenia" id="Datum_narodenia" placeholder="yyyy-m-d">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#kU" aria-expanded="false" aria-controls="kU">
                                        Kontaktné údaje
                                    </button>
                                </p>
                                <div class="collapse" id="kU">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="telefon">Telefónne číslo:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="telefon" id="telefon">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="email">E-mail:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="email" id="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#aB" aria-expanded="false" aria-controls="aB">
                                        Adresa trvalého bydliska
                                    </button>
                                </p>
                                <div class="collapse" id="aB">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="krajina">Krajina:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="krajina" id="krajina">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="Obec">Obec:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="Obec" id="Obec">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="psc">PSČ:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="psc" id="psc">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="ulica">Ulica:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="ulica" id="ulica">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="popisne">Číslo popisné:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="popisne" id="popisne">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pU" aria-expanded="false" aria-controls="pU">
                                        Prihlasovacie údaje
                                    </button>
                                </p>
                                <div class="collapse" id="pU">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="login">Prihlasovacie meno:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="login" id="login">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="heslo">Heslo používateľa:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="password" name="heslo" id="heslo">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="heslo1">Heslo používateľa znova:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="password" name="heslo1" id="heslo1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center">
                                        <input type="submit" name="Odoslat1" value="Odoslať">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
