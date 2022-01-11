<?php
    //session_start();
    require "./../globalFunctions.php";
    if($_POST['category_p_i']=="" || $_POST['name_p_i']=="" || $_POST['desc_p_i']==""){
        echo "Všetky polia musia byť zadané.\n";
    }else{
        $check = new TheFormProcessing($_POST['category_p_i'], $_POST['name_p_i'],  $_POST['desc_p_i']);
        if(!$check->dataCorection()){
            echo "Zápis do databázy neprebehol.";
            return 1;
        }
        $check->insertItem();
        echo "Zápis do databázy prebehol.";
        return 0;
    }
    class TheFormProcessing{

        private $db;
        private $category;
        private $name;
        private $desc;

        public function __construct($paCategory, $paMeno, $paDesc){
            $this->db = new mysqli('localhost', 'root', 'dtb456', 'db2');
            $this->checkDBError();
            $this->category=$paCategory;
            $this->name=$paMeno;
            $this->desc=$paDesc;
        }

        private function checkDBError(){
            if ($this->db->error) {
                die("DB error:" . $this->db->error);
            }
        }

        public function dataCorection() : bool{
            if(!(strlen($this->category)>2) || !(strlen($this->name)>4) || !(strlen($this->desc)>19)){
                echo "Všetky vstupy nemajú stanovenú dĺžku.\n";
                return false;
            }
            $query = $this->db->query("SELECT name_of_product, desciption_of_product FROM product");
            while($row = $query->fetch_assoc()){
                if($row['name_of_product']==$this->name){
                    echo "Meno produktu už existuje.\n";
                    return false;
                }
                if($row['desciption_of_product']==$this->desc){
                    echo "Popis produktu už existuje.\n";
                    return false;
                }
            }
            return true;
        }

        public function insertItem(){
            if(!($id_category=categoryExistence($this->category))){
                $id_category=$this->db->query("SELECT MAX(id_of_category) FROM category")->fetch_assoc()['MAX(id_of_category)']+1;
                $prep=$this->db->prepare("INSERT INTO category(id_of_category, name_of_category) VALUES (?, ?)");
                $prep->bind_param("is", $id_category, $this->category);
                $prep->execute();
                $this->checkDBError();
            }
            $id_product=$this->db->query("SELECT MAX(id_of_product) FROM product")->fetch_assoc()['MAX(id_of_product)']+1;
            $prep_prod=$this->db->prepare("INSERT INTO product(id_of_product, id_of_category, name_of_product, desciption_of_product) VALUES (?, ?, ?, ?)");
            $prep_prod->bind_param("iiss", $id_product, $id_category, $this->name, $this->desc);
            $prep_prod->execute();
            $this->checkDBError();
        }
    }
?>
