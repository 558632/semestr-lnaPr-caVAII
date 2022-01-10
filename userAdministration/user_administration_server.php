<?php
require "./../globalFunctions.php";
class serverResponse{

    private mysqli $db;
    private string $response="";

    public function __construct(){
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
        checkDBError($this->db);
        $this->updatePassword();
        $this->delete();
        $this->updateNameAndSurname();
    }

    private function updateNameAndSurname() : bool{
        if(isset($_POST['Odoslat4'])){
            if(isset($_POST['password_for_modification1']) && isset($_POST['name_modification1']) && isset($_POST['suername_modification1'])){
                if($_POST['password_for_modification1'] == "" || $_POST['name_modification1']=="" ||$_POST['suername_modification1']==""){
                    return $this->addRow("Všetky polia musia byť zadané.<br>Zmena mena a priezvisko neprebehla.");
                }
                $username=$_SESSION['isLoggedIn'];
                if(!passwordValidity($_POST['password_for_modification1'], $username)){
                    return $this->addRow("Neplatné heslo.<br>Zmena mena a priezvisko neprebehla.");
                }
                $meno=$_POST['name_modification1'];
                $priezvisko=$_POST['suername_modification1'];
                $id_login_data=getIdLoginData_basedUsername($username);
                $par=$this->db->prepare("UPDATE osoba SET meno = ?, priezvisko = ? WHERE id_prihlasovacie_udaje = $id_login_data");
                $par->bind_param("ss", $meno, $priezvisko);
                $par->execute();
                checkDBError($this->db);
                $this->addRow("Zmena mena a priezvisko prebehla.");
                return true;
            }else{
                return $this->addRow("Všetky polia musia byť zadané.<br>Zmena mena a priezvisko neprebehla.");
            }
        }
        return false;
    }

    private function updatePassword() : bool{
        if(isset($_POST['Odoslat2'])){
            if(isset($_POST['login1']) && isset($_POST['heslo2']) && isset($_POST['heslo3']) && isset($_POST['heslo4'])){
                if($_POST['login1']=="" || $_POST['heslo2']=="" || $_POST['heslo3']=="" || $_POST['heslo4'] ==""){
                    return $this->addRow("Všetky polia musia byť zadané.<br>Zmena hesla neprebehla.");
                }
                $login=$_POST['login1'];
                if(!usernameExistence($login)){
                    return $this->addRow("Neplatný login.<br>Zmena hesla neprebehla.");
                }if(!passwordValidity($_POST['heslo2'], $login)){
                    return $this->addRow("Neplatné heslo.<br>Zmena hesla neprebehla.");
                }
                if($_POST['heslo3']!=$_POST['heslo4']){
                    return $this->addRow("Heslá sa nerovnajú.<br>Zmena hesla neprebehla.");
                }
                if(!$this->addRow(passwordCheck($_POST['heslo3']))){
                    return $this->addRow("Nové heslo nie je validné.<br>Zmena hesla neprebehla.");
                }
                $id_prihlasovacie_udaje=getIdLoginData_basedUsername($login);
                $heslo=password_hash($_POST['heslo3'], PASSWORD_DEFAULT);
                $par=$this->db->prepare("UPDATE prihlasovanice_udaje SET heslo = ? WHERE id_prihlasovacie_udaje = $id_prihlasovacie_udaje");
                $par->bind_param("s", $heslo);
                $par->execute();
                checkDBError($this->db);
                $this->addRow("Zmena hesla prebehla úspšne.");
                unset($_POST);
                return true;
            }else{
                return $this->addRow("Všetky polia musia byť zadané.<br>Zmena hesla neprebehla.");
            }
        }
        return false;
    }

    private function delete() : bool{
        if(isset($_POST['Odoslat3'])){
            if(isset($_POST['login2']) && isset($_POST['heslo5']) && isset($_POST['Cislo_op2'])){
                if($_POST['login2']=="" || $_POST['heslo5']=="" || $_POST['Cislo_op2']==""){
                    return $this->addRow("Všetky polia musia byť vyplnené.<br>Odstránenie účtu prebehlo.");
                }
                $login=$_POST['login2'];
                $op=$_POST['Cislo_op2'];
                if(!usernameExistence($login)){
                    return $this->addRow("Login neexistuje.<br>Odstránenie účtu neprebehlo.");
                }if(!personExistence($op)){
                    return $this->addRow("Cislo op neexistuje v databáze.<br>Odstránenie účtu neprebehlo.");
                }if(!passwordValidity($_POST['heslo5'], $login)){
                    return $this->addRow("Neplatné heslo.<br>Odstránenie účtu neprebehlo.");
                }if(getIdLoginData_basedUsername($login)!=getIdLoginData_basedOp($op)){
                    return $this->addRow("Osoba nemá takéto prihlasovacie údaje.<br>Odstránenie účtu neprebehlo.");
                }
                $id_adresy=getIdAddress_basedOp($op);
                $id_kontektne_udaje=getIdContact_basedOp($op);
                $id_prihlasovacie_udaje=getIdLoginData_basedOp($op);
                /*deletion*/
                //tu už netreba proti sql injection, lebo $op už bolo zvalidované ako vstup od klienta.
                $this->db->query("DELETE FROM osoba WHERE cislo_op LIKE '$op'");
                $this->db->query("DELETE FROM kontaktne_udaje WHERE id_kontektne_udaje LIKE '$id_kontektne_udaje'");
                $this->db->query("DELETE FROM prihlasovanice_udaje WHERE id_prihlasovacie_udaje LIKE '$id_prihlasovacie_udaje'");
                $this->db->query("DELETE FROM adresa WHERE id_adresy LIKE '$id_adresy'");
                $this->addRow("Odstránenie účtu prebehlo.");
                /*end deletion*/
                unset($_POST);
                return true;
            }else{
                return $this->addRow("Všetky polia musia byť vyplnené.<br>Odstránenie účtu prebehlo.");
            }
        }
        return false;
    }

    private function addRow($string) : bool{
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

    public function __toString(): string{
        return $this->response;
    }
}