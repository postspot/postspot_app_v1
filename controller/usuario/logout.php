<?php
require_once '../../config/config.php';
session_start();
session_destroy();

setcookie('usuario', '', time()-3600, '/');
setcookie('id_usuario', '', time()-3600, '/');
setcookie('nome_usuario', '', time()-3600, '/');
setcookie('tipo_usuario', '', time()-3600, '/');
setcookie('login_usuario', '', time()-3600, '/');
setcookie('permissao_usuario', '', time()-3600, '/');
setcookie('HTTP_USER_AGENT', '', time()-3600, '/');

header('location: ../../view/adm/index.php');