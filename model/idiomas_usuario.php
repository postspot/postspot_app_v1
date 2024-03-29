<?php
require_once 'stConexao.php';

class idiomas_usuario { 

	public static $instance;
	public static $tabela = 'idiomas_usuario';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO idiomas_usuario
                (idiomas_id_idioma, usuarios_id_usuario)
                VALUES(:idiomas_id_idioma, :usuarios_id_usuario);");

		$stmt->bindParam(":idiomas_id_idioma", $obj->id_idioma);
		$stmt->bindParam(":usuarios_id_usuario", $obj->id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return $ex;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE idiomas_usuario SET id_idiomas_usuario = :id_idiomas_usuario , idiomas_id_idioma = :idiomas_id_idioma , usuarios_id_usuario = :usuarios_id_usuario  WHERE id_idiomas_usuario = :id_idiomas_usuario ");

		$stmt->bindParam(":id_idiomas_usuario", $obj->id_idiomas_usuario);
		$stmt->bindParam(":idiomas_id_idioma", $obj->idiomas_id_idioma);
		$stmt->bindParam(":usuarios_id_usuario", $obj->usuarios_id_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getIdiomasUsuario($id) {

	 try {
		//$stmt = Conexao::getInstance()->prepare("SELECT * FROM idiomas_usuario WHERE usuarios_id_usuario = :id");

		$stmt = Conexao::getInstance()->prepare("SELECT * "
		. " FROM idiomas_usuario iu"
		. " INNER JOIN idiomas id"
		. " ON(iu.idiomas_id_idioma = id.id_idioma)"
		. " WHERE usuarios_id_usuario = :id");
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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM idiomas_usuario WHERE usuarios_id_usuario = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}