<?php
	class DB_Connector {
		var $cnx;
		// REMOTO /
		// var $Servidor = "77.240.119.138";
		var $Servidor = "localhost";
		var $Usuario = "root";
		var $Clave = "olgata";
		var $Base = "opiniyo";
		var $Driver = "mysql";
		


		function Connect() {
			$this->cnx = mysqli_connect($this->Servidor, $this->Usuario, $this->Clave, $this->Base) or die("ERROR: No se pudo establecer la conexion con la base de datos");
			mysqli_set_charset($this->cnx, "utf8");
		}
		
		function Execute($query) {
			$rs = mysqli_query($this->cnx, $query);
			$aux = new Result_Set();
			$aux->Load($rs);
			return $aux;
		}
		
		function GetField($campo, $tabla, $condicion) {
			$query = "SELECT $campo FROM $tabla WHERE $condicion";
//			echo "$query<br>";
			$rs = mysqli_query($this->cnx, $query);
			if($rs) {
				if(mysqli_num_rows($rs) > 0) {
					$datos = mysqli_fetch_array($rs);
					$result = $datos[$campo];
				}
				else {
					$result = false;
				}
				mysqli_free_result($rs);
			}
			else {
				$result = false;
			}
			return $result;
		}
		
		function Exist($field, $table, $value) {
			$query = "SELECT * FROM $table WHERE $field = '$value'";
			$rs = mysqli_query($this->cnx, $query);
			if ($rs) {
				$result = mysqli_num_rows($rs);
				mysqli_free_result($rs);
			}
			return $result;
		}
		
		function Close() {
			mysqli_close($this->cnx);
		}		
	}

	class Result_Set {
		var $result;
		var $fields;
		var $numRows;
		var $index = 0;
		var $EOF = false;
		
		function Load($rs) {
			$this->result = $rs;
			if ($rs) {
				if (is_object($rs)) {
					$this->numRows = mysqli_num_rows($rs);
					$this->fields = mysqli_fetch_array($rs);
					$this->index = 1;
				}
			}
			if($this->index > $this->numRows)
				$this->EOF = true;
		}
		

		function Close() {
			unset($this->fields);
			if (is_object($this->result)) {
				mysqli_free_result($this->result);
			}
		}
		
		
		function RecordCount() {
			return $this->numRows;
		}
		

		function MoveNext() {
			$this->fields = mysqli_fetch_array($this->result);
			$this->index ++;
			if($this->index > $this->numRows) {
				$this->EOF = true;
			}
		}
	}
?>
