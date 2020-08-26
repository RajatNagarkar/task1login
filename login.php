<?php
    session_start();
    class Login{
        private $usr, $pass, $name;
        function __construct(){
            if(isset($_POST['full_name'])){
                if($this->validateData() == true){
                $this->usr = $this->checkData('user');
                $this->pass = hash('sha512', $this->checkData(('pass')));
                $this->name = $this->checkData('full_name');
                // echo $this->name.'<br>'.$this->usr.'<br>'.$this->pass;
                }
                // echo $this->name;
            }
            else{
                $this->usr = $this->checkData(('user'));
                $this->pass = hash('sha512', $this->checkData(('pass')));
            }
        }
        private function validateData(){
            if(strlen($this->checkData('user'))<6){
                exit('ExU34A6');
            }
            else if(strlen($this->checkData('pass'))<6){
                exit('T4xP404');
            }
            else if(isset($_POST['conf-pass'])){
                if(strcmp($this->checkData('pass'), $this->checkData('conf-pass')) != 0){
                    exit("T4xP508");
                }
            }
            return true;
            
        }
        private function checkData($fieldName){
            if(isset($fieldName) === false){
                return '';
            }
            return htmlspecialchars(stripslashes($_POST[$fieldName]));
        }
        private function authenticate(){
            $sql = "SELECT full_name, pass_key from users WHERE username='$this->usr' AND 
            pass_key='$this->pass'";
            $conn = new mysqli('localhost','root','','task1_users');
            $result = mysqli_fetch_assoc($conn->query($sql));
            $conn->close();
            if(!is_null($result)){
                // $conn->query("UPDATE users SET log_time=NULL WHERE username=$this->usr");
                echo $conn->error;
                $_SESSION['name'] = $result['full_name'];
                // echo $_SESSION['name'];
            }
            else{
                echo "ExA0404";
            }
            // echo($this->pass);
        }
        function createDataBase(){
            // echo"Indata";
            $conn = new mysqli('localhost','root','');
            if($conn->select_db('task1_users') === false){
                $conn->query('CREATE DATABASE task1_users');
                $conn->close();
            }
            else{
                $this->createTable();            
            }
        }
        private function createTable(){
            // echo "In table";
            $sql = 'CREATE TABLE users(
                id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                full_name VARCHAR(50) NOT NULL,
                username VARCHAR(30) NOT NULL,
                pass_key VARCHAR(128) NOT NULL,
                reg_date TIMESTAMP,
                log_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )';
            $conn = new mysqli('localhost','root','','task1_users');
            if(!$conn->query('IF NOT EXISTS (SELECT * FROM users)')){
                $conn->query($sql);
            }
            $conn->close();
            if(isset($this->name)){
                // echo"insertt";
                $this->insertData();    
            }
            else{
                // echo "log"/;
                $this->authenticate();
            }

        }
        private function insertData(){
            $sql = "INSERT into users(id, full_name, username, pass_key, reg_date, log_time) VALUES(NULL,'$this->name','$this->usr',
            '$this->pass',NULL, NULL)";
            $conn = new mysqli('localhost','root','','task1_users');
            $conn->query($sql);
            // echo $conn->error;
            exit("SrT48200");
        }
    }

$obj = new Login();
$obj->createDataBase();
?>