<?php
class DBulozisko{

    private $db;
    private $varDBErrs="";

    public function __construct(){
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
        $this->checkDBError();
        $this->updatePassword();
        $this->delete();
        $this->updateNameAndSurname();
    }

    public function updateNameAndSurname(){
        if(isset($_POST['Odoslat4'])){
            if(isset($_POST['password_for_modification1']) && isset($_POST['name_modification1']) && isset($_POST['suername_modification1'])){
                if($_POST['password_for_modification1'] == "" || $_POST['name_modification1']=="" ||$_POST['suername_modification1']==""){
                    $this->addRow("Všetky polia musia byť zadané.");
                    $this->addRow("Zmena mena a priezvisko neprebehla.");
                    return false;
                }
                $username=$_SESSION['isLoggedIn'];
                if($this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE '$username'")->fetch_assoc()['heslo']!=$_POST['password_for_modification1']){
                    $this->addRow("Neplatné heslo.");
                    $this->addRow("Zmena mena a priezvisko neprebehla.");
                    return false;
                }
                $meno=$_POST['name_modification1'];
                $priezvisko=$_POST['suername_modification1'];
                $id_prihlasovacie_uadje=$this->db->query("SELECT id_prihlasovacie_udaje FROM prihlasovanice_udaje WHERE login LIKE '$username'")->fetch_assoc()['id_prihlasovacie_udaje'];
                $par=$this->db->prepare("UPDATE osoba SET meno = ?, priezvisko = ? WHERE id_prihlasovacie_udaje = $id_prihlasovacie_uadje");
                $par->bind_param("ss", $meno, $priezvisko);
                $par->execute();
                $this->checkDBError();
                $this->addRow("Zmena mena a priezvisko prebehla.");
                return true;
            }else{
                $this->addRow("Všetky polia musia byť zadané.");
                $this->addRow("Zmena mena a priezvisko neprebehla.");
                return false;
            }
        }
        return false;
    }

    public function getVarDBErrs(){
        if($this->varDBErrs!=""){
            return $this->varDBErrs;
        }
    }

    public function updatePassword(){
        if(isset($_POST['Odoslat2'])){
            if(isset($_POST['login1']) && isset($_POST['heslo2']) && isset($_POST['heslo3']) && isset($_POST['heslo4'])){
                if($_POST['login1']=="" || $_POST['heslo2']=="" || $_POST['heslo3']=="" || $_POST['heslo4'] ==""){
                    $this->addRow("Všetky polia musia byť zadané.");
                    $this->addRow("Zmena hesla neprebehla.");
                    return false;
                }
                $login=$_POST['login1'];
                if($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$login'")->num_rows==0){
                    $this->addRow("Neplatný login.");
                    $this->addRow("Zmena hesla neprebehla.");
                    return false;
                }if($this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['heslo']!=$_POST['heslo2']){
                    $this->addRow("Neplatné heslo.");
                    $this->addRow("Zmena hesla neprebehla.");
                    return false;
                }
                if($_POST['heslo3']!=$_POST['heslo4']){
                    $this->addRow("Heslá sa nerovnajú.");
                    $this->addRow("Zmena hesla neprebehla.");
                    return false;
                }
                if(!$this->validneHeslo($_POST['heslo3'])){
                    $this->addRow("Nové heslo nie je validné.");
                    $this->addRow("Zmena hesla neprebehla.");
                    return false;
                }
                $id_prihlasovacie_udaje=$this->db->query("SELECT id_prihlasovacie_udaje FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['id_prihlasovacie_udaje'];
                $heslo=$_POST['heslo3'];
                $par=$this->db->prepare("UPDATE prihlasovanice_udaje SET heslo = ? WHERE id_prihlasovacie_udaje = $id_prihlasovacie_udaje");
                $par->bind_param("s", $heslo);
                $par->execute();
                $this->checkDBError();
                $this->addRow("Zmena hesla prebehla úspšne.");
                unset($_POST);
                return true;
            }else{
                $this->addRow("Všetky polia musia byť zadané.");
                $this->addRow("Zmena hesla neprebehla.");
                return false;
            }
        }
        return false;
    }

    public function delete(){
        if(isset($_POST['Odoslat3'])){
            if(isset($_POST['login2']) && isset($_POST['heslo5']) && isset($_POST['Cislo_op2'])){
                if($_POST['login2']=="" || $_POST['heslo5']=="" || $_POST['Cislo_op2']==""){
                    $this->addRow("Všetky polia musia byť vyplnené.");
                    $this->addRow("Odstránenie účtu prebehlo.");
                    return false;
                }
                $login=$_POST['login2'];
                $op=$_POST['Cislo_op2'];
                if($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$login'")->num_rows==0){
                    $this->addRow("Login neexistuje.");
                    $this->addRow("Odstránenie účtu neprebehlo.");
                    return false;
                }if($this->db->query("SELECT * FROM osoba WHERE cislo_op LIKE '$op'")->num_rows==0){
                    $this->addRow("Cislo op neexistuje v databáze.");
                    $this->addRow("Odstránenie účtu neprebehlo.");
                    return false;
                }if($this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['heslo']!=$_POST['heslo5']){
                    $this->addRow("Neplatné heslo.");
                    $this->addRow("Odstránenie účtu neprebehlo.");
                    return false;
                }if($this->db->query("SELECT id_prihlasovacie_udaje FROM prihlasovanice_udaje WHERE login LIKE '$login'")->fetch_assoc()['id_prihlasovacie_udaje']!=$this->db->query("SELECT id_prihlasovacie_udaje FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_prihlasovacie_udaje']){
                    $this->addRow("Osoba nemá takého prihlasovacie údaje.");
                    $this->addRow("Odstránenie účtu neprebehlo.");
                    return false;
                }
                $id_adresy=$this->db->query("SELECT id_adresy FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_adresy'];
                $id_kontektne_udaje=$this->db->query("SELECT id_kontektne_udaje FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_kontektne_udaje'];
                $id_prihlasovacie_udaje=$this->db->query("SELECT id_prihlasovacie_udaje FROM osoba WHERE cislo_op LIKE '$op'")->fetch_assoc()['id_prihlasovacie_udaje'];
                $this->db->query("DELETE FROM osoba WHERE cislo_op LIKE '$op'");
                $this->db->query("DELETE FROM kontaktne_udaje WHERE id_kontektne_udaje LIKE '$id_kontektne_udaje'");
                $this->db->query("DELETE FROM prihlasovanice_udaje WHERE id_prihlasovacie_udaje LIKE '$id_prihlasovacie_udaje'");
                $this->db->query("DELETE FROM adresa WHERE id_adresy LIKE '$id_adresy'");
                $this->addRow("Odstránenie účtu prebehlo.");
                unset($_POST);
                return true;
            }else{
                $this->addRow("Všetky polia musia byť vyplnené.");
                $this->addRow("Odstránenie účtu prebehlo.");
                return false;
            }
        }
        return false;
    }

    private function checkDBError(){
        if ($this->db->error) {
            die("DB error:" . $this->db->error);
        }
    }

    private function validneHeslo($heslo){
        if (preg_match("/^.{6,}$/", $heslo) && preg_match("/[0-9]{2,}/", $heslo) && preg_match("/[A-Z]{2,}/", $heslo)){
            return true;
        }else{
            $this->addRow("Heslo nemá stanovený formát.");
            return false;
        }
    }

    private function addRow($string){
        if($this->varDBErrs==""){
            $this->varDBErrs=$string;
        }else{
            $this->varDBErrs=$this->varDBErrs."<br>".$string;
        }
    }
}
?>