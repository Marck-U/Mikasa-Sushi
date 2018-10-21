<?php
class connection{
    public $dbConnection;
    private static $_instance;
    public function __construct(){
            
        $this->dbConnection = new mysqli("localhost","root","","bd_mikasa");

        if(mysqli_connect_error()) {
			die("Database connection failed: " . 
            mysqli_connect_error() . " (" . 
            mysqli_connect_errno() . ")" 
            ); 
		}
    }
    public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
    private function __clone(){}

    public function getConnection(){
        return $this->dbConnection;
    }
}
