<?php
require_once 'stConexao.php';

class categorias { 

	public static $instance;
	public static $tabela = 'categorias';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO categorias (nome_categoria)
 VALUES(:nome_categoria);");

		$stmt->bindParam(":nome_categoria", $obj->nome_categoria);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE categorias SET id_categoria = :id_categoria , nome_categoria = :nome_categoria  WHERE id_categoria = :id_categoria ");

		$stmt->bindParam(":id_categoria", $obj->id_categoria);
		$stmt->bindParam(":nome_categoria", $obj->nome_categoria);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM categorias WHERE id_categoria = :id");

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
	
	
		public static function getAll() {
	
		 try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM categorias");
	
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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM categorias WHERE id_categoria = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}