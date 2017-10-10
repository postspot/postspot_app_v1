<?php
require_once 'stConexao.php';

class idiomas { 

	public static $instance;
	public static $tabela = 'idiomas';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO idiomas (id_idioma, nome_idioma)
 VALUES(:id_idioma, :nome_idioma);");

		$stmt->bindParam(":id_idioma", $obj->id_idioma);
		$stmt->bindParam(":nome_idioma", $obj->nome_idioma);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		//echo $ex->getMessage();
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE idiomas SET id_idioma = :id_idioma , nome_idioma = :nome_idioma  WHERE id_idioma = :id_idioma ");

		$stmt->bindParam(":id_idioma", $obj->id_idioma);
		$stmt->bindParam(":nome_idioma", $obj->nome_idioma);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM idiomas WHERE id_idioma = :id");

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

	public static function getAllIdiomas() {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM idiomas");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM idiomas WHERE id_idioma = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}