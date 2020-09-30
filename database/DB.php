<?php 
require_once('vendor/autoload.php');

use Dotenv\Dotenv;

class DB{
	public $mysqli_db;
	public function __construct(){
		$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
		$dotenv->load();

		$this->mysqli_db = new mysqli(
		    $_ENV['DB_LOCALHOST'], 
		    $_ENV['DB_USERNAME'], 
		    $_ENV['DB_PASSWORD'], 
		    $_ENV['DB_NAME']
		);
	}

	public function query($sql){
	    $result = $this->mysqli_db->query($sql);
	    if (!is_object($result)) {
	        return $result;
	    }
	    $data = [];
	    while ($row = $result->fetch_assoc()) {
	        $data[] = $row;
	    }
	    return $data;
	}
}