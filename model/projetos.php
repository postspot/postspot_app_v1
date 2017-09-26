<?php
require_once 'stConexao.php';

class projetos { 

	public static $instance;
	public static $tabela = 'projetos';


//--------- function insert($obj) --------------//
        public static function getAutoInc() {
            $stmt = Conexao::getInstance()->prepare("SHOW TABLE STATUS LIKE '" . self::$tabela . "'");

            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $cod_produto = $row->Auto_increment;
                    return $cod_produto;
                }
            }
        }


	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO projetos 
                (nome_projeto, site_projeto, responsavel_projeto)
                VALUES(:nome_projeto, :site_projeto, :responsavel_projeto);");

		$stmt->bindParam(":nome_projeto", $obj->nome_projeto);
		$stmt->bindParam(":site_projeto", $obj->site_projeto);
		$stmt->bindParam(":responsavel_projeto", $obj->responsavel_projeto);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE projetos SET id_projeto = :id_projeto , nome_projeto = :nome_projeto , cadastro_projeto = :cadastro_projeto , site_projeto = :site_projeto , responsavel_projeto = :responsavel_projeto  WHERE id_projeto = :id_projeto ");

		$stmt->bindParam(":id_projeto", $obj->id_projeto);
		$stmt->bindParam(":nome_projeto", $obj->nome_projeto);
		$stmt->bindParam(":cadastro_projeto", $obj->cadastro_projeto);
		$stmt->bindParam(":site_projeto", $obj->site_projeto);
		$stmt->bindParam(":responsavel_projeto", $obj->responsavel_projeto);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getAll() {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM projetos");

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
	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM projetos WHERE id_projeto = :id");

		$stmt->bindParam(":id", $id);
		 $stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row;
			}
			return false;
		} catch(PDOException $ex) {
		return false;
		}
	}
        
        public static function getByUsuario($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM projetos WHERE responsavel_projeto = :id");

		$stmt->bindParam(":id", $id);
		 $stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			return $row;
		}
			
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function delete($id)---------//



	public static function delete($id) {
		 try{ 
		$stmt = Conexao::getInstance()->prepare("DELETE FROM projetos WHERE id_projeto = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}