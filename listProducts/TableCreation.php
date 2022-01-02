<?php
    $table= new Table();
    echo $table->getTable();
    class Table{
        private $html;
        private $db;
        public function __construct()
        {
            $this->ucinTabulku();
        }
        public function ucinTabulku(){
            $this->html=$this->html . "<table><tr><th>ID</th><th>Kategoria</th><th>Nazov</th><th>Popis</th></tr>";
            $this->ucinData();
            $this->html=$this->html . "</table>";
        }
        private function ucinData(){
            $this->db = new mysqli('localhost', 'root', 'dtb456', 'db2');
            $this->checkDBError();
            $db_result=$this->db->query("SELECT * FROM product");
            while ($record = $db_result->fetch_assoc()){
                $id_kategorie=$record['id_of_category'];
                $nazov_kategorie=$this->db->query("SELECT name_of_category FROM category WHERE id_of_category LIKE $id_kategorie");
                $this->html=$this->html . "<tr>";
                $this->html=$this->html . "<td>" . $record['id_of_product'] . "</td>";
                $this->html=$this->html . "<td>" . $nazov_kategorie->fetch_assoc()['name_of_category'] . "</td>";
                $this->html=$this->html . "<td>" . $record['name_of_product'] . "</td>";
                $this->html=$this->html . "<td>" . $record['desciption_of_product'] . "</td>";
                $this->html=$this->html . "</tr>";
            }
        }
        public function getTable()
        {
            return $this->html;
        }
        private function checkDBError()
        {
            if ($this->db->error) {
                die("DB error:" . $this->db->error);
            }
        }
    }
?>
