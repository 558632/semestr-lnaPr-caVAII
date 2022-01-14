<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Používateľ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" media="screen" type="text/css" href="./../globalRules.css">
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
            <div class="col-md-3 main_menu"><a class="main_menu" href="../mainPage/main_page.php">Hlavná stránka</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../listProducts/listProducts.php">Zoznam produktov</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../about/about.php">O nás</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="../logout/logout_page.php">Odhlásiť</a></div>
            <div class="col-md-3 main_menu"><a class="main_menu" href="user_administration.php">Používateľ</a></div>
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
            require "user_administration_server.php";
            if(isset($_POST['Odoslat2'])||isset($_POST['Odoslat3'])||isset($_POST['Odoslat4'])){
                $response=new serverResponseRegistration();
                echo $response;
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="accordion accordion-flush" id="accordionFlush">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#one">
                            Zmeniť heslo pužívateľa
                        </button>
                    </h2>
                    <div id="one" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="login1">Prihlasovacie meno:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="login1" id="login1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="heslo2">Staré heslo používateľa:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" name="heslo2" id="heslo2"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="heslo3">Nové heslo používateľa:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" name="heslo3" id="heslo3"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="heslo4">Nové heslo znova:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" name="heslo4" id="heslo4"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="submit" name="Odoslat2" value="Odoslať">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#two">
                            Odstrániť účet používateľa
                        </button>
                    </h2>
                    <div id="two" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="Cislo_op2">Číčslo občianskeho preukazu:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="Cislo_op2" id="Cislo_op2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="login2">Prihlasovacie meno:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="login2" id="login2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="heslo5">Heslo používateľa:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" name="heslo5" id="heslo5"><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="submit" name="Odoslat3" value="Odoslať" style="object-position: center">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#three">
                            Zmeniť meno a priezvisko používateľa
                        </button>
                    </h2>
                    <div id="three" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="password_for_modification1">Používateľské heslo:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" name="password_for_modification1" id="password_for_modification1">
                                        <div class="current_data">
                                            <?php echo "Váše používateľské meno: " . $_SESSION['isLoggedIn']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="name_modification1">Nové meno:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="name_modification1" id="name_modification1">
                                        <div class="current_data">
                                            <?php echo "Váše meno: " . getName($_SESSION['isLoggedIn'])?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="suername_modification1">Nové Priezvisko:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="suername_modification1" id="suername_modification1">
                                        <div class="current_data">
                                            <?php echo "Váše priezvisko: " . getSurname($_SESSION['isLoggedIn'])?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="submit" name="Odoslat4" value="Odoslať">
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
