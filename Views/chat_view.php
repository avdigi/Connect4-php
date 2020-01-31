<?php

    /**
    * The chat view
    */
    class ChatView
    {

        private $model;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;

            $this->paintChat();
        }

        public function paintChat()
        {
            echo '
                <!--all text messages goes here -->
                ';
        }

    }