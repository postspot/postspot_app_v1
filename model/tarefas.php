<?php
require_once 'stConexao.php';

class tarefas { 

	public static $instance;
	public static $tabela = 'tarefas';


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
            $stmt = Conexao::getInstance()->prepare("INSERT INTO tarefas 
            (nome_tarefa, id_tipo, palavra_chave, briefing_tarefa, estagio_compra, 
            tipo_cta, referencias, consideracoes_gerais, id_projeto, id_equipe) VALUES
            (:nome_tarefa, :id_tipo, :palavra_chave, :briefing_tarefa, :estagio_compra,
            :tipo_cta, :referencias, :consideracoes_gerais, :id_projeto, :id_equipe);");

		$stmt->bindParam(":nome_tarefa", $obj->nome_tarefa);
		$stmt->bindParam(":id_tipo", $obj->id_tipo);
		$stmt->bindParam(":palavra_chave", $obj->palavra_chave);
		$stmt->bindParam(":briefing_tarefa", $obj->briefing_tarefa);
		$stmt->bindParam(":estagio_compra", $obj->estagio_compra);
		$stmt->bindParam(":tipo_cta", $obj->tipo_cta);
		$stmt->bindParam(":referencias", $obj->referencias);
		$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
//		$stmt->bindParam(":id_persona", $obj->id_persona);
		$stmt->bindParam(":id_projeto", $obj->id_projeto);
		$stmt->bindParam(":id_equipe", $obj->id_equipe);

		$stmt->execute(); 
                    return true;
		} catch(PDOException $ex) {
                    return $ex;
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj) {
		 try{
		$stmt = Conexao::getInstance()->prepare("UPDATE tarefas SET id_tarefa = :id_tarefa , nome_tarefa = :nome_tarefa , id_tipo = :id_tipo , palavra_chave = :palavra_chave , briefing_tarefa = :briefing_tarefa , estagio_compra = :estagio_compra , id_projeto = :id_projeto , id_equipe = :id_equipe  WHERE id_tarefa = :id_tarefa ");

		$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
		$stmt->bindParam(":nome_tarefa", $obj->nome_tarefa);
		$stmt->bindParam(":id_tipo", $obj->id_tipo);
		$stmt->bindParam(":palavra_chave", $obj->palavra_chave);
		$stmt->bindParam(":briefing_tarefa", $obj->briefing_tarefa);
		$stmt->bindParam(":estagio_compra", $obj->estagio_compra);
		$stmt->bindParam(":id_projeto", $obj->id_projeto);
		$stmt->bindParam(":id_equipe", $obj->id_equipe);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM tarefas WHERE id_equipe = :id");

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
		$stmt = Conexao::getInstance()->prepare("DELETE FROM tarefas WHERE id_equipe = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}