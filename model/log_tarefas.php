<?php
require_once 'stConexao.php';

class log_tarefas { 

	public static $instance;
	public static $tabela = 'log_tarefas';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO log_tarefas 
            (status, etapa, data_prevista, data_entregue, id_tarefa, id_usuario)
 VALUES(:status, :etapa, :data_prevista, :data_entregue, :id_tarefa, :id_usuario);");

		$stmt->bindParam(":status", $obj->status);
		$stmt->bindParam(":etapa", $obj->etapa);
		$stmt->bindParam(":data_prevista", $obj->data_prevista);
		$stmt->bindParam(":data_entregue", $obj->data_entregue);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
		$stmt->bindParam(":id_usuario", $obj->id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return $ex;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE log_tarefas SET id_log = :id_log , status = :status , etapa = :etapa , data_criacao = :data_criacao , data_prevista = :data_prevista , data_entregue = :data_entregue , id_tarefa = :id_tarefa , id_usuario = :id_usuario  WHERE id_log = :id_log ");

		$stmt->bindParam(":id_log", $obj->id_log);
		$stmt->bindParam(":status", $obj->status);
		$stmt->bindParam(":etapa", $obj->etapa);
		$stmt->bindParam(":data_criacao", $obj->data_criacao);
		$stmt->bindParam(":data_prevista", $obj->data_prevista);
		$stmt->bindParam(":data_entregue", $obj->data_entregue);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
		$stmt->bindParam(":id_usuario", $obj->id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM log_tarefas WHERE id_usuario = :id");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM log_tarefas WHERE id_usuario = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}