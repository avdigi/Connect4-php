<?php

    /**
    * The forgot password page model
    */
    class ForgotModel
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

        public function forgotPassword($email){
        }

        

        
    }