<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tipo_tarefa.php';

$id_tipo = $_POST["id_tipo"];

if(isset($id_tipo)){
    if(!empty($id_tipo)){
        if(tipo_tarefa::delete($id_tipo)){
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