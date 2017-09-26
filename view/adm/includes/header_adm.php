<?php
require_once '../../model/usuarios.php';
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
    header('location: ../../view/adm/index.php?erro=sessao3');
}

if( $_SESSION['funcao_usuario'] != 3){
    header('location: ../../view/adm/dashboard.php');
}