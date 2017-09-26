<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/membros_equipe.php';
session_start();

$id_projeto = $_SESSION['id_projeto'];

$usuarios = $_POST["usuarios"];

foreach ($usuarios as $cod_usuario) {
    $novo_usuario = new stdClass();
    $novo_usuario->id_equipe = $id_projeto; 
    $novo_usuario->id_usuario = $cod_usuario; 
    if(!membros_equipe::insert($novo_usuario)):
        header('Location: ../../view/adm/equipe.php?retorno=erro');
    endif;
}

header('Location: ../../view/adm/equipe.php?retorno=ok');