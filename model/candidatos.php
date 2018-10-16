<?php
require_once 'stConexao.php';

class candidatos
{

    public static $instance;
    public static $tabela = 'candidatos';

//--------- function insert($obj) --------------//

    public static function insert($obj)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("INSERT INTO candidatos (id_candidato, id_usuario, estado_candidato, cidade_candidato, certificacao_candidato, linkedin_candidato, portifolio_candidato, experiencia_candidato, producao_candidato, formacao_candidato, area_estudo_candidato, curso_candidato, profissao_candidato, ingles_candidato, espanhol_candidato, status_candidato, modalidade_candidatos, id_conteudo_teste_candidato)
 VALUES(:id_candidato, :id_usuario, :estado_candidato, :cidade_candidato, :certificacao_candidato, :linkedin_candidato, :portifolio_candidato, :experiencia_candidato, :producao_candidato, :formacao_candidato, :area_estudo_candidato, :curso_candidato, :profissao_candidato, :ingles_candidato, :espanhol_candidato, :status_candidato, :modalidade_candidatos, :id_conteudo_teste_candidato);");

            $stmt->bindParam(":id_candidato", $obj->id_candidato);
            $stmt->bindParam(":id_usuario", $obj->id_usuario);
            $stmt->bindParam(":estado_candidato", $obj->estado_candidato);
            $stmt->bindParam(":cidade_candidato", $obj->cidade_candidato);
            $stmt->bindParam(":certificacao_candidato", $obj->certificacao_candidato);
            $stmt->bindParam(":linkedin_candidato", $obj->linkedin_candidato);
            $stmt->bindParam(":portifolio_candidato", $obj->portifolio_candidato);
            $stmt->bindParam(":experiencia_candidato", $obj->experiencia_candidato);
            $stmt->bindParam(":producao_candidato", $obj->producao_candidato);
            $stmt->bindParam(":formacao_candidato", $obj->formacao_candidato);
            $stmt->bindParam(":area_estudo_candidato", $obj->area_estudo_candidato);
            $stmt->bindParam(":curso_candidato", $obj->curso_candidato);
            $stmt->bindParam(":profissao_candidato", $obj->profissao_candidato);
            $stmt->bindParam(":ingles_candidato", $obj->ingles_candidato);
            $stmt->bindParam(":espanhol_candidato", $obj->espanhol_candidato);
            $stmt->bindParam(":status_candidato", $obj->status_candidato);
            $stmt->bindParam(":modalidade_candidatos", $obj->modalidade_candidatos);
            $stmt->bindParam(":id_conteudo_teste_candidato", $obj->id_conteudo_teste_candidato);

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
            $stmt = Conexao::getInstance()->prepare("UPDATE candidatos SET
		estado_candidato = :estado_candidato ,
		cidade_candidato = :cidade_candidato ,
		certificacao_candidato = :certificacao_candidato ,
		linkedin_candidato = :linkedin_candidato ,
		portifolio_candidato = :portifolio_candidato ,
		experiencia_candidato = :experiencia_candidato ,
		producao_candidato = :producao_candidato ,
		formacao_candidato = :formacao_candidato ,
		area_estudo_candidato = :area_estudo_candidato ,
		curso_candidato = :curso_candidato ,
		profissao_candidato = :profissao_candidato ,
		ingles_candidato = :ingles_candidato ,
		outro_idioma_candidato = :outro_idioma_candidato ,
		espanhol_candidato = :espanhol_candidato,
		status_candidato = :status_candidato,
		especialidade_candidatos = :especialidade_candidatos ,
		motivo_candidatos = :motivo_candidatos ,
		texto_candidatos = :texto_candidatos,
		rede_social_candidato = :rede_social_candidato,
		id_conteudo_teste_candidato = :id_conteudo_teste_candidato,
		razao_social_candidato = :razao_social_candidato,
		cnpj_candidato = :cnpj_candidato
		WHERE id_usuario = :id_usuario ");

            $stmt->bindParam(":id_usuario", $obj->id_usuario);
            $stmt->bindParam(":estado_candidato", $obj->estado_candidato);
            $stmt->bindParam(":cidade_candidato", $obj->cidade_candidato);
            $stmt->bindParam(":certificacao_candidato", $obj->certificacao_candidato);
            $stmt->bindParam(":linkedin_candidato", $obj->linkedin_candidato);
            $stmt->bindParam(":portifolio_candidato", $obj->portifolio_candidato);
            $stmt->bindParam(":experiencia_candidato", $obj->experiencia_candidato);
            $stmt->bindParam(":producao_candidato", $obj->producao_candidato);
            $stmt->bindParam(":formacao_candidato", $obj->formacao_candidato);
            $stmt->bindParam(":area_estudo_candidato", $obj->area_estudo_candidato);
            $stmt->bindParam(":curso_candidato", $obj->curso_candidato);
            $stmt->bindParam(":profissao_candidato", $obj->profissao_candidato);
            $stmt->bindParam(":ingles_candidato", $obj->ingles_candidato);
            $stmt->bindParam(":espanhol_candidato", $obj->espanhol_candidato);
            $stmt->bindParam(":outro_idioma_candidato", $obj->outro_idioma_candidato);
            $stmt->bindParam(":status_candidato", $obj->status_candidato);
            $stmt->bindParam(":especialidade_candidatos", $obj->especialidade_candidatos);
            $stmt->bindParam(":motivo_candidatos", $obj->motivo_candidatos);
            $stmt->bindParam(":texto_candidatos", $obj->texto_candidatos);
            $stmt->bindParam(":rede_social_candidato", $obj->rede_social_candidato);
            $stmt->bindParam(":id_conteudo_teste_candidato", $obj->id_conteudo_teste_candidato);
            $stmt->bindParam(":razao_social_candidato", $obj->razao_social_candidato);
            $stmt->bindParam(":cnpj_candidato", $obj->cnpj_candidato);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    public static function updateTeste($id_teste, $id_user)
    {
        try {
            $stmt = Conexao::getInstance()->prepare("UPDATE candidatos SET
            id_conteudo_teste_candidato = :id_conteudo_teste_candidato
            WHERE id_usuario = :id_usuario ");

            $stmt->bindParam(":id_usuario", $id_user);
            $stmt->bindParam(":id_conteudo_teste_candidato", $id_teste);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    //------------------ function select($id)---------//

    public static function getById($id)
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT can.* , us.*, tc.*
			FROM candidatos can
			INNER JOIN usuarios us
			on(can.id_usuario = us.id_usuario)
			INNER JOIN teste_candidato tc
			on(can.modalidade_candidatos = tc.id_teste_candidato)
			WHERE can.id_candidato = :id");

            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                unset($row->senha_usuario);
                return $row;
            }
            return $colunas;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    public static function getByIdUser($id)
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT can.* , us.*
			FROM candidatos can
			INNER JOIN usuarios us
			ON(can.id_usuario = us.id_usuario)
			WHERE can.id_usuario = :id");

            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                unset($row->senha_usuario);
                return $row;
            }
            return $colunas;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    public static function getAllMin()
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT can.id_candidato, can.status_candidato, can.data_cadastro_candidato, can.modalidade_candidatos , us.nome_usuario
			FROM candidatos can
			INNER JOIN usuarios us
			on(can.id_usuario = us.id_usuario)");

            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($colunas, $row);
            }
            return $colunas;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    public static function getAllCompleto()
    {

        try {
            $stmt = Conexao::getInstance()->prepare("SELECT can.* , us.*
			FROM candidatos can
			INNER JOIN usuarios us
			on(can.id_usuario = us.id_usuario)");

            $stmt->execute();
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                unset($row->senha_usuario);
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
            $stmt = Conexao::getInstance()->prepare("DELETE FROM candidatos WHERE id_candidato = :id");

            $stmt->bindParam(":id", $id);

            $stmt->execute();
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }
}
