<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';

$nome_projeto = $_POST["nome_projeto"];
$responsavel_projeto = $_POST["responsavel_projeto"];
$site_projeto = $_POST["site_projeto"];

if (isset($nome_projeto) && isset($responsavel_projeto) && isset($site_projeto)) {

    if (!empty($nome_projeto) && !empty($responsavel_projeto) && !empty($site_projeto)) {
      
        $obj = new stdClass();
        
        $obj->nome_projeto = $nome_projeto;
        $obj->site_projeto = $site_projeto;         
        $obj->responsavel_projeto = $responsavel_projeto;         
        
        if(projetos::insert($obj)){
            header('Location: ../../view/adm/projetos.php?retorno=ok');
        }
        else{
            header('Location: ../../view/adm/projetos.php?retorno=erro');
            
        }
    }
    else {
        header('Location: ../../view/adm/projetos.php?retorno=erro');
    }
} 
else {
    header('Location: ../../view/adm/projetos.php?retorno=erro');
}





