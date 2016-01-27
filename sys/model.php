<?php

	class Model{

		protected $db;
		protected $stmt;

		function __construct(){
			$this->db=DB::singleton();
		}

		function query($query){
			$stmt=$db->prepare($query); 
		}

		function bind($param,$value,$type=NULL){  //(per lligar paràmetres de consultes prepareades
			
            if (is_int($value))
            {
               $type = PDO::PARAM_INT;

            } elseif ($value === NULL) {

                    $type = PDO::PARAM_NULL;

            } else {

                    $type = PDO::PARAM_STR;
            }

            $stmt->bindValue($param, $value, $type);
		}


		function execute($stmt){ //executa la sentència ($stmt)
		//executar sentencia
			$this->$stmt->execute();
		}

		function resultset(){  //extreu l'array de resultats de la sentència executada
		
			$this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		function single(){ /*???*/ /*result però amb una única incidència*/
			$result=$this->stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		function rowcont(){ /*???*//* retorna el valor de fileres afectades després d'un INSERT, UPDATE. o DELETE*/
			$result=$this->stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		function lastInsertId(){ //retorna l'ultim ID com a string, de l'últim INSERT
			return $this->db->lastInsertId();
		}
		function beginTransaction(){
		/* Begin a transaction, turning off autocommit */
			$this->$db->beginTransaction();	
		}
		function endTransaction(){
			$this->$db->commit();
		}
		function cancelTransaction(){
			$this->db->rollBack();
		}

		function debugDumpParams(){
		// fa un return per depurar sentències preaparades
			$this->stmt->debugDumpParams();
		}

	}