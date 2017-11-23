<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';

$uploads_dir = DIR_ROOT.'/uploads/usuarios';

$id_usuario = $_POST["id_usuario"];
//$id_usuario = 26;
//
if (isset($id_usuario)){
    $dados_user = usuarios::getById($id_usuario);
    if (!empty($dados_user)){
        // tem que deletar a foto / habilidades e idioma
        if($dados_user->foto_usuario != 'sem_foto.jpg'){
            unlink($uploads_dir.'/'.$dados_user->foto_usuario);
        }

        if(usuarios::delete($id_usuario)){
            echo json_encode('true');
        }else{
            echo json_encode('false');
        }
    }
    else{
        echo json_encode('false');
    }
}else{
    echo json_encode('false');
}