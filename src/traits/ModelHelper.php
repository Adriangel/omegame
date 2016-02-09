<?php

trait ModelHelper {
	private static $db = Db::singleton();
	
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
		unset($columns["id"]);
		
		$aux = array();
		foreach($columns as $k) {
			if(is_string($this->{$k})) {
				$v = "'" . $db->real_scape_string($this->{$k}) . "'";
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
		return generateUpdateQuery(array_keys(get_object_vars($this)));
	}
	
	/**
	* Genera el string para la query a la base de datos de UPDATE, donde se actualizará con id = $this->id
	* @return String query_string
	*/
	private function generateInsertQuery() {
		$columns = get_object_vars($this);
		foreach($columns as &$v) {
			if(is_string($v)) {
				$v = "'" . $db->real_scape_string($v) . "'";
			}
		}
		unset($columns["id"]);
		$query = 'INSERT INTO ' . self::dbtable;
		$query .= ' (' . implode(',', array_keys($columns)) . ') ';
		$query .= 'VALUES (' . implode(',',array_values($columns) . ')';
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