<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';
require_once '../../model/estrategias.php';
require_once '../../model/equipes.php';

$nome_projeto = $_POST["nome_projeto"];
$cadastro_projeto = $_POST["cadastro_projeto"];
$site_projeto = $_POST["site_projeto"];

if (isset($nome_projeto) && isset($cadastro_projeto) && isset($site_projeto)) {

    if (!empty($nome_projeto) && !empty($cadastro_projeto) && !empty($site_projeto)) {
      
        $obj = new stdClass();
        
        $obj->nome_projeto = $nome_projeto;
        $obj->cadastro_projeto = $cadastro_projeto;
	$obj->site_projeto = $site_projeto;       
        
        $id_projeto = projetos::getAutoInc();
//	$obj->responsavel_projeto = $responsavel_projeto;         
        
        if(projetos::insert($obj)){
            
            $nova_estrategia = new stdClass();
            $nova_estrategia->projetos_id_projeto = $id_projeto;
            
            if(estrategias::insert($nova_estrategia)){         
                
                if(equipes::insert($id_projeto)){
                    header('Location: ../../view/adm/projetos.php?retorno=ok');
                }
                else{
                    header('Location: ../../view/adm/projetos.php?retorno=erro');
                }
            }
            else{
                header('Location: ../../view/adm/projetos.php?retorno=erro');
            }
        }
        else{
            header('Location: ../../view/adm/projetos.php?retorno=erro');
            
        }
    }
    else {
        header('Location: ../../view/adm/projetos.php?retorno=falha');
    }
} 
else {
    header('Location: ../../view/adm/projetos.php?retorno=falha');
}





