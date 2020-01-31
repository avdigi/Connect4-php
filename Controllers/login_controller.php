<?php

    /**
    * The about page controller
    */
    class LoginController
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
                die();
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $this->test_input($_POST["username"]);
                $pass = $this->test_input($_POST["pass"]);
                
                $this->modelObj->test_login($username, $pass);
            }
        }

        private function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
     }