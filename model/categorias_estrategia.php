<?php
require_once 'stConexao.php';

class categorias_estrategia { 

	public static $instance;
	public static $tabela = 'categorias_estrategia';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO categorias_estrategia (id_categoria_estrategia, id_estrategia, id_categoria)
 VALUES(:id_categoria_estrategia, :id_estrategia, :id_categoria);");

		$stmt->bindParam(":id_categoria_estrategia", $obj->id_categoria_estrategia);
		$stmt->bindParam(":id_estrategia", $obj->id_estrategia);
		$stmt->bindParam(":id_categoria", $obj->id_categoria);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE categorias_estrategia SET id_categoria_estrategia = :id_categoria_estrategia , id_estrategia = :id_estrategia , id_categoria = :id_categoria  WHERE id_categoria_estrategia = :id_categoria_estrategia ");

		$stmt->bindParam(":id_categoria_estrategia", $obj->id_categoria_estrategia);
		$stmt->bindParam(":id_estrategia", $obj->id_estrategia);
		$stmt->bindParam(":id_categoria", $obj->id_categoria);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM categorias_estrategia WHERE id_categoria = :id");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM categorias_estrategia WHERE id_categoria = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}