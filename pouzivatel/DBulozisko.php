<?php
require "IStorage.php";
require "registracia_class.php";

class DBulozisko implements IStorage
{
    private $db;
    private $varDBErrs="";

    public function __construct()
    {
        #pripojenie k databázi
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
        $this->checkDBError();
        $this->insert();
        $this->update();
        $this->delete();
    }

    public function getVarDBErrs(){
        if($this->varDBErrs!=""){
            return $this->varDBErrs;
        }
    }

    public function dajVsetkyData()
    {
        $result = [];
        $sql = "SELECT * FROM osoba";
        $dbResult = $this->db->query($sql);
        if ($dbResult->num_rows > 0) {
            while ($record = $dbResult->fetch_assoc()) {
                $id_adresy = $record['id_adresy'];
                $id_kontektne_udaje = $record['id_kontektne_udaje'];
                $id_prihlasovacie_udaje = $record['id_prihlasovacie_udaje'];
                $krajina = $this->db->query("SELECT krajina FROM adresa WHERE id_adresy LIKE $id_adresy");
                $obec = $this->db->query("SELECT obec FROM adresa WHERE id_adresy LIKE $id_adresy");
                $psc = $this->db->query("SELECT psc FROM adresa WHERE id_adresy LIKE $id_adresy");
                $ulica = $this->db->query("SELECT ulica FROM adresa WHERE id_adresy LIKE $id_adresy");
                $cislo_popisne = $this->db->query("SELECT cislo_popisne FROM adresa WHERE id_adresy LIKE $id_adresy");
                $telefon = $this->db->query("SELECT telefon FROM kontaktne_udaje WHERE id_kontektne_udaje LIKE $id_kontektne_udaje");
                $email = $this->db->query("SELECT email FROM kontaktne_udaje WHERE id_kontektne_udaje LIKE $id_kontektne_udaje");
                $login = $this->db->query("SELECT login FROM prihlasovanice_udaje WHERE id_prihlasovacie_udaje LIKE $id_prihlasovacie_udaje");
                $heslo = $this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE id_prihlasovacie_udaje LIKE $id_prihlasovacie_udaje");
                $result[] = new registracia($krajina->fetch_assoc()['krajina'], $obec->fetch_assoc()['obec'], $psc->fetch_assoc()['psc'], $ulica->fetch_assoc()['ulica'], $cislo_popisne->fetch_assoc()['cislo_popisne'], $telefon->fetch_assoc()['telefon'], $email->fetch_assoc()['email'], $record['cislo_op'], $record['meno'], $record['priezvisko'], $record['datum_narodenia'], $login->fetch_assoc()['login'], $heslo->fetch_assoc()['heslo']);
            }
        }
        return $result;
    }

    public function insert()
    {
        if (isset($_POST['Odoslat1'])==true) {
            if ($this->validneHeslo($_POST['heslo']) == true && $this->validnyLogin($_POST['login']) == true
                && $this->zhodneHela($_POST['heslo'], $_POST['heslo1']) == true &&
                $this->validnaOsoba($_POST['Cislo_op'])==true){
                #prihlasovacie udaje
                $id_prihlasovacie_udaje=$this->db->query("SELECT MAX(id_prihlasovacie_udaje) FROM prihlasovanice_udaje")->fetch_assoc()['MAX(id_prihlasovacie_udaje)']+1;
                $login=$_POST['login'];
                $heslo=$_POST['heslo'];
                $par=$this->db->prepare("INSERT INTO prihlasovanice_udaje(id_prihlasovacie_udaje, login, heslo) VALUES(?, ?, ?)");
                $par->bind_param("iss", $id_prihlasovacie_udaje, $login, $heslo);
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
                $var="Registrácia prebehla.";
                $this->addRow($var);
                unset($_POST);
                return true;
            }
            $var="Registrácia neprebehla.";
            $this->addRow($var);
            return false;
        }
        return false;
    }

