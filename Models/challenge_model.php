<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = new ChallengeModel();
    if (!empty($_POST['action'])){
        echo 'cancel';
        $model->cancelChallenge($_SESSION['gameid']);
    } else {
        $foe = $_POST['foe'];
        $player = $_POST['player'];
        $_SESSION['gameid'] = $model->challenge($foe, $player);
    }
}

    /**
    * The home page model
    */
    class ChallengeModel
    {
        private $DBModel;
        private $chatM;

        function __construct()
        {
            //set up database
            require_once __DIR__.'/db_model.php';
            $this->DBModel = New DBModel();

        }

        public function challenge($foe, $player){
            return $this->DBModel->challenge($foe, $player);
        }

        public function cancelChallenge($gameid){
            return $this->DBModel->cancelChallengeAfter($gameid);
        }

        public function getChallenge($username){
            return $this->DBModel->getChallenge($username);
        }

        
        public function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }