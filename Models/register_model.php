<?php

    /**
    * The Register page model
    */
    class RegisterModel
    {
        public $DBModel;

        public function __construct()
        {
            //set up database
            require_once __DIR__.'/db_model.php';
            $this->DBModel = New DBModel();
        }

        public function register($username, $email, $pass){
            //check data
            if ($this->test_fields($username,$email,$pass)){
                //check email & username unique
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if($this->DBModel->checkPeople("username",$username)){
                        if($this->DBModel->checkPeople("email",$email)){
                            //if user and password is valid, register the user!
                            if($this->DBModel->register($username,$email,$pass)){
                                //emailing the user to inform them they have registerd a new account with us!
                                $from    = 'noreply@secure.digiovanni.dev';
                                $subject = 'Account Created for Connect Four';
                                $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                                $activate_link = 'https://secure.digiovanni.dev/';
                                $message = '<p>You have created an account with us! Play your next Connect 4 match today! <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                                mail($email, $subject, $message, $headers);

                                echo 'reg success';

                                 //registration success! proceed to log in the user and send to home
                                 if($this->DBModel->login($username,$pass) == true){
                                     $_SESSION['username'] = $username;
                                     $this->DBModel->userLogin($username);
                                     echo "<script> location.href='https://secure.digiovanni.dev/'; </script>";
                                 } else {
                                     echo '<script type="text/javascript"> $(document).ready(function() {window.openAlert("Login Failed - Password is invalid"); });</script>';
                                 }
                            } else {
                                echo '<script type="text/javascript"> $(document).ready(function() {window.openAlert("Registration Failed - please try again"); });</script>';
                            }    
                        } else {
                            echo '<script type="text/javascript"> $(document).ready(function() {window.openAlert("Registration Failed - please use a different email"); });</script>';
                        } 
                    } else {
                        echo '<script type="text/javascript"> $(document).ready(function() {window.openAlert("Registration Failed - please use a different username"); });</script>';
                    }
                } else {
                    echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Registration Failed - Email is invalid"); });</script>';
                }
            }
        }

        public function test_fields($username,$email,$pass) {
            // Now we check if the data was submitted, isset() function will check if the data exists.
            if (!isset($username, $pass)) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Registration Failed - Please check your credentials and try again"); });</script>';
                return false;
            }
            if (empty($username) || empty($email) || empty($pass)) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Registration Failed - Please check your credentials and try again"); });</script>';
                return false;
            }
            if (preg_match('/[A-Za-z0-9]+/', $username) == 0) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Registration Failed - Username is invalid"); });</script>';
                return false;
            }
            if (preg_match('/[A-Za-z0-9]+/', $email) == 0) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Registration Failed - Password is invalid"); });</script>';
                return false;
            }
            if (preg_match('/[A-Za-z0-9]+/', $pass) == 0) {
                echo '<script type="text/javascript"> $(document).ready(function() { openAlert("Registration Failed - Password is invalid"); });</script>';
                return false;
            }
            if (strlen($username) > 100 || strlen($username) <= 0) {
                echo '<script type="text/javascript"> $(document).ready(function() {openAlert("Registration Failed - Username must be less than 64 characters long!"); });</script>';
                return false;
            }
            if (strlen($email) > 254 || strlen($email) <= 0) {
                echo '<script type="text/javascript"> $(document).ready(function() {openAlert("Registration Failed - email must be less than 254 characters long!"); });</script>';
                return false;
            }
            if (strlen($pass) > 64 || strlen($pass) < 5) {
                echo '<script type="text/javascript"> $(document).ready(function() {openAlert("Registration Failed - Password must be at least 5 characters long!"); });</script>';
                return false;
            }
            else {
                return true;
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
        
    }