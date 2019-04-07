<?php

/**
*	The object for the data access layer for assertions
*/
class Assertion {

	// The database connection
	private $db;

	public function __construct($settings)
    {
    	$this->db = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'] .";charset=utf8", $settings['user'], $settings['password']);
    	$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

	// Return all assertions matching key words $search
	function search($search) {
	    $search = str_replace(" ", "|", $search);
	    $query = $this->db->prepare("SELECT * FROM api_assertion WHERE sentence REGEXP :search");
	    $query->bindParam('search', $search);
	    $query->execute();
	    return $query->fetchAll();
	}

}
