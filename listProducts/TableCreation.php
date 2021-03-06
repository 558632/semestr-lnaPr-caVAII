<?php
session_start();
$table= new Table();
    echo $table->getTable();
    class Table{
        private $html;
        private $db;
        public function __construct(){
            $this->db = new mysqli('localhost', 'root', 'dtb456', 'db2');
            $this->ucinTabulku();
            $this->Insertion();
        }
        private function ucinTabulku(){
            $this->html=$this->html . "<table id='table_from_server'><thead><tr><th>ID</th><th>Kategoria</th><th>Nazov</th><th>Popis</th></tr></thead><tbody>";
            $this->ucinData();
            $this->html=$this->html . "</tbody></table>";
        }
        private function ucinData(){
            $this->checkDBError();
            $db_result=$this->db->query("SELECT * FROM product");
            while ($record = $db_result->fetch_assoc()){
                $id_kategorie=$record['id_of_category'];
                $nazov_kategorie=$this->db->query("SELECT name_of_category FROM category WHERE id_of_category LIKE '$id_kategorie'");
                $this->html=$this->html . "<tr>";
                $this->html=$this->html . "<td>" . $record['id_of_product'] . "</td>";
                $this->html=$this->html . "<td>" . $nazov_kategorie->fetch_assoc()['name_of_category'] . "</td>";
                $this->html=$this->html . "<td>" . $record['name_of_product'] . "</td>";
                $this->html=$this->html . "<td>" . $record['desciption_of_product'] . "</td>";
                $this->html=$this->html . "</tr>";
            }
        }
        public function getTable(){
            return $this->html;
        }
        private function checkDBError(){
            if ($this->db->error) {
                die("DB error:" . $this->db->error);
            }
        }
        private function Insertion(){
            if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']!=""){
                $this->html.=
                    "<div class='product_item_insertion'><fieldset><legend>Item insertion</legend>
                        <input type='text' list='categories' name='category_p_i' id='category_p_i' placeholder='Kateg??ria produktu' tabindex='1'>
                        <datalist id='categories'>";
                            $query = $this->db->query("SELECT name_of_category FROM category");
                            while($riadok = $query->fetch_assoc()){
                                $cat=$riadok['name_of_category'];
                                $this->html.="<option value='$cat'>";
                            }
                        $this->html.="</datalist>
                        <input type='text' name='name_p_i' id='name_p_i' placeholder='N??zov produktu' tabindex='2'>
                        <textarea name='desc_p_i' id='desc_p_i' tabindex='3'>Sem zadajte popis.</textarea>
                        <button type='button' name='confirmation_p_i' onclick='tryInsert()'>Odosla??</button>
                    </fieldset></div>";
                return true;
            }
            return false;
        }
    }
?>
