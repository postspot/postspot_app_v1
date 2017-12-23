<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/estrategias.php';
require_once '../../model/linguagens_estrategia.php';
require_once '../../model/categorias_estrategia.php';
session_start();
$estrategia = estrategias::getById($_SESSION['id_projeto']);

$id_projeto = $_SESSION['id_projeto'];
$empresa = $_POST["empresa"];
$site = $_POST["site"];
$projeto = $_POST["projeto"];
$blog = $_POST["blog"];
$produtos_servicos = $_POST["produtos_servicos"];
$links = $_POST["links"];
$concorrentes = $_POST["concorrentes"];
$com_quem_falar = $_POST["com_quem_falar"];
$com_quem_nao_falar = $_POST["com_quem_nao_falar"];
$abordar = $_POST["abordar"];
$evitar = $_POST["evitar"];
$canais = $_POST["canais"];
$links_ref = $_POST["links_ref"];
$acoes = $_POST["acoes"];
$consideracoes_gerais = $_POST["consideracoes_gerais"];
$termos_proibidos = $_POST["termos_proibidos"];
$mapeamentos_aprendizado = $_POST["mapeamentos_aprendizado"];
$mapeamentos_reconhecimento = $_POST["mapeamentos_reconhecimento"];
$mapeamentos_consideracoes = $_POST["mapeamentos_consideracoes"];
$mapeamentos_decisao = $_POST["mapeamentos_decisao"];
//tratando os select
$kpis_primario = empty($_POST["kpis_primario"]) ? 0 : $_POST["kpis_primario"];
$kpis_secundario = empty($_POST["kpis_secundario"]) ? 0 : $_POST["kpis_secundario"] ;
$objetivo_secundario = empty($_POST["objetivo_secundario"]) ? 0 : $_POST["objetivo_secundario"];
$objetivo_primario = empty($_POST["objetivo_primario"]) ? 0 : $_POST["objetivo_primario"] ;
$linguagem = empty($_POST["linguagem"]) ? 0 : $_POST["linguagem"] ;
$categorias = empty($_POST["categorias"]) ? 0 : $_POST["categorias"] ;


if (!empty($id_projeto)) {
	
	$obj = new stdClass();
	
	$obj->empresa = $empresa;
	$obj->site = $site;
	$obj->projeto = $projeto;
	$obj->blog = $blog;
	$obj->produtos_servicos = $produtos_servicos;
	$obj->links = $links;
	$obj->objetivo_primario = $objetivo_primario;
	$obj->kpis_primario = $kpis_primario;
	$obj->objetivo_secundario = $objetivo_secundario;
	$obj->kpis_secundario = $kpis_secundario;
	$obj->concorrentes = $concorrentes;
	$obj->com_quem_falar = $com_quem_falar;
	$obj->com_quem_nao_falar = $com_quem_nao_falar;
	$obj->abordar = $abordar;
	$obj->evitar = $evitar;
	$obj->linguagem = $linguagem;
	$obj->links_ref = $links_ref;
	$obj->categorias = $categorias;
	$obj->canais = $canais;
	$obj->acoes = $acoes;
	$obj->consideracoes_gerais = $consideracoes_gerais;
	$obj->projetos_id_projeto = $id_projeto; 
	$obj->termos_proibidos = $termos_proibidos;
	$obj->mapeamentos_aprendizado = $mapeamentos_aprendizado;         
	$obj->mapeamentos_reconhecimento = $mapeamentos_reconhecimento;         
	$obj->mapeamentos_consideracoes = $mapeamentos_consideracoes;         
	$obj->mapeamentos_decisao = $mapeamentos_decisao;         
	
	if(empty($estrategia)):
		if(estrategias::insert($obj)){
			header('Location: ../../view/adm/estrategia.php?retorno=ok');
		}
		else{
			header('Location: ../../view/adm/estrategia.php?retorno=erro');
		}
	else:
		$obj->id_estrategia = $estrategia->id_estrategia;
		if(estrategias::update($obj)){
			if(!empty($linguagem)):
				linguagens_estrategia::delete($estrategia->id_estrategia);
				foreach ($linguagem as $lingua) {
					$obj_lingua = new stdClass();
					$obj_lingua->id_linguagem = $lingua;
					$obj_lingua->id_estrategia = $estrategia->id_estrategia;
					linguagens_estrategia::insert($obj_lingua);
				}
			endif;
			// if(!empty($categorias_conteudo)):
			// 	categorias_estrategia::delete($estrategia->id_estrategia);
			// 	foreach ($categorias_conteudo as $categ) {
			// 		$obj_categ = new stdClass();
			// 		$obj_categ->id_categoria = $categ;
			// 		$obj_categ->id_estrategia = $estrategia->id_estrategia;
			// 		categorias_estrategia::insert($obj_categ);
			// 	}
			// endif;
			header('Location: ../../view/adm/estrategia.php?retorno=ok');
		}
		else{
			header('Location: ../../view/adm/estrategia.php?retorno=erro');
		}
	endif;

}
else {
	header('Location: ../../view/adm/estrategia.php?retorno=falha1');
}