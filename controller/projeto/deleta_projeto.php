<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';

$id_projeto = $_POST["id_projeto"];
//$id_projeto = 1;

if(isset($id_projeto)){
    
    if(!empty($id_projeto)){
        if(projetos::delete($id_projeto)){
            echo json_encode("true");
        }
        else{
            echo json_encode("false");
        }
    }
    else{
        echo json_encode("false");
    }
}
else{
    echo json_encode("false");
}