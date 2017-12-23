<?php
require_once 'stConexao.php';

class personas { 

	public static $instance;
	public static $tabela = 'personas';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
        try{
        $stmt = Conexao::getInstance()->prepare("INSERT INTO personas 
        (nome, idade, sexo, caracteristicas, educacao, trabalho, segmento,
        objetivos, descricao, resolucao, foto, id_projeto, aprendizado, reconhecimento, consideracao, decisao)VALUES
        (:nome, :idade, :sexo, :caracteristicas, :educacao, :trabalho, :segmento,
        :objetivos, :descricao, :resolucao, :foto, :id_projeto, :aprendizado, :reconhecimento, :consideracao, :decisao);");

		$stmt->bindParam(":nome", $obj->nome);
		$stmt->bindParam(":idade", $obj->idade);
		$stmt->bindParam(":sexo", $obj->sexo);
		$stmt->bindParam(":caracteristicas", $obj->caracteristicas);
		$stmt->bindParam(":educacao", $obj->educacao);
		$stmt->bindParam(":trabalho", $obj->trabalho);
		$stmt->bindParam(":segmento", $obj->segmento);
		$stmt->bindParam(":objetivos", $obj->objetivos);
		$stmt->bindParam(":descricao", $obj->descricao);
		$stmt->bindParam(":resolucao", $obj->resolucao);
		$stmt->bindParam(":aprendizado", $obj->aprendizado);
		$stmt->bindParam(":reconhecimento", $obj->reconhecimento);
		$stmt->bindParam(":consideracao", $obj->consideracao);
		$stmt->bindParam(":decisao", $obj->decisao);
		$stmt->bindParam(":foto", $obj->foto);
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
		$stmt = Conexao::getInstance()->prepare("UPDATE personas SET "
                . "nome = :nome , idade = :idade , sexo = :sexo , caracteristicas = :caracteristicas , "
                . "educacao = :educacao , trabalho = :trabalho , segmento = :segmento , "
                . "objetivos = :objetivos , descricao = :descricao , resolucao = :resolucao ,"
                . "aprendizado = :aprendizado , reconhecimento = :reconhecimento , consideracao = :consideracao , decisao = :decisao ,"
                . " foto =:foto  WHERE id_persona = :id_persona ");

		$stmt->bindParam(":id_persona", $obj->id_persona);
		$stmt->bindParam(":nome", $obj->nome);
		$stmt->bindParam(":idade", $obj->idade);
		$stmt->bindParam(":sexo", $obj->sexo);
		$stmt->bindParam(":caracteristicas", $obj->caracteristicas);
		$stmt->bindParam(":educacao", $obj->educacao);
		$stmt->bindParam(":trabalho", $obj->trabalho);
		$stmt->bindParam(":segmento", $obj->segmento);
		$stmt->bindParam(":objetivos", $obj->objetivos);
		$stmt->bindParam(":descricao", $obj->descricao);
		$stmt->bindParam(":resolucao", $obj->resolucao);
		$stmt->bindParam(":aprendizado", $obj->aprendizado);
		$stmt->bindParam(":reconhecimento", $obj->reconhecimento);
		$stmt->bindParam(":consideracao", $obj->consideracao);
		$stmt->bindParam(":decisao", $obj->decisao);
		$stmt->bindParam(":foto", $obj->foto);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		 echo $ex->getMessage();
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM personas WHERE id_persona = :id");

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
	public static function getByProjeto($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM personas WHERE id_projeto = :id");

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

	public static function getAllPersona() {

	 try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM personas");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM personas WHERE id_persona =:id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}