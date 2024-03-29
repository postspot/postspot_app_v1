<?php
require_once 'stConexao.php';

class comentarios { 

	public static $instance;
	public static $tabela = 'comentarios';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO comentarios (comentario, id_usuario, id_tarefa, status, equipe)
 VALUES(:comentario, :id_usuario, :id_tarefa, :status, :equipe);");

		$stmt->bindParam(":comentario", $obj->comentario);
		$stmt->bindParam(":id_usuario", $obj->id_usuario);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
		$stmt->bindParam(":status", $obj->status);
		$stmt->bindParam(":equipe", $obj->equipe);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE comentarios SET id_comentario = :id_comentario , data_criacao = :data_criacao , comentario = :comentario , id_usuario = :id_usuario , id_tarefa = :id_tarefa  WHERE id_comentario = :id_comentario ");

		$stmt->bindParam(":id_comentario", $obj->id_comentario);
		$stmt->bindParam(":data_criacao", $obj->data_criacao);
		$stmt->bindParam(":comentario", $obj->comentario);
		$stmt->bindParam(":id_usuario", $obj->id_usuario);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM comentarios WHERE id_tarefa = :id");

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

	public static function getAllComentariosByTarefa($id, $status, $condicao) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT co.*, us.nome_usuario, us.foto_usuario, us.funcao_usuario "
		 . " FROM comentarios co"
		 . " INNER JOIN usuarios us"
		 . " ON(co.id_usuario = us.id_usuario)"
		 . " WHERE co.id_tarefa = :id AND co.visivel = 1 AND co.status = :status $condicao ORDER BY co.data_criacao");

		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":status", $status);
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
		$stmt = Conexao::getInstance()->prepare("UPDATE comentarios SET visivel = 0  WHERE id_comentario = :id ");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}