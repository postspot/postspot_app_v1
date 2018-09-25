<?php
require_once 'stConexao.php';

class conteudo_teste_candidato
{

    public static $instance;
    public static $tabela = 'conteudo_teste_candidato';

//--------- function insert($obj) --------------//

    public static function insert($obj)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("INSERT INTO conteudo_teste_candidato (id_conteudo_teste_candidato, especificacoes_conteudo_teste_candidato, pauta_conteudo_teste_candidato, id_teste_candidato)
 VALUES(:id_conteudo_teste_candidato, :especificacoes_conteudo_teste_candidato, :pauta_conteudo_teste_candidato, :id_teste_candidato);");

            $stmt->bindParam(":id_conteudo_teste_candidato", $obj->id_conteudo_teste_candidato);
            $stmt->bindParam(":especificacoes_conteudo_teste_candidato", $obj->especificacoes_conteudo_teste_candidato);
            $stmt->bindParam(":pauta_conteudo_teste_candidato", $obj->pauta_conteudo_teste_candidato);
            $stmt->bindParam(":id_teste_candidato", $obj->id_teste_candidato);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    //------------------ function update($obj)  ---------//

    public static function update($obj)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("UPDATE conteudo_teste_candidato SET id_conteudo_teste_candidato = :id_conteudo_teste_candidato , especificacoes_conteudo_teste_candidato = :especificacoes_conteudo_teste_candidato , pauta_conteudo_teste_candidato = :pauta_conteudo_teste_candidato , id_teste_candidato = :id_teste_candidato  WHERE id_conteudo_teste_candidato = :id_conteudo_teste_candidato ");

            $stmt->bindParam(":id_conteudo_teste_candidato", $obj->id_conteudo_teste_candidato);
            $stmt->bindParam(":especificacoes_conteudo_teste_candidato", $obj->especificacoes_conteudo_teste_candidato);
            $stmt->bindParam(":pauta_conteudo_teste_candidato", $obj->pauta_conteudo_teste_candidato);
            $stmt->bindParam(":id_teste_candidato", $obj->id_teste_candidato);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    //------------------ function select($id)---------//

    public static function getAll($tipo_conteudo = null)
    {
		$tipo_conteudo = (empty($tipo_conteudo)) ? '' : 'WHERE id_teste_candidato = "' . $tipo_conteudo;
        try {
            $stmt = Conexao::getInstance()->prepare("SELECT id_conteudo_teste_candidato FROM conteudo_teste_candidato");

            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($colunas, $row->id_conteudo_teste_candidato);
            }
            return $colunas;
        } catch (PDOException $ex) {
            return false;
        }
    }
    
    public static function getById($id)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("SELECT * FROM conteudo_teste_candidato WHERE id_conteudo_teste_candidato = :id");

            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                return $row;
            }
            return false;
        } catch (PDOException $ex) {
            return false;
        }
	}
	
    public static function getAllByCategoria($id)
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT * FROM conteudo_teste_candidato WHERE id_teste_candidato = :id");

            $stmt->bindParam(":id", $id);
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

    public static function getAllByHabilidade($id)
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT * FROM conteudo_teste_candidato WHERE id_habilidade = :id");

            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                return $row;
            }
            return false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    //------------------ function delete($id)---------//

    public static function delete($id)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("DELETE FROM conteudo_teste_candidato WHERE id_conteudo_teste_candidato = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
