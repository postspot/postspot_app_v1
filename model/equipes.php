<?php
require_once 'stConexao.php';

class equipes { 

	public static $instance;
	public static $tabela = 'equipes';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO equipes (id_equipe, cadastro_equipe)
 VALUES(:id_equipe, :cadastro_equipe);");

		$stmt->bindParam(":id_equipe", $obj->id_equipe);
		$stmt->bindParam(":cadastro_equipe", $obj->cadastro_equipe);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE equipes SET id_equipe = :id_equipe , cadastro_equipe = :cadastro_equipe  WHERE id_equipe = :id_equipe ");

		$stmt->bindParam(":id_equipe", $obj->id_equipe);
		$stmt->bindParam(":cadastro_equipe", $obj->cadastro_equipe);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM equipes WHERE id_equipe = :id");

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


 //------------------ function delete($id)---------//



	public static function delete($id) {
		 try{ 
		$stmt = Conexao::getInstance()->prepare("DELETE FROM equipes WHERE id_equipe = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}