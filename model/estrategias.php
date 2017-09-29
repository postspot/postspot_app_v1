<?php
require_once 'stConexao.php';

class estrategias { 

	public static $instance;
	public static $tabela = 'estrategias';


//--------- function insert($obj) --------------//



	public static function insert($obj) {
        try{
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
		$stmt->bindParam(":categorias_conteudo", $obj->categorias_conteudo);
		$stmt->bindParam(":canais", $obj->canais);
		$stmt->bindParam(":acoes", $obj->acoes);
		$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
		$stmt->bindParam(":projetos_id_projeto", $obj->projetos_id_projeto);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return $ex;
		}
	}


 //------------------ function update($obj)  ---------//

 public static function update($obj) {
	try{
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
				   //. " categorias_conteudo = :categorias_conteudo , "
				   . " canais = :canais , "
				   . " acoes = :acoes , "
				   . " termos_proibidos = :termos_proibidos , "
				   . " mapeamentos = :mapeamentos , "
				   . " consideracoes_gerais = :consideracoes_gerais , "
				   . " projetos_id_projeto = :projetos_id_projeto  "
				   . " WHERE id_estrategia = :id_estrategia ");

				   $stmt->bindParam(":termos_proibidos", $obj->termos_proibidos);
				   $stmt->bindParam(":mapeamentos", $obj->mapeamentos);
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
					//$stmt->bindParam(":categorias_conteudo", $obj->categorias_conteudo);
					$stmt->bindParam(":canais", $obj->canais);
					$stmt->bindParam(":acoes", $obj->acoes);
					$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
					$stmt->bindParam(":projetos_id_projeto", $obj->projetos_id_projeto);

					$stmt->execute(); 
						return true;
					} catch(PDOException $ex) {
						echo $ex->getMessage();
					}
					}


 //------------------ function select($id)---------//



	public static function getById($id) {

	 try {
		$stmt = Conexao::getInstance()->prepare("SELECT * FROM estrategias WHERE projetos_id_projeto = :id");

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


 //------------------ function delete($id)---------//



	public static function delete($id) {
		 try{ 
		$stmt = Conexao::getInstance()->prepare("DELETE FROM estrategias WHERE projetos_id_projeto = :id");

		$stmt->bindParam(":id", $id);

		$stmt->execute(); 
			return true;
		} catch(PDOException $ex) {
		return false;
		}
	}
}