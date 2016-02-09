<?php

trait ModelHelper {
	
	
	private function generateSearchQuery() {
		return 'SELECT * FROM ' . self::dbtable . ' WHERE id=' . $this->id;
	}
	
	/**
	* Genera el string para la query a la base de datos de UPDATE, donde se actualizará con id = $this->id
	* Es necesario que en la clase exista la constante dbtable, la propiedad id y que las columnas existan en la base de datos.
	* @return String query_string
	*/
	private function generateUpdateQuery($columns) {
		$query = 'UPDATE ' . self::dbtable . ' SET ';
		$query .= $columns[0] . "=" . $this->{$columns[0]};
		array_shift($columns);
		foreach($columns as $c) {
			$query .= ", " . $c . "=" . $this->$$c;
		}
		$query .= " WHERE id=" . $this->id;
		return $query;
	}
	
	
	
	private function getColumnArray() {
		return array_keys(get_class_vars());
	}
}

?>