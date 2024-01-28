<?php
session_start();
class Conectar {
	protected $dbh;
		protected function Conexion(){
			try {
				$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=db_hacdp","root","");
				//PARA CONEXIÓN A PGSQL -->
				// $conectar = $this->dbh = new PDO("pgsql:host=localhost port=5432 dbname=db_hacdp user=postgres password=postgres");

				return $conectar;	
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();	
			}
		}
		
		public function set_names(){	
			return $this->dbh->query("SET NAMES 'utf8'");
		}

		public function ruta(){
			return "http://localhost/sismedoc/";
		}
	}
?>