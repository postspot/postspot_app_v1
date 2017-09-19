<?php
require_once '../../config/config.php';
require_once '../../model/usuarios.php';

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
    if(projetos::getByUsuario($usuario->id_usuario)){
        $_SESSION['projeto_usuario'] = $usuario->id_projeto;
    }
    else{
        $_SESSION['projeto_usuario'] = "";
    }
    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
    
    if ($usuario->funcao_usuario == 1) {
        header('location: ../../view/adm/dashboard.php');
    }
    
}