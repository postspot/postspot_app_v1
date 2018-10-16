<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';

$obj = new stdClass();
$obj->id_usuario = filter_input(INPUT_POST, 'iuser');
$uploads_dir = DIR_ROOT . '/uploads/usuarios';

if ($_FILES['foto_usuario']['error'] != 4) {
    if ($_FILES['foto_usuario']['error'] == UPLOAD_ERR_OK) {

        $info = pathinfo($_FILES['foto_usuario']["name"]);
        if ($info['extension'] == 'png' || $info['extension'] == 'jpg' || $info['extension'] == 'jpeg'):
            $name = $obj->id_usuario . '-' . remove_caracteres($info['filename']) . '.' . $info['extension'];
            $tmp_name = $_FILES['foto_usuario']["tmp_name"];
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $obj->foto_usuario = $name;

            if (usuarios::updateFoto($obj)) {
                echo json_encode('true');
            } else {
                echo json_encode('false');
            } 
        else :
            echo json_encode('false');
        endif;
    } else {
        echo json_encode('false');
    }
} else {
    echo json_encode('false');
}