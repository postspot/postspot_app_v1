<?php
require_once 'stConexao.php';

class usuarios
{

	public static $instance;
	public static $tabela = 'usuarios';


	public static function getAutoInc()
	{
		$stmt = Conexao::getInstance()->prepare("SHOW TABLE STATUS LIKE '" . self::$tabela . "'");

		if ($stmt->execute()) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$cod_produto = $row->Auto_increment;
				return $cod_produto;
			}
		}
	}


//--------- function insert($obj) --------------//



	public static function insert($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("INSERT INTO usuarios 
            (nome_usuario, sobrenome_usuario, sexo_usuario, foto_usuario, funcao_usuario, email_usuario, senha_usuario, obs, doc_usuario, banco_usuario, agencia_usuario, conta_usuario)VALUES
            (:nome_usuario, :sobrenome_usuario, :sexo_usuario, :foto_usuario, :funcao_usuario, :email_usuario, :senha_usuario, :obs, :doc_usuario, :banco_usuario, :agencia_usuario, :conta_usuario);");

			$stmt->bindParam(":nome_usuario", $obj->nome_usuario);
			$stmt->bindParam(":sobrenome_usuario", $obj->sobrenome_usuario);
			$stmt->bindParam(":sexo_usuario", $obj->sexo_usuario);
			$stmt->bindParam(":foto_usuario", $obj->foto_usuario);
			$stmt->bindParam(":funcao_usuario", $obj->funcao_usuario);
			$stmt->bindParam(":email_usuario", $obj->email_usuario);
			$stmt->bindParam(":senha_usuario", $obj->senha_usuario);
			$stmt->bindParam(":obs", $obj->obs);
			$stmt->bindParam(":doc_usuario", $obj->doc_usuario);
			$stmt->bindParam(":banco_usuario", $obj->banco_usuario);
			$stmt->bindParam(":agencia_usuario", $obj->agencia_usuario);
			$stmt->bindParam(":conta_usuario", $obj->conta_usuario);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
			return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE usuarios SET nome_usuario = :nome_usuario , sexo_usuario = :sexo_usuario, funcao_usuario = :funcao_usuario , email_usuario = :email_usuario, obs = :obs, doc_usuario = :doc_usuario, banco_usuario = :banco_usuario, agencia_usuario = :agencia_usuario, conta_usuario = :conta_usuario  WHERE id_usuario = :id_usuario ");

			$stmt->bindParam(":id_usuario", $obj->id_usuario);
			$stmt->bindParam(":nome_usuario", $obj->nome_usuario);
			$stmt->bindParam(":sexo_usuario", $obj->sexo_usuario);
			$stmt->bindParam(":funcao_usuario", $obj->funcao_usuario);
			$stmt->bindParam(":obs", $obj->obs);
			$stmt->bindParam(":email_usuario", $obj->email_usuario);
			$stmt->bindParam(":doc_usuario", $obj->doc_usuario);
			$stmt->bindParam(":banco_usuario", $obj->banco_usuario);
			$stmt->bindParam(":agencia_usuario", $obj->agencia_usuario);
			$stmt->bindParam(":conta_usuario", $obj->conta_usuario);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}

	public static function updatePerfil($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE usuarios SET 
			foto_usuario = :foto_usuario, 
			nome_usuario = :nome_usuario , 
			sexo_usuario = :sexo_usuario , 
			email_usuario = :email_usuario, 
			obs = :obs, 
			doc_usuario = :doc_usuario, 
			banco_usuario = :banco_usuario, 
			agencia_usuario = :agencia_usuario, 
			conta_usuario = :conta_usuario, 
			digito_verificador_usuario = :digito_verificador_usuario, 
			tipo_conta_usuario = :tipo_conta_usuario, 
			modalidade_conta_usuario = :modalidade_conta_usuario, 
			cod_banco_usuario = :cod_banco_usuario, 
			nascimento_usuario = :nascimento_usuario, 
			telefone_usuario = :telefone_usuario   
			WHERE id_usuario = :id_usuario ");

			$stmt->bindParam(":id_usuario", $obj->id_usuario);
			$stmt->bindParam(":nome_usuario", $obj->nome_usuario);
			$stmt->bindParam(":sexo_usuario", $obj->sexo_usuario);
			$stmt->bindParam(":email_usuario", $obj->email_usuario);
			$stmt->bindParam(":foto_usuario", $obj->foto_usuario);
			$stmt->bindParam(":obs", $obj->obs);
			$stmt->bindParam(":doc_usuario", $obj->doc_usuario);
			$stmt->bindParam(":banco_usuario", $obj->banco_usuario);
			$stmt->bindParam(":agencia_usuario", $obj->agencia_usuario);
			$stmt->bindParam(":conta_usuario", $obj->conta_usuario);
			$stmt->bindParam(":digito_verificador_usuario", $obj->digito_verificador_usuario);
			$stmt->bindParam(":tipo_conta_usuario", $obj->tipo_conta_usuario);
			$stmt->bindParam(":modalidade_conta_usuario", $obj->modalidade_conta_usuario);
			$stmt->bindParam(":cod_banco_usuario", $obj->cod_banco_usuario);
			$stmt->bindParam(":nascimento_usuario", $obj->nascimento_usuario);
			$stmt->bindParam(":telefone_usuario", $obj->telefone_usuario);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}

	public static function updateFoto($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE usuarios SET 
			foto_usuario = :foto_usuario 
			WHERE id_usuario = :id_usuario ");

			$stmt->bindParam(":id_usuario", $obj->id_usuario);
			$stmt->bindParam(":foto_usuario", $obj->foto_usuario);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}

	public static function trocaSenha($id, $senha)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE usuarios SET senha_usuario = :senha_usuario  WHERE id_usuario = :id_usuario ");

			$stmt->bindParam(":id_usuario", $id);
			$stmt->bindParam(":senha_usuario", $senha);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				unset($row->senha_usuario);
				return $row;
			}
			return null;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}

	public static function getPossiveisInscritos($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT can.* , us.*
			FROM candidatos can
			INNER JOIN usuarios us
			on(can.id_usuario = us.id_usuario)
			WHERE us.id_usuario = :id");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				unset($row->senha_usuario);
				return $row;
			}
			return null;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}
	public static function getAllTipo($id)
	{

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
		} catch (PDOException $ex) {
			$ex->getMessage();
		}
	}

	public static function getAllEscritores($equipe)
	{

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
		} catch (PDOException $ex) {
			$ex->getMessage();
		}
	}

	public static function getAll()
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT id_usuario, nome_usuario, email_usuario, foto_usuario, funcao_usuario"
				. " FROM usuarios");

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


	public static function getMenosEscritores($equipe)
	{

		try {
		/*$stmt = Conexao::getInstance()->prepare("SELECT us.id_usuario, us.nome_usuario, us.funcao_usuario"
				. " FROM usuarios us"
				. " left JOIN membros_equipe me"
				. " ON( us.id_usuario = me.id_usuario)"
				. " WHERE us.funcao_usuario <> 2 AND me.id_usuario is null");*/

			$stmt = Conexao::getInstance()->prepare("select DISTINCT(u.id_usuario), u.nome_usuario, u.funcao_usuario from usuarios u inner join membros_equipe m WHERE
			u.funcao_usuario != 2 and u.id_usuario not in (SELECT me.id_usuario from membros_equipe me WHERE me.id_equipe = :id_equipe) ORDER BY u.nome_usuario ASC");

			$stmt->bindParam(":id_equipe", $equipe);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public static function countRedatores()
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT COUNT(id_usuario) AS redatores FROM usuarios WHERE funcao_usuario = 2");

			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->redatores;
			}
			return false;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public static function login($login, $senha)
	{
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

	
	public static function getByEmail($email)
	{
		$stmt = Conexao::getInstance()->prepare("SELECT id_usuario, nome_usuario, foto_usuario, "
			. "funcao_usuario "
			. "FROM " . self::$tabela
			. " WHERE email_usuario= :email_usuario ");

		$stmt->bindParam(":email_usuario", $email);
		if ($stmt->execute()) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {

				return $row;
			}
			return null;
		}
	}


 //------------------ function delete($id)---------//



	public static function delete($id)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("DELETE FROM usuarios WHERE id_usuario = :id");

			$stmt->bindParam(":id", $id);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
			//return false;
		}
	}
}