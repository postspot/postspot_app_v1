<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/comentarios.php';
session_start();

$id_comentario = $_POST["id_comentario"];

if (isset($id_comentario)) {

    if(comentarios::delete($id_comentario)){
        echo json_encode('true');
    }
    else{
        echo json_encode('false');
    }

}else{
    echo json_encode('false');
}