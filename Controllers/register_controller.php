<?php

    /**
    * The about page controller
    */
    class RegisterController
    {
        public $modelObj;
        private $username = "";
        private $pass = "";

        function __construct( $model )
        {
            $this->modelObj = $model;

            
            if(isset($_SESSION['username'])){
                ob_start();
                $this->modelObj->logout($_SESSION['username']);
                ob_end_flush();
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $this->test_input($_POST["username"]);
                $email = $this->test_input($_POST["email"]);
                $pass = $this->test_input($_POST["pass"]);
                
                $this->modelObj->register($username, $email, $pass);
            }
        }

        private function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
     }