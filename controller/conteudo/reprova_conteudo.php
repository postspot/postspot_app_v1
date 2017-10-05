<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';

session_start();
$id_tarefa = $_POST["id_tarefa"];
$id_usuario = $_SESSION['id_usuario'];
$id_tarefa = $_POST["id_tarefa"];
$motivo = $_POST["motivo"];

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa); 

    $novo_log_reprovado = new stdClass();
    $novo_log_reprovado->etapa = 7;
    $novo_log_reprovado->status = 0;
    $novo_log_reprovado->data_prevista = retornaDataPrevista(7);
    $novo_log_reprovado->id_tarefa = $id_tarefa;
    $novo_log_reprovado->id_usuario = $id_usuario;

    $log_ajuste = new stdClass();   
    $log_ajuste->etapa = 8;
    $log_ajuste->status = 1;
    $log_ajuste->data_prevista = retornaDataPrevista(8);
    $log_ajuste->id_tarefa = $id_tarefa;
    $log_ajuste->id_usuario = $id_usuario;
    
    $comentario = new stdClass();
    $comentario->comentario = $motivo;
    $comentario->id_tarefa = $id_tarefa;
    $comentario->id_usuario = $id_usuario;
    
    if(log_tarefas::insert($novo_log_reprovado) && log_tarefas::insert($log_ajuste)){
        if(comentarios::insert($comentario)){
            header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=reOk');
        }
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
    }
}else{
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
}