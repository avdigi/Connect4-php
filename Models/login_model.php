<?php

    /**
    * The login page model
    */
    class LoginModel
    {
        private $username = "";
        private $pass = "";
        public $DBModel;

        public function __construct()
        {
            //set up database
            require_once __DIR__.'/db_model.php';
            $this->DBModel = New DBModel();
        }

        public function test_login($username,$pass){
            // Now we check if the data was submitted, isset() function will check if the data exists.
            $this->test_fields($username,$pass);

            //check if username and pass matches one in DB
            if($this->DBModel->login($username,$pass) == true){
                $_SESSION['username'] = $username;
                $this->DBModel->userLogin($username);
                echo "<script> location.href='https://secure.digiovanni.dev/'; </script>";
            } else {
                echo '<script type="text/javascript"> $(document).ready(function() {window.openAlert("Login Failed - Password is invalid"); });</script>';
            }
        }

        public function logout($username){
            if (isset($username)){

                $this->DBModel->userLogout($username);

                //destroy session
                if(session_destroy()){
                    header("Location: ../index.php");
                    die();
                }
            }
        }

        

        public function test_fields($username,$pass) {
            // Now we check if the data was submitted, isset() function will check if the data exists.
            if (!isset($username, $pass)) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Login Failed - Please check your credentials and try again"); });</script>';
                die();
            }
            if (empty($username) || empty($pass)) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Login Failed - Please check your credentials and try again"); });</script>';
                die();
            }
            if (preg_match('/[A-Za-z0-9]+/', $username) == 0) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Login Failed - Username is invalid"); });</script>';
                die();
            }
            if (preg_match('/[A-Za-z0-9]+/', $pass) == 0) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Login Failed - Password is invalid"); });</script>';
                die();
            }
        }

        

        
    }