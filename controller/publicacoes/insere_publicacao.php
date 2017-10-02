<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/publicacoes.php';

$texto_publicacao = $_POST["texto_publicacao"];
$id_tarefa = $_POST["id_tarefa"];

if (isset($texto_publicacao) && isset($id_tarefa)) {

    $obj = new stdClass();
    $obj->texto_publicacao = $texto_publicacao;
    $obj->id_tarefa = $id_tarefa;
    $obj->status_publicacao = 0;

    if(publicacoes::insert($obj)){
        echo json_encode('true');
    }
    else{
        echo json_encode('false');
    }

}else{
    echo json_encode('false');
}