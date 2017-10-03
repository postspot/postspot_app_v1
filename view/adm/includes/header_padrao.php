<?php
require_once '../../model/usuarios.php';
require_once '../../model/projetos.php';
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['HTTP_USER_AGENT'])) {
    if (!isset($_SESSION['nome_usuario']) and ( $_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))) {
        $site = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
        header('location: ../../view/adm/index.php?erro=sessao1');
    }
}else{
    header('location: ../../view/adm/index.php?erro=sessao2');
}
    
if(!isset($_SESSION['id_usuario'])){
    header('location: ../../view/adm/index.php?erro=sessao2');
}

if(isset($_GET["p"])){
    $projeto = projetos::getById($_GET["p"]);
    $_SESSION['id_projeto'] = $projeto->id_projeto;
    $_SESSION['nome_projeto'] = $projeto->nome_projeto;
}