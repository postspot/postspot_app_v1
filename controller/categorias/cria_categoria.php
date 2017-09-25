<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/categorias.php';

$nome_categoria = $_POST["nome_categoria"];

$obj = new stdClass();
$obj->nome_categoria = $nome_categoria;

if(categorias::insert($obj)){
    header('Location: ../../view/adm/categorias.php?retorno=ok');
}
else{
    header('Location: ../../view/adm/categorias.php?retorno=erro');
}