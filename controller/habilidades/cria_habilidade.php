<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/habilidades.php';

$nome_habilidade = $_POST["nome_habilidade"];

$obj = new stdClass();
$obj->nome_habilidade = $nome_habilidade;

if (!empty($nome_habilidade)) {
    if (habilidades::insert($obj)) {
        header('Location: ../../view/adm/habilidades.php?retorno=ok');
    } else {
        header('Location: ../../view/adm/habilidades.php?retorno=erro');
    }
} else {
    header('Location: ../../view/adm/habilidades.php?retorno=empty');
}