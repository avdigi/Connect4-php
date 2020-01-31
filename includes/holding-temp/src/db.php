<?php
class DB {
    private $dbh;
	
    function __construct(){
        try {
            //open a connection
            $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};
            dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Failed to connect to database");
        }
    }//constructor
    
    //trimmer
	function clean($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
    }

    //login function
    function login($username, $pass){
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

    //registration function
    function register($username, $email, $pass){
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
            echo $e->getMessage();
            die("Registration attempt failed");
            return false;
        }
    }

    //checks people information
    function checkPeople($x,$y){
        $x = $this->clean($x);
        $y = $this->clean($y);

        //check if var is unique against people database
        if($stmt = $this->dbh->prepare('SELECT personID, password FROM people WHERE :x = :y')){
            $data = array();
            $stmt->execute(array("x"=>$x, "y"=>$y));
            $row = $stmt->fetch();
            if ($row>=1){
                return false;
            }
            else{
                return true;
            }
        }

    }

    //changes online status of user
    function userLogin($username){
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

    //changes online status of user
    function userLogout($username){
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

    //obtain list of online people
    function getOnline($username){
        $username = $this->clean($username);

        try {
            $data = array();
            $stmt = $this->dbh->prepare("SELECT username FROM people where OnlineStatus = 1 AND username != :username");
			
            $stmt->execute(array("username"=>$username));
            while($row = $stmt->fetch()){
                echo '<tr class="hover:bg-grey-lighter">';
				echo '<td width="60%" class="py-4 px-6 border-b border-grey-light">'.$row["username"].'</td>';
                echo '<td width="40%" class="border-b border-grey-light">';
                echo '<a href="game/challenge.php?user1='.$row["username"].'&user2='.$username.'" class="inline-block leading-tight bg-blue-600 hover:bg-blue-100 border border-blue-600 hover:bg-blue-600 px-3 py-1 text-white no-underline rounded">Challenge</a>';
                echo '</td></tr>';
			}
        } catch (PDOException $e){
            echo $e->getMessage();
            die("get users failed");
        }
    }
    
}
?>