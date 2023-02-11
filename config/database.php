<?php 
    class Database {
        //local host server
       // private $host = "127.0.0.1";
        //private $database_name = "productdb";
       // private $username = "root";
        //private $password = "";

        //heroku remote server
        private $host = "us-cdbr-east-06.cleardb.net"; //server
        private $database_name = "heroku_2c2372a185f50a5";
        private $username = "bc10ad99aa3b13";
        private $password = "2912a486"; //fff
        public $conn;
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected:" . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>