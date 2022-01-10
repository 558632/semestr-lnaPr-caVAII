<?php
    session_start();
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    $login = $_SESSION['isLoggedIn'];
    $value=0;
    $par=$db->prepare("UPDATE prihlasovanice_udaje SET jePrihlaseny = ? WHERE login LIKE '$login'");
    $par->bind_param("i", $value);
    $par->execute();
    unset($_SESSION['isLoggedIn']);
    session_destroy();
?>
