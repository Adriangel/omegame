<?php

trait ModelHelper {
	private $db;
	
	/*******************************************
	**										  **
	**	Métodos de interacción con la DB	  **
	**										  **
	*******************************************/
	
	/**
	* Busca la fila con identificador $this->id
	* @return mysqli_result resultado
	*/
	private function searchThis() {
		$query = $this->generateSearchQuery();
		return $this->db->query($query);
	}
	
	/**
	* Actualiza el objeto en la base de datos
	* @return mysqli_result resultado
	*/
	private function updateThis() {
		$query = $this->generateUpdateAllQuery();
		return $this->db->query($query);
	}

	/**
	* Inserta el objeto en la base de datos
	*/
	private function insertThis() {
		$query = $this->generateInsertQuery();
		$result = $this->db->query($query);
		$this->id = $this->db->insert_id;
	}

	/**
	* Elimina el objeto de la base de datos
	*/
	private function deleteThis() {
		$query = $this->generateDeleteQuery();
		$result = $this->db->query($query);
	}
	
	/*******************************************
	**										  **
	**	Métodos generadores de queries		  **
	**										  **
	*******************************************/


	/**
	* Genera el string para la query a la base de datos de búsqueda por id
	* @return String query_string
	*/
	private function generateSearchQuery() {
		return 'SELECT * FROM ' . self::dbtable . ' WHERE id=' . $this->id;
	}

	/**
	* Genera el string para la query a la base de datos de UPDATE, donde se actualizará con id = $this->id
	* @return String query_string
	*/
	private function generateUpdateQuery($columns) {
		$aux = array();
		foreach($columns as $k) {
			if(is_string($this->{$k})) {
				$v = "'" . $db->escape_string($this->{$k}) . "'";
			}
			else {
				$v = $this->{$k};
			}
			$aux[] = $k . '=' . $v;
		}
		
		$query = 'UPDATE ' . self::dbtable . ' SET ';
		$query .= implode(",", $aux);
		$query .= " WHERE id=" . $this->id;
		return $query;
	}

	/**
	* Genera el string para la query a la base de datos de UPDATE, donde se actualizará todo el objeto con id = $this->id
	* @return String query_string
	*/
	private function generateUpdateAllQuery() {
		$columns = get_object_vars($this);
		unset($columns["id"]);
		unset($columns["db"]);
		$aux = array();
		foreach($columns as $k=>&$v) {
			if(is_string($v)) {
				$v = "'" . $this->db->escape_string($v) . "'";
			}
			$aux[] = $k . '=' . $v;
		}
		
		$query = 'UPDATE ' . self::dbtable . ' SET ';
		$query .= implode(",", $aux);
		$query .= " WHERE id=" . $this->id;
		return $query;
	}
	
	/**
	* Genera el string para la query a la base de datos de UPDATE, donde se actualizará con id = $this->id
	* @return String query_string
	*/
	private function generateInsertQuery() {
		$columns = get_object_vars($this);
		unset($columns["id"]);
		unset($columns["db"]);

		foreach($columns as &$v) {
			if(is_string($v)) {
				$v = "'" . $db->escape_string($v) . "'";
			}
		}
		unset($columns["id"]);
		$query = 'INSERT INTO ' . self::dbtable;
		$query .= ' (' . implode(',', array_keys($columns)) . ') ';
		$query .= 'VALUES (' . implode(',',array_values($columns)) . ')';
		return $query;
	}
	
	/**
	* Genera el string para la query a la base de datos DELETE por id=$this->id
	* @return String query_string
	*/
	private function generateDeleteQuery() {
		return 'DELETE FROM ' . self::dbtable . ' WHERE id=' . $this->id;
	}
}

?>