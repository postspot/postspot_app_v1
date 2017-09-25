<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';
require_once '../../model/estrategias.php';
require_once '../../model/equipes.php';

$nome_projeto = $_POST["nome_projeto"];
$responsavel_projeto = $_POST["responsavel_projeto"];
$site_projeto = $_POST["site_projeto"];

if (isset($nome_projeto) && isset($responsavel_projeto) && isset($site_projeto)) {

    if (!empty($nome_projeto) && !empty($responsavel_projeto) && !empty($site_projeto)) {
      
        $obj = new stdClass();
        
        $obj->nome_projeto = $nome_projeto;
	$obj->site_projeto = $site_projeto;       
        $obj->responsavel_projeto = $responsavel_projeto;         

        $id_projeto = projetos::getAutoInc();
        
        if(projetos::insert($obj)){
            
            $nova_estrategia = new stdClass();
//            
//            $nova_estrategia->empresa = "";
//            $nova_estrategia->site = "";
//            $nova_estrategia->projeto = "";
//            $nova_estrategia->blog = "";
//            $nova_estrategia->produtos_servicos = "";
//            $nova_estrategia->links = "";
//            $nova_estrategia->objetivo_primario = "";
//            $nova_estrategia->kpis_primario = "";
//            $nova_estrategia->objetivo_secundario = "";
//            $nova_estrategia->kpis_secundario = "";
//            $nova_estrategia->concorrentes = "";
//            $nova_estrategia->com_quem_falar = "";
//            $nova_estrategia->com_quem_nao_falar = "";
//            $nova_estrategia->abordar = "";
//            $nova_estrategia->evitar = "";
//            $nova_estrategia->linguagem = "";
//            $nova_estrategia->links_ref = "";
//            $nova_estrategia->categorias_conteudo = "";
//            $nova_estrategia->canais = "";
//            $nova_estrategia->acoes = "";
//            $nova_estrategia->consideracoes_gerais = "";
            $nova_estrategia->projetos_id_projeto = $id_projeto;
            
            if(estrategias::insert($nova_estrategia)){         
                
                if(equipes::insert($id_projeto)){
                    header('Location: ../../view/adm/projetos.php?retorno=ok');
                }
                else{
                    header('Location: ../../view/adm/projetos.php?retorno=erro1');
                }
            }
            else{
                header('Location: ../../view/adm/projetos.php?retorno=erro2');
            }
        }
        else{
            header('Location: ../../view/adm/projetos.php?retorno=erro3');
            
        }
    }
    else {
        header('Location: ../../view/adm/projetos.php?retorno=erro4');
    }
} 
else {
    header('Location: ../../view/adm/projetos.php?retorno=erro5');
}





