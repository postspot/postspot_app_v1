<?php
require_once 'stConexao.php';

class log_tarefas
{

	public static $instance;
	public static $tabela = 'log_tarefas';


//--------- function insert($obj) --------------//



	public static function insert($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("INSERT INTO log_tarefas 
            (status, etapa, data_prevista, id_tarefa, id_usuario)
 VALUES(:status, :etapa, :data_prevista, :id_tarefa, :id_usuario);");

			$stmt->bindParam(":status", $obj->status);
			$stmt->bindParam(":etapa", $obj->etapa);
			$stmt->bindParam(":data_prevista", $obj->data_prevista);
			$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
			$stmt->bindParam(":id_usuario", $obj->id_usuario);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE log_tarefas SET id_log = :id_log , status = :status , etapa = :etapa , data_criacao = :data_criacao , data_prevista = :data_prevista , id_tarefa = :id_tarefa , id_usuario = :id_usuario  WHERE id_log = :id_log ");

			$stmt->bindParam(":id_log", $obj->id_log);
			$stmt->bindParam(":status", $obj->status);
			$stmt->bindParam(":etapa", $obj->etapa);
			$stmt->bindParam(":data_criacao", $obj->data_criacao);
			$stmt->bindParam(":data_prevista", $obj->data_prevista);
			$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
			$stmt->bindParam(":id_usuario", $obj->id_usuario);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function resetStatus($cod)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE log_tarefas SET status = 0 WHERE id_tarefa = :id_tarefa");

			$stmt->bindParam(":id_tarefa", $cod);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getAllById($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT lt.etapa, lt.status ,us.nome_usuario "
			. " FROM log_tarefas lt"
			. " INNER JOIN usuarios us"
			. " ON(lt.id_usuario = us.id_usuario)"
			. " WHERE lt.id_tarefa = :id"
			. " ORDER BY lt.id_log DESC");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return false;
		}
	}
	public static function getById($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM log_tarefas WHERE id_usuario = :id");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function gatDataLogAvaliacao($tarefa)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT data_criacao FROM log_tarefas WHERE ((etapa = 9 OR etapa = 13) AND  id_tarefa = :id) ORDER BY id_log desc limit 1");

			$stmt->bindParam(":id", $tarefa);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->data_criacao;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function gatDataLogAprovacao($tarefa)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT data_criacao FROM log_tarefas WHERE ((etapa > 13) AND  id_tarefa = :id) ORDER BY id_log desc limit 1");

			$stmt->bindParam(":id", $tarefa);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->data_criacao;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function getNotificacoes($projeto)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT lg.etapa, ta.nome_tarefa, ta.id_tarefa FROM log_tarefas lg INNER JOIN tarefas ta ON (lg.id_tarefa = ta.id_tarefa) WHERE ta.id_projeto = :projeto AND lg.status = 1 AND (lg.etapa = 1 || lg.etapa = 2 || lg.etapa = 3 || lg.etapa = 8 || lg.etapa = 9 || lg.etapa = 10 || lg.etapa = 13 || lg.etapa = 14 || lg.etapa = 15) ORDER BY lg.id_log DESC LIMIT 10");

			$stmt->bindParam(":projeto", $projeto);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
		}
	}


 //------------------ function delete($id)---------//



	public static function delete($id)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("DELETE FROM log_tarefas WHERE id_usuario = :id");

			$stmt->bindParam(":id", $id);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}
}