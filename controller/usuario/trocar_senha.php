<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
session_start();


$id_usuario = $_SESSION['id_usuario'];
$senha_usuario = $_POST["senha_usuario"];


if (!empty($id_usuario) && !empty($senha_usuario)) {
    if(usuarios::trocaSenha($id_usuario, md5($senha_usuario))):
        header('Location: ../../view/adm/perfil.php?retorno=sOk');
    else:
        header('Location: ../../view/adm/perfil.php?retorno=sErro');
    endif;
}else {
    header('Location: ../../view/adm/perfil.php?retorno=sErro');
}