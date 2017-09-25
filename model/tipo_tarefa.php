<?php
require_once 'stConexao.php';

class tipo_tarefa { 

	public static $instance;
	public static $tabela = 'tipo_tarefa';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO tipo_tarefa (nome_tarefa)
 VALUES(:nome_tarefa);");

		$stmt->bindParam(":nome_tarefa", $obj->nome_tarefa);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE tipo_tarefa SET id_tipo = :id_tipo , nome_tarefa = :nome_tarefa , id_tarefa = :id_tarefa  WHERE id_tipo = :id_tipo ");

		$stmt->bindParam(":id_tipo", $obj->id_tipo);
		$stmt->bindParam(":nome_tarefa", $obj->nome_tarefa);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM tipo_tarefa WHERE id_tarefa = :id");

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
	public static function getAllTiposTaredas() {
		
			 try {
				$stmt = Conexao::getInstance()->prepare("SELECT * FROM tipo_tarefa");
		
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
			$stmt = Conexao::getInstance()->prepare("DELETE FROM tipo_tarefa WHERE id_tipo = :id");

			$stmt->bindParam(":id", $id);

			$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}