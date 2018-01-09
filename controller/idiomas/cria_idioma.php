<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/idiomas.php';

$nome_idioma = $_POST["nome_idioma"];

$obj = new stdClass();
$obj->nome_idioma = $nome_idioma;

if (!empty($nome_idioma)) {
    if (idiomas::insert($obj)) {
        header('Location: ../../view/adm/idiomas.php?retorno=ok');
    } else {
        header('Location: ../../view/adm/idiomas.php?retorno=erro');
    }
} else {
    header('Location: ../../view/adm/idiomas.php?retorno=empty');
}