<?php
require_once 'stConexao.php';

class anexos { 

	public static $instance;
	public static $tabela = 'anexos';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO anexos (nome_anexo, id_responsavel, id_projeto)
 VALUES(:nome_anexo, :id_responsavel, :id_projeto);");

		$stmt->bindParam(":nome_anexo", $obj->nome_anexo);
		$stmt->bindParam(":id_responsavel", $obj->id_responsavel);
		$stmt->bindParam(":id_projeto", $obj->id_projeto);

		$stmt->execute(); 
		return true;
		} catch(PDOException $ex) {
		echo $ex->getMessage();
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
	
	public static function getAllByProjeto($id) {

		try {
		$stmt = Conexao::getInstance()->prepare("SELECT an.*, us.nome_usuario "
		. " FROM anexos an"
		. " INNER JOIN usuarios us"
		. " ON(an.id_responsavel = us.id_usuario)"
		. " WHERE id_projeto = :id");

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