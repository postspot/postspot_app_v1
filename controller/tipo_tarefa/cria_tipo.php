<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tipo_tarefa.php';

$nome_tarefa = $_POST["nome_tarefa"];

$obj = new stdClass();
$obj->nome_tarefa = $nome_tarefa;

if(tipo_tarefa::insert($obj)){
    header('Location: ../../view/adm/tipo_conteudo.php?retorno=ok');
}
else{
    header('Location: ../../view/adm/tipo_conteudo.php?retorno=erro');
}