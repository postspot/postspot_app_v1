<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/membros_equipe.php';
session_start();

$id_projeto = $_SESSION['id_projeto'];

$cod_usuario = $_POST["id_membro"];

$novo_usuario = new stdClass();
$novo_usuario->id_equipe = $id_projeto; 
$novo_usuario->id_usuario = $cod_usuario; 
$resp = membros_equipe::insert($novo_usuario);
if($resp):
    echo json_encode("true");
else:
    echo json_encode("false");
endif;