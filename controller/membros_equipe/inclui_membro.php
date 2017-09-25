<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/membros_equipe.php';

pre_r($_POST);

$id_projeto = 1;

$usuarios = $_POST["usuarios"];

foreach ($usuarios as $cod_usuario) {
    $novo_usuario = new stdClass();
    $novo_usuario->id_equipe = $id_projeto; 
    $novo_usuario->id_usuario = $cod_usuario; 
    if(!membros_equipe::insert($novo_usuario)):
        echo 'erro';
    endif;
}
