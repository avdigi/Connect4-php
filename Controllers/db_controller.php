<?php

    /**
    * The about page controller
    */
    class DBController
    {
        public $modelObj;

        function __construct( $model )
        {
            $this->modelObj = $model;
            
        }

        private function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
     }