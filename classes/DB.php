<?php
class DB {
	protected $dbName = 'test_nerdy_soft_1';
	protected $dbUser = 'test_nerdy_soft';
	protected $dbPassword = 'fdfhj4ddfjKD';
	protected $dbHost = 'localhost';
	public function connect() {
		$dbcon = mysqli_connect ( $this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName );
		mysqli_query ( $dbcon, 'SET NAMES utf8' );
		if (mysqli_connect_errno ()) {
			printf ( 'Ошибка соединения: %s\n', mysqli_connect_error () );
			exit ();
		}
		return $dbcon;
	}
	public function processRowSet($rowSet, $singleRow = false) {
		$resultArray = array ();
		while ( $row = mysqli_fetch_assoc ( $rowSet ) ) {
			array_push ( $resultArray, $row );
		}
		if ($singleRow === true) {
			return $resultArray [0];
		}
		return $resultArray;
	}
	public function select($dbcon, $table, $where, $singleRow = true) {
		$sql = "SELECT * FROM $table WHERE $where";
		$result = mysqli_query ( $dbcon, $sql );
		
		if (mysqli_num_rows ( $result ) == 1) {
			return $this->processRowSet ( $result, $singleRow );
		}
		return $this->processRowSet ( $result );
	}
	public function selectTable($dbcon, $table, $singleRow = false) {
		$sql = "SELECT * FROM $table";
		$result = mysqli_query ( $dbcon, $sql );
		if (mysqli_num_rows ( $result ) == 1) {
			return $this->processRowSet ( $result, $singleRow );
		}
		return $this->processRowSet ( $result );
	}
	public function selectField($dbcon, $field, $table, $where, $singleRow = true) {
		$sql = "SELECT $field FROM `$table` WHERE $where";
		$result = mysqli_query ( $dbcon, $sql );
		if (mysqli_num_rows ( $result ) == 1) {
			return $this->processRowSet ( $result, $singleRow );
		}
		return $this->processRowSet ( $result );
	}
	public function update($dbcon, $data, $table, $where) {
		foreach ( $data as $column => $value ) {
			$sql = "UPDATE $table SET $column = $value WHERE $where";
			mysqli_query ( $dbcon, $sql ) or die ( mysqli_error ( $dbcon ) );
		}
		return true;
	}
	public function insert($dbcon, $data, $table) {
		$columns = "";
		$values = "";
		foreach ( $data as $column => $value ) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= $value;
		}
		$sql = "insert into $table ($columns) values ($values)";
		mysqli_query ( $dbcon, $sql ) or die ( mysqli_error ( $dbcon ) );
		return mysqli_insert_id ( $dbcon );
	}
	public function delete($dbcon, $table, $where) {
		$sql = "DELETE FROM $table WHERE $where";
		mysqli_query ( $dbcon, $sql ) or die ( mysqli_error ( $dbcon ) );
		return true;
	}
}
?>