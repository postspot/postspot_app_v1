<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';

session_start();
$id_tarefa = $_POST["id_tarefa"];
$id_usuario = $_SESSION['id_usuario'];
$id_tarefa = $_POST["id_tarefa"];

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa); 
    $novo_log_aprovado = new stdClass();
    $novo_log_aprovado->etapa = 8;
    $novo_log_aprovado->status = 1;
    $novo_log_aprovado->data_prevista = retornaDataPrevista(8);
    $novo_log_aprovado->id_tarefa = $id_tarefa;
    $novo_log_aprovado->id_usuario = $id_usuario;
    if(log_tarefas::insert($novo_log_aprovado)){
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=ok');
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=erro');
    }
}else{
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=erro');
}