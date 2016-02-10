<?php
namespace Models;

class User{
	use ModelHelper;
	
	const dbtable = "users";
	
	private $id;
	private $user;
	private $pass;
	private $email;


	function __construct($id) {
		$this->id = $id;
		$this->searchThis();
	}

	function __destruct() {
		$this->update();
	}


	/**
	* Inserta el usuario en la base de datos, si no existe ni el usuario ni la contraseña
	* @return true éxito / false error
	*/
	public function insert(){
		if (!$this->userExists() && $this->emailExists()) {
			$this->insertThis();
			return true;
		}
		return false;
	}

	public function update() {
		$this->updateThis();
	}

	public function delete() {
		$this->deleteThis();
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

	/**
	* Encripta la contraseña para su uso en la base de datos
	*/
	public static function cryptPassword($pass) {
		return password_hash($pass, PASSWORD_DEFAULT);
	}
}

?>