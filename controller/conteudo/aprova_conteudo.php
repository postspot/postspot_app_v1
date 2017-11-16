<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';
require_once '../../model/tarefas.php';

session_start();
$id_tarefa = $_POST["id_tarefa"];
$id_usuario = $_SESSION['id_usuario'];
$id_tarefa = $_POST["id_tarefa"];
$nota = $_POST["nota_tarefa"];
$equipe = $_SESSION['id_projeto'];

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa); 
    $novo_log_aprovado = new stdClass();
    $novo_log_aprovado->etapa = CONTEUDO_PARA_PUBLICAR;
    $novo_log_aprovado->status = 1;
    $novo_log_aprovado->data_prevista = retornaDataPrevista(CONTEUDO_PARA_PUBLICAR);
    $novo_log_aprovado->id_tarefa = $id_tarefa;
    $novo_log_aprovado->id_usuario = $id_usuario;
    

    if(log_tarefas::insert($novo_log_aprovado)){
        if(tarefas::classificaConteudo($id_tarefa,$nota)){
            header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=apOk');
        }
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
    }
}else{
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
}