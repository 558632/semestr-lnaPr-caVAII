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
    <script src="infoZoServera.js"></script>
    <link rel="stylesheet" type="text/css" href="client-side-form-check.css">
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
          <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a href="../main_page.html" style="color: black; text-decoration-line: none">Hlavná stránka</a></div>
          <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a href="../listProducts/listProducts.html" style="color: black; text-decoration-line: none">Zoznam produktov</a></div>
          <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a href="../about.html" style="color: black; text-decoration-line: none">O nás</a></div>
          <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a href="registracia.php" style="color: black; text-decoration-line: none">Registracia</a></div>
        </div>
    </div>
    <div class="row" id="imgRow">
        <div class="col-12">
          <img src="../11096490_1439627412996984_5157600893917446945_o.jpg" alt="uvod" class="img-fluid">
        </div>
    </div>
    <div class="row" id="serverResponseRow">
        <div class="col-12" style="text-align: center">
            <?php
            require "DBulozisko.php";
            if(isset($_POST['Odoslat1'])||isset($_POST['Odoslat2'])||isset($_POST['Odoslat3'])){
                $ul=new DBulozisko();
                //echo $ul->getVarDBErrs();
                if($ul->getVarDBErrs()!=null){
                    echo $ul->getVarDBErrs();
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Vykonať registráciu
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
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
                                            <div class="col-5" value>
                                                <label for="Meno">Meno:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="Meno" id="Meno">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="Priezvisko">Priezvisko:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="Priezvisko" id="Priezvisko">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="Cislo_op">Číslo občianskeho preukazu:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="Cislo_op" id="Cislo_op">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="Datum_narodenia">Dátum narodenia:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="Datum_narodenia" id="Datum_narodenia">
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
                                            <div class="col-5">
                                                <label for="telefon">Telefónne číslo:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="telefon" id="telefon">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="email">E-mail:</label>
                                            </div>
                                            <div class="col-7">
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
                                            <div class="col-5">
                                                <label for="krajina">Krajina:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="krajina" id="krajina">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="Obec">Obec:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="Obec" id="Obec">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="psc">PSČ:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="psc" id="psc">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="ulica">Ulica:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="ulica" id="ulica">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="popisne">Číslo popisné:</label>
                                            </div>
                                            <div class="col-7">
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
                                            <div class="col-5">
                                                <label for="login">Prihlasovacie meno:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="login" id="login">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="heslo">Heslo používateľa:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="password" name="heslo" id="heslo"><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <label for="heslo1">Heslo používateľa znova:</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="password" name="heslo1" id="heslo1"><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                    </div>
                                    <div class="col-7">
                                        <input type="submit" name="Odoslat1" value="Odoslať" style="object-position: center" data-toggle="modal" data-target="#exampleModalCenter">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Zmeniť heslo pužívateľa
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="login1">Prihlasovacie meno:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="text" name="login1" id="login1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="heslo2">Staré heslo používateľa:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="password" name="heslo2" id="heslo2"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="heslo3">Nové heslo používateľa:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="password" name="heslo3" id="heslo3"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="heslo4">Nové heslo znova:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="password" name="heslo4" id="heslo4"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                    </div>
                                    <div class="col-7">
                                        <input type="submit" name="Odoslat2" value="Odoslať" style="object-position: center">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Odstrániť účet používateľa
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="Cislo_op2">Číčslo občianskeho preukazu:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="text" name="Cislo_op2" id="Cislo_op2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="login2">Prihlasovacie meno:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="text" name="login2" id="login2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="heslo5">Heslo používateľa:</label>
                                    </div>
                                    <div class="col-7">
                                        <input type="password" name="heslo5" id="heslo5"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                    </div>
                                    <div class="col-7">
                                        <input type="submit" name="Odoslat3" value="Odoslať" style="object-position: center">
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