    public function update()
    {
        if(isset($_POST['Odoslat2'])==true){
            if(isset($_POST['login1'])!=false && isset($_POST['heslo2'])!=false){
                $login=$_POST['login1'];
                if($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$login'")->num_rows==1
                    && $this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['heslo']==$_POST['heslo2']
                    ){
                    if($this->validneHeslo($_POST['heslo3'])==true &&
                        $this->validneHeslo($_POST['heslo4'])==true &&
                        $_POST['heslo3'] == $_POST['heslo4']){
                        $id_prihlasovacie_udaje=$this->db->query("SELECT id_prihlasovacie_udaje FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['id_prihlasovacie_udaje'];
                        $heslo=$_POST['heslo3'];
                        $par=$this->db->prepare("UPDATE prihlasovanice_udaje SET heslo = ? WHERE id_prihlasovacie_udaje = $id_prihlasovacie_udaje");
                        $par->bind_param("s", $heslo);
                        $par->execute();
                        $this->checkDBError();
                        $var="Zmena hesla prebehla úspšne.";
                        $this->addRow($var);
                        unset($_POST);
                        return true;
                    }
                }
            }
            $var="Zmena hesla neprebehla.";
            $this->addRow($var);
        }
        return false;
    }

    public function delete()
    {
        if(isset($_POST['Odoslat3'])==true){
            if(isset($_POST['login2'])!=false && isset($_POST['heslo5'])!=false
                && isset($_POST['Cislo_op2'])!=false){
                $login=$_POST['login2'];
                $op=$_POST['Cislo_op2'];
                if($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$login'")->num_rows==1
                    && $this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['heslo']==$_POST['heslo5']
                    && $this->db->query("SELECT * FROM osoba WHERE cislo_op LIKE '$op'")->num_rows==1
                ){
                    $id_adresy=$this->db->query("SELECT id_adresy FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_adresy'];
                    $id_kontektne_udaje=$this->db->query("SELECT id_kontektne_udaje FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_kontektne_udaje'];
                    $id_prihlasovacie_udaje=$this->db->query("SELECT id_prihlasovacie_udaje FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_prihlasovacie_udaje'];
                    $this->db->query("DELETE FROM osoba WHERE cislo_op LIKE '$op'");
                    $this->db->query("DELETE FROM kontaktne_udaje WHERE id_kontektne_udaje LIKE '$id_kontektne_udaje'");
                    $this->db->query("DELETE FROM prihlasovanice_udaje WHERE id_prihlasovacie_udaje LIKE '$id_prihlasovacie_udaje'");
                    $this->db->query("DELETE FROM adresa WHERE id_adresy LIKE '$id_adresy'");
                    $var="Odstránenie účtu prebehlo.";
                    $this->addRow($var);
                    unset($_POST);
                    return true;
                }
            }
            $var="Odstránenie účtu neprebehlo.";
            $this->addRow($var);
        }
        return false;
    }
    private function checkDBError()
    {
        if ($this->db->error) {
            die("DB error:" . $this->db->error);
        }
    }

    private function validneHeslo($heslo)
    {
        if (isset($heslo) == true) {
            if (preg_match("/^.{6,}$/", $heslo) == true
                && preg_match("/[0-9]{2,}/", $heslo) == true
                && preg_match("/[A-Z]{2,}/", $heslo) == true) {
                return true;
            } else {
                $var="Heslo nemá stanovený formát.";
                $this->addRow($var);
                return false;
            }
        }
        return false;
    }

    private function addRow($string){
        if($this->varDBErrs==""){
            $this->varDBErrs=$string;
        }else{
            $this->varDBErrs=$this->varDBErrs."<br>".$string;
        }
    }

    private function validnyLogin($login)
    {
        if (isset($login) == true) {
            if (preg_match("/^.{2,}$/", $login) == true) {
                if ($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$login'")->num_rows == 0) {
                    return true;
                }else{
                    $var="Login je už obsadený.";
                    $this->addRow($var);
                    return false;
                }
            } else {
                $var="Login nemá stanovený formát.";
                $this->addRow($var);
                return false;
            }
        }
        return false;
    }

    private function zhodneHela($heslo, $heslo1)
    {
        if (isset($heslo) == true && isset($heslo1) == true) {
            if ($heslo == $heslo1) {
                return true;
            }else{
                $var="Heslá sa nezhodujú.";
                $this->addRow($var);
                return false;
            }
        }
        return false;
    }

    private function validnaOsoba($op)
    {
        if (isset($op) == true) {
            if ($this->db->query("SELECT * FROM osoba WHERE cislo_op LIKE '$op'")->num_rows == 0
                && preg_match("/^.{2,}$/", $op) == true) {
                return true;
            }else{
                $var="Daná osoba už je registrovaná.";
                $this->addRow($var);
                return false;
            }
        }
        return false;
    }
}