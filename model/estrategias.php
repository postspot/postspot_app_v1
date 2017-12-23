<?php
require_once 'stConexao.php';

class estrategias
{

	public static $instance;
	public static $tabela = 'estrategias';


//--------- function insert($obj) --------------//



	public static function insert($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("INSERT INTO estrategias 
        (empresa, site, projeto, blog, produtos_servicos, links, objetivo_primario, kpis_primario, objetivo_secundario, 
        kpis_secundario, concorrentes, com_quem_falar, com_quem_nao_falar, abordar, evitar, linguagem, links_ref,
        canais, acoes, consideracoes_gerais, projetos_id_projeto) VALUES
        (:empresa, :site, :projeto, :blog, :produtos_servicos, :links, :objetivo_primario, :kpis_primario, :objetivo_secundario,
        :kpis_secundario, :concorrentes, :com_quem_falar, :com_quem_nao_falar, :abordar, :evitar, :linguagem,
        :links_ref, :canais, :acoes, :consideracoes_gerais, :projetos_id_projeto);");

			$stmt->bindParam(":empresa", $obj->empresa);
			$stmt->bindParam(":site", $obj->site);
			$stmt->bindParam(":projeto", $obj->projeto);
			$stmt->bindParam(":blog", $obj->blog);
			$stmt->bindParam(":produtos_servicos", $obj->produtos_servicos);
			$stmt->bindParam(":links", $obj->links);
			$stmt->bindParam(":objetivo_primario", $obj->objetivo_primario);
			$stmt->bindParam(":kpis_primario", $obj->kpis_primario);
			$stmt->bindParam(":objetivo_secundario", $obj->objetivo_secundario);
			$stmt->bindParam(":kpis_secundario", $obj->kpis_secundario);
			$stmt->bindParam(":concorrentes", $obj->concorrentes);
			$stmt->bindParam(":com_quem_falar", $obj->com_quem_falar);
			$stmt->bindParam(":com_quem_nao_falar", $obj->com_quem_nao_falar);
			$stmt->bindParam(":abordar", $obj->abordar);
			$stmt->bindParam(":evitar", $obj->evitar);
			$stmt->bindParam(":linguagem", $obj->linguagem);
			$stmt->bindParam(":links_ref", $obj->links_ref);
			$stmt->bindParam(":canais", $obj->canais);
			$stmt->bindParam(":acoes", $obj->acoes);
			$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
			$stmt->bindParam(":projetos_id_projeto", $obj->projetos_id_projeto);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return $ex->getMessage();
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE estrategias SET  "
				. " blog = :blog, "
				. " site = :site, "
				. " id_estrategia = :id_estrategia , "
				. " empresa = :empresa , "
				. " projeto = :projeto , "
				. " produtos_servicos = :produtos_servicos , "
				. " links = :links , "
				. " objetivo_primario = :objetivo_primario , "
				. " kpis_primario = :kpis_primario , "
				. " objetivo_secundario = :objetivo_secundario , "
				. " kpis_secundario = :kpis_secundario , "
				. " concorrentes = :concorrentes , "
				. " com_quem_falar = :com_quem_falar , "
				. " com_quem_nao_falar = :com_quem_nao_falar , "
				. " abordar = :abordar , "
				. " evitar = :evitar , "
				   //. " linguagem = :linguagem , "
				. " links_ref = :links_ref , "
				. " categorias = :categorias , "
				. " canais = :canais , "
				. " acoes = :acoes , "
				. " termos_proibidos = :termos_proibidos , "
				. " mapeamentos_aprendizado = :mapeamentos_aprendizado , "
				. " mapeamentos_reconhecimento = :mapeamentos_reconhecimento , "
				. " mapeamentos_consideracoes = :mapeamentos_consideracoes , "
				. " mapeamentos_decisao = :mapeamentos_decisao , "
				. " consideracoes_gerais = :consideracoes_gerais , "
				. " projetos_id_projeto = :projetos_id_projeto  "
				. " WHERE id_estrategia = :id_estrategia ");

			$stmt->bindParam(":mapeamentos_aprendizado", $obj->mapeamentos_aprendizado);
			$stmt->bindParam(":mapeamentos_reconhecimento", $obj->mapeamentos_reconhecimento);
			$stmt->bindParam(":mapeamentos_consideracoes", $obj->mapeamentos_consideracoes);
			$stmt->bindParam(":mapeamentos_decisao", $obj->mapeamentos_decisao);
			$stmt->bindParam(":termos_proibidos", $obj->termos_proibidos);
			$stmt->bindParam(":id_estrategia", $obj->id_estrategia);
			$stmt->bindParam(":empresa", $obj->empresa);
			$stmt->bindParam(":site", $obj->site);
			$stmt->bindParam(":projeto", $obj->projeto);
			$stmt->bindParam(":blog", $obj->blog);
			$stmt->bindParam(":produtos_servicos", $obj->produtos_servicos);
			$stmt->bindParam(":links", $obj->links);
			$stmt->bindParam(":objetivo_primario", $obj->objetivo_primario);
			$stmt->bindParam(":kpis_primario", $obj->kpis_primario);
			$stmt->bindParam(":objetivo_secundario", $obj->objetivo_secundario);
			$stmt->bindParam(":kpis_secundario", $obj->kpis_secundario);
			$stmt->bindParam(":concorrentes", $obj->concorrentes);
			$stmt->bindParam(":com_quem_falar", $obj->com_quem_falar);
			$stmt->bindParam(":com_quem_nao_falar", $obj->com_quem_nao_falar);
			$stmt->bindParam(":abordar", $obj->abordar);
			$stmt->bindParam(":evitar", $obj->evitar);
					//$stmt->bindParam(":linguagem", $obj->linguagem);
			$stmt->bindParam(":links_ref", $obj->links_ref);
			$stmt->bindParam(":categorias", $obj->categorias);
			$stmt->bindParam(":canais", $obj->canais);
			$stmt->bindParam(":acoes", $obj->acoes);
			$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
			$stmt->bindParam(":projetos_id_projeto", $obj->projetos_id_projeto);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}


 //------------------ function select($id)---------//



	public static function getById($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM estrategias WHERE projetos_id_projeto = :id");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
		}
	}


 //------------------ function delete($id)---------//



	public static function delete($id)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("DELETE FROM estrategias WHERE projetos_id_projeto = :id");

			$stmt->bindParam(":id", $id);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}
}