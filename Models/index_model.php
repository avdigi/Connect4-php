<?php

    /**
    * The home page model
    */
    class IndexModel
    {
        private $DBModel;
        private $chatM;

        function __construct()
        {
            //set up database
            require_once __DIR__.'/db_model.php';
            $this->DBModel = New DBModel();

            
            //set up database
            require_once __DIR__.'/chat_model.php';
            $this->chatM = New ChatModel();

        }

        public function getOnlineUsers($username){
            return $this->DBModel->getOnline($username);
        }

        public function getChat($room){
            return $this->chatM->getChat($room);
        }

        
        public function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }