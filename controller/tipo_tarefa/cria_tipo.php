<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tipo_tarefa.php';

$nome_tarefa = $_POST["nome_tarefa"];
$cor_tarefa = $_POST["cor_tarefa"];
$valor_tipo_tarefa = $_POST["valor_tipo_tarefa"];

$obj = new stdClass();
$obj->nome_tarefa = $nome_tarefa;
$obj->cor_tarefa = $cor_tarefa;
$obj->valor_tipo_tarefa = str_replace(",", ".", $valor_tipo_tarefa);

if (!empty($nome_tarefa) && !empty($cor_tarefa) && !empty($valor_tipo_tarefa)) {
    if (tipo_tarefa::insert($obj)) {
        header('Location: ../../view/adm/tipo_conteudo.php?retorno=ok');
    } else {
        header('Location: ../../view/adm/tipo_conteudo.php?retorno=erro');
    }
} else {
    header('Location: ../../view/adm/tipo_conteudo.php?retorno=empty');
}