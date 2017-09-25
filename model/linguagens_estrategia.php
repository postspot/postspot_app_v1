<?php
require_once 'stConexao.php';

class linguagens_estrategia { 

	public static $instance;
	public static $tabela = 'linguagens_estrategia';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO linguagens_estrategia ( id_linguagem, id_estrategia)
 VALUES(:id_linguagem, :id_estrategia);");

		$stmt->bindParam(":id_linguagem", $obj->id_linguagem);
		$stmt->bindParam(":id_estrategia", $obj->id_estrategia);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
			$ex->getMessage();
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE linguagens_estrategia SET id_linguagem_estrategia = :id_linguagem_estrategia , id_linguagem = :id_linguagem , id_estrategia = :id_estrategia  WHERE id_linguagem_estrategia = :id_linguagem_estrategia ");

		$stmt->bindParam(":id_linguagem_estrategia", $obj->id_linguagem_estrategia);
		$stmt->bindParam(":id_linguagem", $obj->id_linguagem);
		$stmt->bindParam(":id_estrategia", $obj->id_estrategia);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * "
		. " FROM linguagens_estrategia le"
		. " INNER JOIN linguagens li"
		. " ON(le.id_linguagem = li.id_linguagem)"
		. " WHERE id_estrategia = :id");
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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM linguagens_estrategia WHERE id_estrategia = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}