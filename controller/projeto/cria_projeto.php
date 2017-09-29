<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';
require_once '../../model/estrategias.php';
require_once '../../model/equipes.php';
require_once '../../model/membros_equipe.php';

session_start();

$nome_projeto = $_POST["nome_projeto"];
$responsavel_projeto = $_POST["responsavel_projeto"];
$site_projeto = $_POST["site_projeto"];
$id_usuario = $_SESSION['id_usuario'];

if (isset($nome_projeto) && isset($responsavel_projeto) && isset($site_projeto)) {

    if (!empty($nome_projeto) && !empty($responsavel_projeto) && !empty($site_projeto)) {
      
        $obj = new stdClass();
        
        $obj->nome_projeto = $nome_projeto;
	$obj->site_projeto = $site_projeto;       
        $obj->responsavel_projeto = $responsavel_projeto;         

        $id_projeto = projetos::getAutoInc();
        
        if(projetos::insert($obj)){
            
            $nova_estrategia = new stdClass();
            $nova_estrategia->projetos_id_projeto = $id_projeto;

            if(estrategias::insert($nova_estrategia)){         
                
                $id_equipe = equipes::getAutoInc();
                if(equipes::insert($id_projeto)){
                     $novo_membro = new stdClass();
                     $novo_membro->id_equipe = $id_equipe;
                     $novo_membro->id_usuario = $responsavel_projeto;
                    
                    if(membros_equipe::insert($novo_membro)){
           
                        $novo_membro->id_usuario = $id_usuario;
                        if(membros_equipe::insert($novo_membro)){
                            header('Location: ../../view/adm/projetos.php?retorno=ok');
                        }
                        else{
                            header('Location: ../../view/adm/projetos.php?retorno=erro1');
                        }
                    }
                    else{
                        header('Location: ../../view/adm/projetos.php?retorno=erro1');
                    }
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





