<?php
require_once 'stConexao.php';

class publicacoes { 

	public static $instance;
	public static $tabela = 'publicacoes';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("INSERT INTO publicacoes (id_publicacao, texto_publicacao, status_publicacao, id_tarefa)
 VALUES(:id_publicacao, :texto_publicacao, :status_publicacao, :id_tarefa);");

		$stmt->bindParam(":id_publicacao", $obj->id_publicacao);
		$stmt->bindParam(":texto_publicacao", $obj->texto_publicacao);
		$stmt->bindParam(":status_publicacao", $obj->status_publicacao);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE publicacoes SET id_publicacao = :id_publicacao , texto_publicacao = :texto_publicacao , status_publicacao = :status_publicacao , data_criacao = :data_criacao , id_tarefa = :id_tarefa  WHERE id_publicacao = :id_publicacao ");

		$stmt->bindParam(":id_publicacao", $obj->id_publicacao);
		$stmt->bindParam(":texto_publicacao", $obj->texto_publicacao);
		$stmt->bindParam(":status_publicacao", $obj->status_publicacao);
		$stmt->bindParam(":data_criacao", $obj->data_criacao);
		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM publicacoes WHERE id_tarefa = :id");

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
	
	public static function getUltimaPublicacao($id) {
		
			 try {
				$stmt = Conexao::getInstance()->prepare("SELECT * "
				. " FROM publicacoes WHERE id_tarefa = :id "
				. " ORDER BY data_criacao DESC LIMIT 1");
		
				$stmt->bindParam(":id", $id);
				$stmt->execute();
				$colunas = array();
				while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
					return $row->texto_publicacao;
				}
				return false;
				} catch(PDOException $ex) {
					echo $ex->getMessage();
				}
			}


 //------------------ function delete($id)---------//



	public static function delete($id) {
		 try{ 
		$stmt = Conexao::getInstance()->prepare("DELETE FROM publicacoes WHERE id_tarefa = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}