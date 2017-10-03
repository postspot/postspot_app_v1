<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';

$uploads_dir = DIR_ROOT.'/uploads/usuarios';

$id_usuario = $_POST["id_usuario"];

if (isset($id_usuario)){
    // tem que deletar a foto / habilidades e idioma

    if(usuarios::delete($id_usuario)){
        echo json_encode('true');
    }else{
        echo json_encode('false');
    }
}else{
    echo json_encode('false');
}