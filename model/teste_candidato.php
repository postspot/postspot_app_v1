<?php
require_once 'stConexao.php';

class teste_candidato
{

    public static $instance;
    public static $tabela = 'teste_candidato';

//--------- function insert($obj) --------------//

    public static function insert($obj)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("INSERT INTO teste_candidato (id_teste_candidato, nome_teste_candidato, especificacoes_teste_candidato, pauta_teste_candidato)
 VALUES(:id_teste_candidato, :nome_teste_candidato, :especificacoes_teste_candidato, :pauta_teste_candidato);");

            $stmt->bindParam(":id_teste_candidato", $obj->id_teste_candidato);
            $stmt->bindParam(":nome_teste_candidato", $obj->nome_teste_candidato);
            $stmt->bindParam(":especificacoes_teste_candidato", $obj->especificacoes_teste_candidato);
            $stmt->bindParam(":pauta_teste_candidato", $obj->pauta_teste_candidato);

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
            $stmt = Conexao::getInstance()->prepare("UPDATE teste_candidato SET id_teste_candidato = :id_teste_candidato , nome_teste_candidato = :nome_teste_candidato , especificacoes_teste_candidato = :especificacoes_teste_candidato , pauta_teste_candidato = :pauta_teste_candidato  WHERE id_teste_candidato = :id_teste_candidato ");

            $stmt->bindParam(":id_teste_candidato", $obj->id_teste_candidato);
            $stmt->bindParam(":nome_teste_candidato", $obj->nome_teste_candidato);
            $stmt->bindParam(":especificacoes_teste_candidato", $obj->especificacoes_teste_candidato);
            $stmt->bindParam(":pauta_teste_candidato", $obj->pauta_teste_candidato);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    //------------------ function select($id)---------//

    public static function getById($id)
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT * FROM teste_candidato WHERE id_teste_candidato = :id");

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

    public static function getAll()
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT * FROM teste_candidato");

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

    //------------------ function delete($id)---------//

    public static function delete($id)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("DELETE FROM teste_candidato WHERE id_teste_candidato = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
