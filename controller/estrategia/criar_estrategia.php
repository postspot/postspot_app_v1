<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/estrategias.php';

$id_projeto = $_POST["id_projeto"];
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
$linguagem = $_POST["linguagem"];
$categorias_conteudo = $_POST["categorias_conteudo"];
$canais = $_POST["canais"];
$acoes = $_POST["acoes"];
$consideracoes_gerais = $_POST["consideracoes_gerais"];

//pre_r($_POST);
//die();


if (isset($id_projeto) && isset($empresa) && isset($site) && isset($projeto) && 
    isset($blog) && isset($produtos_servicos) && isset($links) &&
    isset($concorrentes) && isset($com_quem_falar) && isset($com_quem_nao_falar) 
    && isset($abordar) && isset($evitar) && isset($linguagem)
    && isset($categorias_conteudo) && isset($canais) && isset($acoes) && isset($consideracoes_gerais)) {

    if (!empty($id_projeto) && !empty($empresa) && !empty($projeto)) {
      
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
	$obj->categorias_conteudo = $categorias_conteudo;
	$obj->canais = $canais;
	$obj->acoes = $acoes;
	$obj->consideracoes_gerais = $consideracoes_gerais;
	$obj->projetos_id_projeto = $id_projeto;         
        
        if(estrategias::insert($obj)){
            header('Location: ../../view/adm/estrategia.php?retorno=ok');
        }
        else{
            header('Location: ../../view/adm/estrategia.php?retorno=erro');
            
        }
    }
    else {
        header('Location: ../../view/adm/estrategia.php?retorno=falha1');
    }
} 
else {
    header('Location: ../../view/adm/estrategia.php?retorno=falha2');
}




