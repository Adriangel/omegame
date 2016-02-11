<?php

class User{
	use ModelHelper;
	
	const dbtable = "users";
	
	private $id;
	private $user;
	private $pass;
	private $email;

	function __construct() {
		$this->db = Db::singleton();
		$this->id = 0;
		$this->user = "";
		$this->pass = "";
		$this->email = "";
	}

	function __destruct() {
		if (isset($this->id)) {
			$this->update();
		}
	}

	public function getId(){return $this->id;}
	public function getUser(){return $this->user;}
	public function getPass(){return $this->pass;}
	public function getEmail(){return $this->email;}
	
	public function setId($newId){$this->id = $newId;}
	public function setUser($newUser){$this->user = $newUser;}
	public function setPass($newPass){$this->pass = $newPass;}
	public function setEmail($newEmail){$this->email = $newEmail;}
	
	/**
	* Inserta el usuario en la base de datos, si no existe ni el usuario ni la contraseña
	* @return true éxito / false error
	*/
	public function insert(){
		$this->insertThis();
	}
	
	public function update() {
		$this->updateThis();
	}

	public function delete() {
		$this->deleteThis();
	}

	public function userExists(){
		$query = 'SELECT * FROM ' . self::dbtable . ' WHERE user=\'' . $this->user ."'";
		$result = $this->db->query($query);
		return $result->num_rows > 0;
	}

	public function emailExists(){
		$query = 'SELECT * FROM ' . self::dbtable . ' WHERE `email`=\'' . $this->email . "'";
		$result = $this->db->query($query);
		return $result->num_rows > 0;
	}

	/**
	* Encripta la contraseña para su uso en la base de datos
	*/
	public static function cryptPassword($pass) {
		return password_hash($pass, PASSWORD_DEFAULT);
	}
}

?>