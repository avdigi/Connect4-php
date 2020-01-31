<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = new ChatModel();
    $username = $_POST['username'];
    $room = $_POST['room'];
    $text = $_POST['text'];
    $model->postChat($username, $room, $text);
}

    /**
    * The chat model
    */
    class ChatModel
    {
        private $DBModel;

        function __construct()
        {
            //set up database
            require_once __DIR__.'/db_model.php';
            $this->DBModel = New DBModel();

        }

        public function postChat($username, $room, $message){
            $this->DBModel->postChat($username, $room, $message);
        }

        public function getChat($room){
            return $this->DBModel->getChat($room);
        }
        
        public function getOnlineUsers($username){
            return $this->DBModel->getOnline($username);
        }

        public function run(){
        }
    }

    
