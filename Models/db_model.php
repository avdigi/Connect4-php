<?php

    /**
    * The DB Model
    */
    class DBModel
    {
        public $dbh;

        function __construct()
        {
        }

        public function dbconnect(){
            try {
                //open a connection
                $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};
                dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $this->dbh;
            } catch (PDOException $e) {
                die("Failed to connect to database");
                return false;
            }
        }


        public function login($username, $pass)
        {
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
            $pass = $this->clean($pass);
            $hashedpw = hash('sha256',$pass);
            try {
                $data = array();
                $stmt = $this->dbh->prepare("select * from people where username = :username and password= :hashedpw");
                $stmt->execute(array("username"=>$username, "hashedpw"=>$hashedpw));
                $row = $stmt->fetch();
                if ($row >= 1){
                    return true;
                }
                else {
                    return false;
                }
            } catch (PDOException $e){
                echo $e->getMessage();
                die("Login attempt failed");
            }
        }

        public function register($username, $email, $pass)
        {
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
            $email = $this->clean($email);
            $pass = $this->clean($pass);
            $hashedpw = hash('sha256',$pass);
            try {
                $data = array();
                $stmt = $this->dbh->prepare("INSERT INTO people (username, email, password) VALUES (:username, :email, :hashedpw)");
                $stmt->execute(array("username"=>$username, "email"=>$email, "hashedpw"=>$hashedpw));
                return true;
            } catch (PDOException $e){
                return false;
            }
        }

        public function checkPeople($x, $y)
        {
            $dbh = $this->dbconnect();
            $x = $this->clean($x);
            $y = $this->clean($y);
    
            //check if var is unique against people database
            try{
                $stmt = $this->dbh->prepare('SELECT PersonID FROM people WHERE :x = :y');
                $data = array();
                $stmt->execute(array("x"=>$x, "y"=>$y));
                $row = $stmt->fetch();
                if ($row>=1){
                    return false;
                }
                else{
                    return true;
                }
            } catch (PDOException $e){
                echo $e->getMessage();
                die("check attempt failed");
                return false;
            }
        }

        public function userLogin($username)
        {
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
    
            try {
                $data = array();
                $stmt = $this->dbh->prepare("UPDATE people SET OnlineStatus = 1 WHERE username = :username");
                $stmt->execute(array("username"=>$username));
                return true;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("Update online status failed");
                return false;
            }
        }

        public function userLogout($username)
        {
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
    
            try {
                $data = array();
                $stmt = $this->dbh->prepare("UPDATE people SET OnlineStatus = 0 WHERE username = :username");
                $stmt->execute(array("username"=>$username));
                return true;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("Update online status failed");
                return false;
            }
        }

        public function getOnline($username)
        {
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
            $returnstr ="";
    
            try {
                $data = array();
                $stmt = $this->dbh->prepare("SELECT username FROM people where OnlineStatus = 1 AND username != :username");
                
                $stmt->execute(array("username"=>$username));
                while($row = $stmt->fetch()){
                    $returnstr .=  '<tr class="hover:bg-grey-lighter">';
                    $returnstr .=  '<td width="60%" class="py-4 px-6 border-b border-grey-light">'.$row["username"].'</td>';
                    $returnstr .=  '<td width="40%" class="border-b border-grey-light">';
                    $returnstr .= '<button id="chat_btn" onclick="sendChallenge(\''.$row["username"].'\',\''.$username.'\' )" class="inline-block leading-tight bg-blue-600 hover:bg-blue-100 border border-blue-600 hover:bg-blue-600 px-3 py-1 text-white no-underline rounded">Challenge</button>';
                    $returnstr .=  '</td></tr>';
                }
                return $returnstr;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("get users failed");
                return "";
            }
        }

        public function postChat($username, $room, $message){
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
            $room = $this->clean($room);
            $message = $this->clean($message);

            try {
                $data = array();
                $stmt = $this->dbh->prepare("INSERT INTO chat (RoomID, Message, Username) VALUES (:room, :message, :username)");
                $stmt->execute(array("room"=>$room, "message"=>$message, "username"=>$username));
                return true;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("message attempt failed");
                return false;
            }
        }

        public function getChat($room){
            $dbh = $this->dbconnect();
            $room = $this->clean($room);
            $returnstr ="";
    
            try {
                $data = array();
                $stmt = $this->dbh->prepare("SELECT username, message FROM chat where RoomID = :room  ORDER BY msgID ASC");
                
                $stmt->execute(array("room"=>$room));
                while($row = $stmt->fetch()){
                    $returnstr .= '<div class="bg-gray-200 rounded shadow sm:border py-2 px-3 my-4"><b>'.$row["username"].'</b>: '.$row["message"].'</div>';
                }
                return $returnstr;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("get users failed");
                return "";
            }
        }

        public function challenge($foe, $player){
            $dbh = $this->dbconnect();
            //create challenge
            try {
                $data = array();
                $stmt = $this->dbh->prepare("INSERT INTO checkers_games (game_id, whoseTurn, player0_name, player0_pieceID, player0_boardI, player0_boardJ, player1_name, player1_pieceID, player1_boardI, player1_boardJ, last_updated) VALUES (NULL, '0', :foe, NULL, NULL, NULL, :player, NULL, NULL, NULL, CURRENT_TIMESTAMP)");
                $stmt->execute(array("foe"=>$foe, "player"=>$player));
                return getChallenge($player);
            } catch (PDOException $e){
                echo $e->getMessage();
                die("get users failed");
                return "";
            }

        }
        
        public function cancelChallenge($player){
            $dbh = $this->dbconnect();
            $player = $this->clean($player);

            $gameid = "";
            //create challenge
            try {
                $data = array();
                $stmt = $this->dbh->prepare("SELECT game_id FROM checkers_games where player0_name = :player OR player1_name = :player");
                $stmt->execute(array("player"=>$player));
                while($row = $stmt->fetch()){
                    $gameid = $row["game_id"];
                }
                return $gameid;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("cancel match failed");
                return "";
            }
        }

        public function cancelChallengeAfter($gameid){
            $dbh = $this->dbconnect();
            $gameid = $this->clean($gameid);

            try {
                $data = array();
                $stmt = $this->dbh->prepare("DELETE FROM checkers_games where game_id = :gameid");
                $stmt->execute(array("gameid"=>$gameid));
                return true;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("cancel match failed");
                return false;
            }
        }

        public function getChallenge($username){
            $dbh = $this->dbconnect();
            $username = $this->clean($username);
            $gameid = "";
            try {
                $data = array();
                $stmt = $this->dbh->prepare("SELECT game_id FROM checkers_games where player0_name = :username OR player1_name = :username");
                $stmt->execute(array("username"=>$username));
                while($row = $stmt->fetch()){
                    $gameid = $row["game_id"];
                }
                return $gameid;
            } catch (PDOException $e){
                echo $e->getMessage();
                die("get users failed");
                return "";
            }
        }
        
        public function clean($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        
    }