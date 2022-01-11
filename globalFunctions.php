<?php
function usernameExistence ($username) : bool {
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query=$db->prepare("SELECT * FROM prihlasovanice_udaje WHERE login LIKE ?");
    $query->bind_param("s", $username);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return !($result->num_rows==0);
}
function passwordValidity($pass, $username) : bool{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE ?");
    $query->bind_param("s", $username);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return password_verify($pass, $result->fetch_assoc()['heslo']);
}
function passwordCheck($pass) : string{
    if(!isset($pass) || $pass==""){
        return "Heslo nie je zadané.";
    }if(!(strlen($pass)>5)){
        return "Heslo nemá aspoň 6 znakov.";
    }if(!preg_match("/[0-9]{2,}/", $pass)){
        return "Heslo musí obsahovať aspoň 2 číslice.";
    }if(!preg_match("/[A-Z]{2,}/", $pass)){
        return "Heslo musí obsahovať aspoň 2 veľké písmená.";
    }
    return "";
}
function personExistence($op) : bool{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT * FROM osoba WHERE cislo_op LIKE ?");
    $query->bind_param("s", $op);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return !($result->num_rows==0);
}
function getName($username) : string{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $id_login_data = getIdLoginData_basedUsername($username);
    $query = $db->prepare("SELECT meno FROM osoba WHERE id_prihlasovacie_udaje LIKE ?");
    $query->bind_param("i", $id_login_data);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return $result->fetch_assoc()['meno'];
}
function getIdLoginData_basedUsername($username) : int{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT id_prihlasovacie_udaje FROM prihlasovanice_udaje WHERE login LIKE ?");
    $query->bind_param("s", $username);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return $result->fetch_assoc()['id_prihlasovacie_udaje'];
}
function getIdAddress_basedOp($op) : int{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT id_adresy FROM osoba WHERE cislo_op LIKE ?");
    $query->bind_param("s", $op);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return $result->fetch_assoc()['id_adresy'];
}
function getIdContact_basedOp($op) : int{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT id_kontektne_udaje FROM osoba WHERE cislo_op LIKE ?");
    $query->bind_param("s", $op);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return $result->fetch_assoc()['id_kontektne_udaje'];
}
function getIdLoginData_basedOp($op) : int{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT id_prihlasovacie_udaje FROM osoba WHERE cislo_op LIKE ?");
    $query->bind_param("s", $op);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return $result->fetch_assoc()['id_prihlasovacie_udaje'];
}
function getSurname($username) : string{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $id_login_data = getIdLoginData_basedUsername($username);
    $query = $db->prepare("SELECT priezvisko FROM osoba WHERE id_prihlasovacie_udaje LIKE ?");
    $query->bind_param("i", $id_login_data);
    $query->execute();
    checkDBError($db);
    $result = $query->get_result();
    return $result->fetch_assoc()['priezvisko'];
}
function checkDBError($db) : void{
    if ($db->error) {
        die("DB error: " . $db->error);
    }
}
function addressRecExistence ($contry, $municipality, $psc, $street, $num) : mixed{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT id_adresy FROM adresa WHERE krajina LIKE ? AND obec LIKE ? AND psc LIKE ? AND ulica LIKE ? AND cislo_popisne LIKE ?");
    $query->bind_param("sssss", $contry, $municipality, $psc, $street, $num);
    $query->execute();
    checkDBError($db);
    $result=$query->get_result();
    return $result->fetch_assoc()['id_adresy'] ?? false;
}
function contactDataRecExistence ($email, $tel) : mixed{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db1');
    checkDBError($db);
    $query = $db->prepare("SELECT id_kontektne_udaje FROM kontaktne_udaje WHERE email LIKE ? AND telefon LIKE ?");
    $query->bind_param("ss", $email, $tel);
    $query->execute();
    checkDBError($db);
    $result=$query->get_result();
    return $result->fetch_assoc()['id_kontektne_udaje'] ?? false;
}
function categoryExistence ($catName) : mixed{
    $db = new mysqli('localhost', 'root', 'dtb456', 'db2');
    checkDBError($db);
    $query = $db->prepare("SELECT id_of_category FROM category WHERE name_of_category LIKE ?");
    $query->bind_param("s", $catName);
    $query->execute();
    checkDBError($db);
    $result=$query->get_result();
    return $result->fetch_assoc()['id_of_category'] ?? false;
}