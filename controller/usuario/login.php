<?php
require_once '../../config/config.php';
require_once '../../model/usuarios.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';

session_start();

$login_usuario = '';
$senha_usuario = '';

if (isset($_POST['campo_login']) && isset($_POST['campo_senha'])) {
    $login_usuario = $_POST['campo_login'];
    $senha_usuario = $_POST['campo_senha'];
}
else{
    session_destroy();
    header('location: ../../view/adm/index.php?erro=loginerror');
}

$usuario = usuarios::login($login_usuario, md5($senha_usuario));

if ($usuario == null) {
    session_destroy();
    header('location: ../../view/adm/index.php?erro=loginerror');
} 

else {
    $_SESSION['id_usuario'] = $usuario->id_usuario;
    $_SESSION['funcao_usuario'] = $usuario->funcao_usuario;
    $_SESSION['nome_usuario'] = $usuario->nome_usuario;
    $_SESSION['foto_usuario'] = $usuario->foto_usuario;
    
    if ($usuario->funcao_usuario == 0) {
        $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
        header('location: ../../view/adm/lista_projetos.php');
    }else{
        $projeto = projetos::getByUsuario($usuario->id_usuario);
        /*pre_r($projeto);
        die();*/
        if ( empty($projeto)  ||  $projeto == "" ||  $projeto == NULL){
            header('location: ../../view/adm/index.php?erro=sessao4');
        }else{
            $_SESSION['id_projeto'] = $projeto->id_projeto;
            $_SESSION['nome_projeto'] = $projeto->nome_projeto;
            $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
            header('location: ../../view/adm/dashboard.php');
        }
    }
    
}
