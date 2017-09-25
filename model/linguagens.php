<?php
require_once 'stConexao.php';

class linguagens { 

	public static $instance;
	public static $tabela = 'linguagens';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO linguagens (id_linguagem, nome_linguagem)
 VALUES(:id_linguagem, :nome_linguagem);");

		$stmt->bindParam(":id_linguagem", $obj->id_linguagem);
		$stmt->bindParam(":nome_linguagem", $obj->nome_linguagem);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE linguagens SET id_linguagem = :id_linguagem , nome_linguagem = :nome_linguagem  WHERE id_linguagem = :id_linguagem ");

		$stmt->bindParam(":id_linguagem", $obj->id_linguagem);
		$stmt->bindParam(":nome_linguagem", $obj->nome_linguagem);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM linguagens WHERE id_linguagem = :id");

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
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM linguagens");
	
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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM linguagens WHERE id_linguagem = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}