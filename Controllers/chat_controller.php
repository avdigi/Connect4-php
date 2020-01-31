<?php

    /**
    * The chat controller
    */
    class ChatController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
            
        }

        public function postChat($username, $message, $room){
            $this->model->postChat($username, $room, $message);
        }

        public function getChat($room){
            $this->model->getChat($room);
        }


    }