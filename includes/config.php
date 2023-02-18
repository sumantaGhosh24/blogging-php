<?php
    class Database {
        private $dsn = "mysql:host=localhost;dbname=blogging-php";
        private $dbuser = "root";
        private $dbpass = "";

        public $conn;

        public function __construct() {
            try {
                $this->conn = new PDO($this->dsn,$this->dbuser,$this->dbpass);
                // echo "Database connection successful.";
            } catch (PDOException $e) {
                echo "Database connection error : " . $e->getMessage();
            }
            return $this->conn;
        }

        public function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function showMessage($type, $message) {
            return '
            <div class="alert alert-'.$type.' alert-dismissible fade " role="alert">
                <strong>'.$type.'</strong>'.$message.'<span></span>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            </div>
            ';
        }
    }
?>