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
		$stmt = Conexao::getInstance()->prepare("UPDATE usuarios SET nome_usuario = :nome_usuario , sexo_usuario = :sexo_usuario, funcao_usuario = :funcao_usuario , email_usuario = :email_usuario  WHERE id_usuario = :id_usuario ");

		$stmt->bindParam(":id_usuario", $obj->id_usuario);
		$stmt->bindParam(":nome_usuario", $obj->nome_usuario);
		$stmt->bindParam(":sexo_usuario", $obj->sexo_usuario);
		$stmt->bindParam(":funcao_usuario", $obj->funcao_usuario);
		$stmt->bindParam(":email_usuario", $obj->email_usuario);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
			return $ex->getMessage();
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");

		$stmt->bindParam(":id", $id);
		 $stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				unset($row->senha_usuario);
				return $row;
			}
			return false;
		} catch(PDOException $ex) {
		return $ex->getMessage();
		}
	}
	public static function getAllTipo($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT us.id_usuario, us.nome_usuario, us.email_usuario, us.foto_usuario, us.funcao_usuario"
				. " FROM usuarios us"
				/*. " INNER JOIN habilidades_usuario hu"
				. " ON(us.id_usuario = hu.usuarios_id_usuario)"
				. " INNER JOIN idiomas_usuario iu"
				. " ON(us.id_usuario = iu.usuarios_id_usuario)"*/
				. " WHERE us.funcao_usuario = :id");

		$stmt->bindParam(":id", $id);
		 $stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch(PDOException $ex) {
			$ex->getMessage();
		}
	}

	public static function getAllEscritores($equipe) {

	 try {
		 $stmt = Conexao::getInstance()->prepare("select DISTINCT(u.id_usuario), u.nome_usuario from usuarios u inner join membros_equipe m WHERE
		 u.funcao_usuario = 2 and u.id_usuario not in (SELECT me.id_usuario from membros_equipe me WHERE me.id_equipe = :id_equipe)");

				$stmt->bindParam(":id_equipe", $equipe);
		 $stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch(PDOException $ex) {
			$ex->getMessage();
		}
	}
	
	public static function getAll() {
		
			 try {
				$stmt = Conexao::getInstance()->prepare("SELECT id_usuario, nome_usuario, email_usuario, foto_usuario, funcao_usuario"
						. " FROM usuarios");
		
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
            $stmt = Conexao::getInstance()->prepare("SELECT id_usuario, nome_usuario, foto_usuario, "
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