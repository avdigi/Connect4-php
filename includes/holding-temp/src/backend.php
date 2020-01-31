<?php
    require("db.php");
	
//backend for the admin page	
class Backend {
	
	//set up a new DB class
	public function __construct(){
		$this->db = new DB();
		
    }
}
?>