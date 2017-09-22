<?php
require_once 'stConexao.php';

class habilidades { 

	public static $instance;
	public static $tabela = 'habilidades';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO habilidades ( nome_habilidade)
 VALUES(:nome_habilidade);");

		$stmt->bindParam(":nome_habilidade", $obj->nome_habilidade);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE habilidades SET id_habilidade = :id_habilidade , nome_habilidade = :nome_habilidade  WHERE id_habilidade = :id_habilidade ");

		$stmt->bindParam(":id_habilidade", $obj->id_habilidade);
		$stmt->bindParam(":nome_habilidade", $obj->nome_habilidade);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM habilidades WHERE id_habilidade = :id");

		$stmt->bindParam(":id", $id);
		 $stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch(PDOException $ex) {
		return false;
		}
	}
	
		public static function getAllSkills() {
	
		 try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM habilidades");
	
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
			} catch(PDOException $ex) {
				return false;
			}
		}


 //------------------ function delete($id)---------//



	public static function delete($id) {
		 try{ 
		$stmt = Conexao::getInstance()->prepare("DELETE FROM habilidades WHERE id_habilidade = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}