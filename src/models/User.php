<?php
namespace Models;

class User{
	use ModelHelper;
	
	const dbtable = "users";
	
	private $id;
	private $db;
	private $user;
	private $pass;
	private $email;
	
	public function create(){
		if (!$this->userExists() && $this->emailExists()) {
			$query = 'INSERT INTO ' . self::dbtable . ' (user, pass, email) VALUES (' . $this-> . ',' . $this->pass . ',' . $this->email . ')';
			$result = $this->db->query($query);
			return $result->numrows > 0;
		}
	}
	
	public function userExists(){
		$query = 'SELECT * FROM ' . self::dbtable . ' WHERE `user`=' . $this->user;
		$result = $this->db->query($query);
		return $result->numrows > 0;
	}

	public function emailExists(){
		$query = 'SELECT * FROM ' . self::dbtable . ' WHERE `email`=' . $this->email;
		$result = $this->db->query($query);
		return $result->numrows > 0;
	}
	
	public function update() {
		$query = $this->generateUpdateQuery();
		
	}
}

?>