<?php
    session_start();
    require "./../globalFunctions.php";
    if($_POST['username_prihlasenie']=="" || $_POST['password_prihlasenie']==""){
        echo "Nezadali ste meno alebo heslo alebo ani jedno.\n";
    }else{
        $check = new checkLogin($_POST['username_prihlasenie'], $_POST['password_prihlasenie']);
        if(!usernameExistence($_POST['username_prihlasenie'])){
            echo "Neplatný login.\n";
            return 1;
        }
        if(!passwordValidity($_POST['password_prihlasenie'], $_POST['username_prihlasenie'])){
            echo "Neplatné heslo.\n";
            return 2;
        }
        if($check->prihlasUsera()==false){
            echo "Používateľ je už prihlásený.\n";
            return 3;
        }
        $_SESSION['isLoggedIn']=$_POST['username_prihlasenie'];
        echo "Prihlásenie prebehlo v poriadku.\nO 3 sekundy budete presmerovaní na hlavnú stránku.";
        return 4;
    }
    class checkLogin
    {
        private $meno;
        private $heslo;
        private $db;

        public function __construct($paMeno, $paHeslo)
        {
            $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
            checkDBError($this->db);
            $this->meno=$paMeno;
            $this->heslo=$paHeslo;
        }
        private function jePrihlaseny(){
            if ($this->db->query("SELECT jePrihlaseny FROM prihlasovanice_udaje WHERE login LIKE '$this->meno'")->fetch_assoc()['jePrihlaseny'] == 1) {
                return true;
            }else{
                return false;
            }
        }
        public function prihlasUsera(){
            if($this->jePrihlaseny()==false){
                $par=$this->db->prepare("UPDATE prihlasovanice_udaje SET jePrihlaseny = ? WHERE login LIKE '$this->meno'");
                $hodnota=1;
                $par->bind_param("i", $hodnota);
                $par->execute();
                return true;
            }
            return false;
        }
    }
?>