<?php
    
class DB {
    
    protected $db_name = 'DatabaseName';
    protected $db_user = 'DatabaseUser';
    protected $db_pass = 'DatabasePassowrd';
    protected $db_host = 'DatabaseHost';
    
    
    // Open a connect to the database.
    // Make sure this is called on every page that needs to use the database.
    
    public function connect() {
	
	
	$connect_db = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name );
	
	if ( mysqli_connect_errno() ) {
	    printf("Connection failed: %s", mysqli_connect_error());
	    exit();
	}
	return $connect_db;;
	
    }
    
}