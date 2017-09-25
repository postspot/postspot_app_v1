<?php
require_once 'stConexao.php';

class usuarios { 

	public static $instance;
	public static $tabela = 'usuarios';
        
        
        public static function getAutoInc() {
            $stmt = Conexao::getInstance()->prepare("SHOW TABLE STATUS LIKE '" . self::$tabela . "'");

            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $cod_produto = $row->Auto_increment;
                    return $cod_produto;
                }
            }
        }


//--------- function insert($obj) --------------//



	public static function insert($obj) {
            try{
            $stmt = Conexao::getInstance()->prepare("INSERT INTO usuarios 
            (nome_usuario, sexo_usuario, foto_usuario, funcao_usuario, email_usuario, senha_usuario)VALUES
            (:nome_usuario, :sexo_usuario, :foto_usuario, :funcao_usuario, :email_usuario, :senha_usuario);");

		$stmt->bindParam(":nome_usuario", $obj->nome_usuario);
		$stmt->bindParam(":sexo_usuario", $obj->sexo_usuario);
		$stmt->bindParam(":foto_usuario", $obj->foto_usuario);
		$stmt->bindParam(":funcao_usuario", $obj->funcao_usuario);
		$stmt->bindParam(":email_usuario", $obj->email_usuario);
		$stmt->bindParam(":senha_usuario", $obj->senha_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE usuarios SET id_usuario = :id_usuario , nome_usuario = :nome_usuario , sexo_usuario = :sexo_usuario , foto_usuario = :foto_usuario , idiomas = :idiomas , funcao_usuario = :funcao_usuario , email_usuario = :email_usuario , senha_usuario = :senha_usuario , cadastro_usuario = :cadastro_usuario  WHERE id_usuario = :id_usuario ");

		$stmt->bindParam(":id_usuario", $obj->id_usuario);
		$stmt->bindParam(":nome_usuario", $obj->nome_usuario);
		$stmt->bindParam(":sexo_usuario", $obj->sexo_usuario);
		$stmt->bindParam(":foto_usuario", $obj->foto_usuario);
		$stmt->bindParam(":idiomas", $obj->idiomas);
		$stmt->bindParam(":funcao_usuario", $obj->funcao_usuario);
		$stmt->bindParam(":email_usuario", $obj->email_usuario);
		$stmt->bindParam(":senha_usuario", $obj->senha_usuario);
		$stmt->bindParam(":cadastro_usuario", $obj->cadastro_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");

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
	public static function getAllTipo($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT id_usuario, nome_usuario, email_usuario, foto_usuario, funcao_usuario"
                . " FROM usuarios WHERE funcao_usuario = :id");

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
	
	public static function getMenosEscritores() {
		
		try {
		$stmt = Conexao::getInstance()->prepare("SELECT us.id_usuario, us.nome_usuario, us.funcao_usuario"
				. " FROM usuarios us"
				. " left JOIN membros_equipe me"
				. " ON( us.id_usuario = me.id_usuario)"
				. " WHERE us.funcao_usuario <> 2 AND me.id_usuario is null");

			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}
	
	public static function countRedatores() {
		
		try {
		$stmt = Conexao::getInstance()->prepare("SELECT COUNT(id_usuario) AS redatores FROM usuarios WHERE funcao_usuario = 2");

			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->redatores;
			}
			return false;
		} catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}
        
        public static function login($login, $senha) {
            $stmt = Conexao::getInstance()->prepare("SELECT id_usuario, nome_usuario, "
                    . "funcao_usuario "
                    . "FROM " . self::$tabela
                    . " WHERE email_usuario= :login_usuario "
                    . "AND senha_usuario= :senha_usuario");

            $stmt->bindParam(":login_usuario", $login);
            $stmt->bindParam(":senha_usuario", $senha);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {

                    return $row;
                }
                return null;
            }
        }


 //------------------ function delete($id)---------//



	public static function delete($id) {
		 try{ 
		$stmt = Conexao::getInstance()->prepare("DELETE FROM usuarios WHERE id_usuario = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}