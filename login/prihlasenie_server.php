<?php
    if($_POST['username_prihlasenie']=="" || $_POST['password_prihlasenie']==""){
        echo "Nezadali ste meno alebo heslo alebo ani jedno.\n";
    }else{
        $check = new checkLogin($_POST['username_prihlasenie'], $_POST['password_prihlasenie']);
        if($check->platnyLogin()==false){
            echo "Neplatný login.\n";
            exit(1);
        }
        if($check->platneHeslo()==false){
            echo "Neplatné heslo.\n";
            exit(2);
        }
        if($check->prihlasUsera()==false){
            echo "Používateľ je už prihlásený.\n";
            exit(3);
        }
        echo "Prihlásenie prebehlo v poriadku.\n";
    }
    class checkLogin
    {
        private $meno;
        private $heslo;
        private $db;

        public function __construct($paMeno, $paHeslo)
        {
            $this->db = new mysqli('localhost', 'root', 'dtb456', 'db1');
            $this->checkDBError();
            $this->meno=$paMeno;
            $this->heslo=$paHeslo;
        }
        public function platnyLogin(){
            if ($this->db->query("SELECT * FROM prihlasovanice_udaje WHERE login LIKE '$this->meno'")->num_rows == 0) {
                return false;
            }else{
                return true;
            }
        }
        private function jePrihlaseny(){
            if ($this->db->query("SELECT jePrihlaseny FROM prihlasovanice_udaje WHERE login LIKE '$this->meno'")->fetch_assoc()['jePrihlaseny'] == 1) {
                return true;
            }else{
                return false;
            }
        }
        public function platneHeslo(){
            if($this->db->query("SELECT heslo FROM prihlasovanice_udaje WHERE login LIKE '$this->meno'")->fetch_assoc()['heslo'] == $this->heslo){
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
        private function checkDBError()
        {
            if ($this->db->error) {
                die("DB error:" . $this->db->error);
            }
        }
    }
?>