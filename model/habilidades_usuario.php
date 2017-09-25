<?php
require_once 'stConexao.php';

class habilidades_usuario { 

	public static $instance;
	public static $tabela = 'habilidades_usuario';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO habilidades_usuario 
                    (id_habilidade_usuario, habilidades_id_habilidade, usuarios_id_usuario)
                VALUES(:habilidades_id_habilidade, :usuarios_id_usuario);");

		$stmt->bindParam(":habilidades_id_habilidade", $obj->habilidades_id_habilidade);
		$stmt->bindParam(":usuarios_id_usuario", $obj->usuarios_id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE habilidades_usuario SET id_habilidade_usuario = :id_habilidade_usuario , habilidades_id_habilidade = :habilidades_id_habilidade , usuarios_id_usuario = :usuarios_id_usuario  WHERE id_habilidade_usuario = :id_habilidade_usuario ");

		$stmt->bindParam(":id_habilidade_usuario", $obj->id_habilidade_usuario);
		$stmt->bindParam(":habilidades_id_habilidade", $obj->habilidades_id_habilidade);
		$stmt->bindParam(":usuarios_id_usuario", $obj->usuarios_id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getHabilidadesUsuario($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM habilidades_usuario WHERE usuarios_id_usuario = :id");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM habilidades_usuario WHERE usuarios_id_usuario = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}