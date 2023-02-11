<?php
    class Product{
        // Connection
        private $conn;
        // Table
        private $db_table = "products";
        // Columns
        public $sku;
        public $name;
        public $price;
        public $type;
        public $value;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL Products
        public function getProducts(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " ORDER BY sku"; 
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createProduct(){
            $sqlQuery = "INSERT INTO " . $this->db_table . " SET sku = :sku, name = :name, price = :price, type = :type, value = :value ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->sku=htmlspecialchars(strip_tags($this->sku));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->value=htmlspecialchars(strip_tags($this->value));
        
            // bind data
            $stmt->bindParam(":sku", $this->sku);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":type", $this->type);
            $stmt->bindParam(":value", $this->value);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteProduct(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE sku = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->sku=htmlspecialchars(strip_tags($this->sku));
        
            $stmt->bindParam(1, $this->sku);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>