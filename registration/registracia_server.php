<?php
class DBulozisko
{
    private $db;
    private $varDBErrs="";

    public function __construct(){
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
        $this->checkDBError();
        $this->insert();
    }

    public function getVarDBErrs(){
        if($this->varDBErrs!=""){
            return $this->varDBErrs;
        }
    }

    public function insert(){
        if (isset($_POST['Odoslat1'])){
            if ($this->validneHeslo($_POST['heslo']) && $this->validnyLogin($_POST['login'])
                && $this->zhodneHela($_POST['heslo'], $_POST['heslo1']) && $this->validnaOsoba($_POST['Cislo_op'])){
                #prihlasovacie udaje
                $id_prihlasovacie_udaje=$this->db->query("SELECT MAX(id_prihlasovacie_udaje) FROM prihlasovanice_udaje")->fetch_assoc()['MAX(id_prihlasovacie_udaje)']+1;
                $login=$_POST['login'];
                $heslo=$_POST['heslo'];
                $par=$this->db->prepare("INSERT INTO prihlasovanice_udaje(id_prihlasovacie_udaje, login, heslo, jePrihlaseny) VALUES(?, ?, ?, ?)");
                $status=0;
                $par->bind_param("issi", $id_prihlasovacie_udaje, $login, $heslo, $status);
                $par->execute();
                $this->checkDBError();
                #adresa
                $id_adresy=$this->db->query("SELECT MAX(id_adresy) FROM adresa")->fetch_assoc()['MAX(id_adresy)']+1;
                $krajina=$_POST['krajina'];
                $obec=$_POST['Obec'];
                $psc=$_POST['psc'];
                $ulica=$_POST['ulica'];
                $cislo_popisne=$_POST['popisne'];
                $par=$this->db->prepare("INSERT INTO adresa(id_adresy, krajina, obec, psc, ulica, cislo_popisne) VALUES(?, ?, ?, ?, ?, ?)");
                $par->bind_param("isssss", $id_adresy, $krajina, $obec, $psc, $ulica, $cislo_popisne);
                $par->execute();
                $this->checkDBError();
                #kontaktne udaje
                $id_kontaktne_udaje=$this->db->query("SELECT MAX(id_kontektne_udaje) FROM kontaktne_udaje")->fetch_assoc()['MAX(id_kontektne_udaje)']+1;
                $telefon=$_POST['telefon'];
                $email=$_POST['email'];
                $par=$this->db->prepare("INSERT INTO kontaktne_udaje(id_kontektne_udaje, telefon, email) VALUES(?, ?, ?)");
                $par->bind_param("iss", $id_kontaktne_udaje, $telefon, $email);
                $par->execute();
                $this->checkDBError();
                #osoba
                $cislo_op=$_POST['Cislo_op'];
                $meno=$_POST['Meno'];
                $priezvisko=$_POST['Priezvisko'];
                $datum_narodenia=$_POST['Datum_narodenia'];
                $par=$this->db->prepare("INSERT INTO osoba(cislo_op, id_adresy, id_kontektne_udaje, id_prihlasovacie_udaje, meno, priezvisko, datum_narodenia) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $par->bind_param("siiisss", $cislo_op, $id_adresy, $id_kontaktne_udaje, $id_prihlasovacie_udaje, $meno, $priezvisko, $datum_narodenia);
                $par->execute();
                $this->checkDBError();
                $this->addRow("Registrácia prebehla.");
                unset($_POST);
                return true;
            }
            $this->addRow("Registrácia neprebehla.");
            return false;
        }
        return false;
    }

    private function checkDBError(){
        if ($this->db->error) {
            die("DB error:" . $this->db->error);
        }
    }

    private function validneHeslo($heslo){
        if (isset($heslo) && $heslo!=""){
            if (preg_match("/^.{6,}$/", $heslo) == true
                && preg_match("/[0-9]{2,}/", $heslo) == true
                && preg_match("/[A-Z]{2,}/", $heslo) == true) {
                return true;
            }else{
                $this->addRow("Heslo nemá stanovený formát.");
                return false;
            }
        }
        $this->addRow("Heslo nie je zadané.");
        return false;
    }

    private function addRow($string){
        if($this->varDBErrs==""){
            $this->varDBErrs=$string;
        }else{
            $this->varDBErrs=$this->varDBErrs."<br>".$string;
        }
    }

    private function validnyLogin($login){
        if (isset($login) && $login!=""){
            if (preg_match("/^.{2,}$/", $login)){
                if ($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$login'")->num_rows == 0) {
                    return true;
                }else{
                    $this->addRow("Login je už obsadený.");
                    return false;
                }
            }else {
                $this->addRow("Login nemá stanovený formát.");
                return false;
            }
        }
        $this->addRow("Login nie je zadaný.");
        return false;
    }

    private function zhodneHela($heslo, $heslo1){
        if (isset($heslo) && isset($heslo1) && $heslo !="" && $heslo1 !="") {
            if ($heslo == $heslo1) {
                return true;
            }else{
                $this->addRow("Heslá sa nezhodujú.");
                return false;
            }
        }
        $this->addRow("Jedno z hesiel alebo obe nie su zadane.");
        return false;
    }

    private function validnaOsoba($op){
        if (isset($op) && $op!="") {
            if ($this->db->query("SELECT * FROM osoba WHERE cislo_op LIKE '$op'")->num_rows == 0){
                if(preg_match("/^.{5,}$/", $op)){
                    return true;
                }else{
                    $this->addRow("Číčslo nemá aspoň 5 znakov.");
                    return false;
                }
            }else{
                $this->addRow("Daná osoba už je registrovaná.");
                return false;
            }
        }
        $this->addRow("Číslo op nie je zadané.");
        return false;
    }
}
?>