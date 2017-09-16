<?php
require_once 'stConexao.php';

class anexos { 

	public static $instance;
	public static $tabela = 'anexos';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO anexos (id_anexo, data_criacao, id_tarefa, membros_equipe_id_membros)
 VALUES(:id_anexo, :data_criacao, :id_tarefa, :membros_equipe_id_membros);");

		$stmt->bindParam(":id_anexo", $obj->id_anexo);
		$stmt->bindParam(":data_criacao", $obj->data_criacao);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
		$stmt->bindParam(":membros_equipe_id_membros", $obj->membros_equipe_id_membros);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE anexos SET id_anexo = :id_anexo , data_criacao = :data_criacao , id_tarefa = :id_tarefa , membros_equipe_id_membros = :membros_equipe_id_membros  WHERE id_anexo = :id_anexo ");

		$stmt->bindParam(":id_anexo", $obj->id_anexo);
		$stmt->bindParam(":data_criacao", $obj->data_criacao);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
		$stmt->bindParam(":membros_equipe_id_membros", $obj->membros_equipe_id_membros);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM anexos WHERE membros_equipe_id_membros = :id");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM anexos WHERE membros_equipe_id_membros = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}