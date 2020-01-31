<?php

    /**
    * The game model
    */
    class GameModel
    {
        private $DBModel;

        function __construct()
        {
            //set up database
            require_once __DIR__.'/db_model.php';
            $this->DBModel = New DBModel();

        }

    }
