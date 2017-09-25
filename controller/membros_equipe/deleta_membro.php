<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/membros_equipe.php';

$id_membro = $_POST["id_membros"];

if(isset($id_membro)){
    if(!empty($id_membro)){
        if(membros_equipe::delete($id_membro)){
            echo json_encode("true");
        }
        else{
            echo json_encode("erro");
        }
    }
    else{
        echo json_encode("erro");
    }
}
else{
    echo json_encode("erro");
}