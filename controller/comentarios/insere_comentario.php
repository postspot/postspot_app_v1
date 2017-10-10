<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/comentarios.php';
session_start();

$comentario = $_POST["comentario"];
$id_usuario = $_SESSION['id_usuario'];
$id_tarefa = $_POST["id_tarefa"];
$equipe = $_POST["equipe"];

if (isset($comentario)) {

    $obj = new stdClass();
    $obj->comentario = $comentario;
    $obj->id_usuario = $id_usuario;
    $obj->id_tarefa = $id_tarefa;
    $obj->equipe = $equipe;
    $obj->status = 1;

    if(comentarios::insert($obj)){
        echo json_encode('true');
    }
    else{
        echo json_encode('false');
    }

}else{
    echo json_encode('false');
}