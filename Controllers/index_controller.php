<?php

    /**
    * The home page controller
    */
    class IndexController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
            
        }

        public function getOnlineUsers($username){
            return $this->model->getOnlineUsers($username);
        }

        public function getChat($room){
            return $this->model->getChat($room);
        }
    }