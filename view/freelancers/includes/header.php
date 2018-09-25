<?php
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION['HTTP_USER_AGENT'])) {
    if (!isset($_SESSION['nome_usuario']) && ( $_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))) {
        header('location: ' . SITE . 'view/freelancers/inscricao.php?erro=sessao3');
    }
}else{
    header('location: ' . SITE . 'view/freelancers/inscricao.php?erro=sessao2');
}
    
    
if(!isset($_SESSION['id_usuario']) ){
    header('location: ' . SITE . 'view/freelancers/inscricao.php?erro=sessao');
}