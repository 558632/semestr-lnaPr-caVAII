<?php
require "./../globalFunctions.php";
require "./../serverResponseInterface.php";
class serverResponseRegistration implements serverResponseInterface {
    private mysqli $db;
    private string $response="";

    public function __construct(){
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
        checkDBError($this->db);
        $this->insert();
    }

    public function insert() : bool{
        if ($this->addRow(passwordCheck($_POST['heslo'])) && $this->validnyLogin($_POST['login'])
            && $this->zhodneHela($_POST['heslo'], $_POST['heslo1']) && $this->validnaOsoba($_POST['Cislo_op'])){
            #prihlasovacie udaje
            $id_prihlasovacie_udaje=$this->db->query("SELECT MAX(id_prihlasovacie_udaje) FROM prihlasovanice_udaje")->fetch_assoc()['MAX(id_prihlasovacie_udaje)']+1;
            $login=$_POST['login'];
            $heslo=password_hash($_POST['heslo'], PASSWORD_DEFAULT);
            $par=$this->db->prepare("INSERT INTO prihlasovanice_udaje(id_prihlasovacie_udaje, login, heslo, jePrihlaseny) VALUES(?, ?, ?, ?)");
            $status=0;
            $par->bind_param("issi", $id_prihlasovacie_udaje, $login, $heslo, $status);
            $par->execute();
            checkDBError($this->db);
            #adresa
            if(!($id_adresy=addressRecExistence($_POST['krajina'], $_POST['Obec'], $_POST['psc'], $_POST['ulica'], $_POST['popisne']))){
                $id_adresy=$this->db->query("SELECT MAX(id_adresy) FROM adresa")->fetch_assoc()['MAX(id_adresy)']+1;
                $krajina=$_POST['krajina'];
                $obec=$_POST['Obec'];
                $psc=$_POST['psc'];
                $ulica=$_POST['ulica'];
                $cislo_popisne=$_POST['popisne'];
                $par=$this->db->prepare("INSERT INTO adresa(id_adresy, krajina, obec, psc, ulica, cislo_popisne) VALUES(?, ?, ?, ?, ?, ?)");
                $par->bind_param("isssss", $id_adresy, $krajina, $obec, $psc, $ulica, $cislo_popisne);
                $par->execute();
                checkDBError($this->db);
            }
            #kontaktne udaje
            if(!($id_kontaktne_udaje=contactDataRecExistence($_POST['email'], $_POST['telefon']))){
                $id_kontaktne_udaje=$this->db->query("SELECT MAX(id_kontektne_udaje) FROM kontaktne_udaje")->fetch_assoc()['MAX(id_kontektne_udaje)']+1;
                $telefon=$_POST['telefon'];
                $email=$_POST['email'];
                $par=$this->db->prepare("INSERT INTO kontaktne_udaje(id_kontektne_udaje, telefon, email) VALUES(?, ?, ?)");
                $par->bind_param("iss", $id_kontaktne_udaje, $telefon, $email);
                $par->execute();
                checkDBError($this->db);
            }
            #osoba
            $cislo_op=$_POST['Cislo_op'];
            $meno=$_POST['Meno'];
            $priezvisko=$_POST['Priezvisko'];
            $datum_narodenia=$_POST['Datum_narodenia'];
            $par=$this->db->prepare("INSERT INTO osoba(cislo_op, id_adresy, id_kontektne_udaje, id_prihlasovacie_udaje, meno, priezvisko, datum_narodenia) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $par->bind_param("siiisss", $cislo_op, $id_adresy, $id_kontaktne_udaje, $id_prihlasovacie_udaje, $meno, $priezvisko, $datum_narodenia);
            $par->execute();
            checkDBError($this->db);
            $this->addRow("Registr??cia prebehla.");
            unset($_POST);
            return true;
        }
        return $this->addRow("Registr??cia neprebehla.");
    }

    public function addRow($string) : bool{
        if($string!=""){
            if($this->response==""){
                $this->response=$string;
            }else{
                $this->response.="<br>".$string;
            }
            return false;
        }
        return true;
    }

    private function validnyLogin($login) : bool{
        if (isset($login) && $login!=""){
            if (preg_match("/^.{2,}$/", $login)){
                if(usernameExistence($login)){
                    $this->addRow("Login je u?? obsaden??.");
                    return false;
                }
                return true;
            }else {
                $this->addRow("Login nem?? stanoven?? form??t.");
                return false;
            }
        }
        $this->addRow("Login nie je zadan??.");
        return false;
    }

    private function zhodneHela($heslo, $heslo1) : bool{
        if (isset($heslo) && isset($heslo1) && $heslo !="" && $heslo1 !="") {
            if ($heslo == $heslo1) {
                return true;
            }else{
                $this->addRow("Hesl?? sa nezhoduj??.");
                return false;
            }
        }
        $this->addRow("Jedno z hesiel alebo obe nie su zadane.");
        return false;
    }

    private function validnaOsoba($op) : bool{
        if (isset($op) && $op!="") {
            if ($this->db->query("SELECT * FROM osoba WHERE cislo_op LIKE '$op'")->num_rows == 0){
                if(preg_match("/^.{5,}$/", $op)){
                    return true;
                }else{
                    $this->addRow("??????slo nem?? aspo?? 5 znakov.");
                    return false;
                }
            }else{
                $this->addRow("Dan?? osoba u?? je registrovan??.");
                return false;
            }
        }
        $this->addRow("????slo op nie je zadan??.");
        return false;
    }

    public function __toString(): string{
        return $this->response;
    }
}