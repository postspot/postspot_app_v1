<?php
require_once 'stConexao.php';

class membros_equipe { 

	public static $instance;
	public static $tabela = 'membros_equipe';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO membros_equipe (id_membros, id_equipe, id_usuario)
 VALUES(:id_membros, :id_equipe, :id_usuario);");

		$stmt->bindParam(":id_membros", $obj->id_membros);
		$stmt->bindParam(":id_equipe", $obj->id_equipe);
		$stmt->bindParam(":id_usuario", $obj->id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE membros_equipe SET id_membros = :id_membros , id_equipe = :id_equipe , id_usuario = :id_usuario  WHERE id_membros = :id_membros ");

		$stmt->bindParam(":id_membros", $obj->id_membros);
		$stmt->bindParam(":id_equipe", $obj->id_equipe);
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
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM membros_equipe WHERE id_usuario = :id");

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

	public static function buscarPessoasDaEquipe($equipe) {

	 try {
		$stmt = Conexao::getInstance()->prepare('SELECT * '
		. 'FROM membros_equipe as me'
		. 'INNER JOIN equipes eq'
		. 'ON(me.sss = eq.sss)'
		. 'INNER JOIN usuarios us'
		. 'ON(me.sss = us.sss)'
		. 'WHERE eq.id_equipe =:id_equipe');

		$stmt->bindParam(":id_equipe", $id);
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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM membros_equipe WHERE id_usuario = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}