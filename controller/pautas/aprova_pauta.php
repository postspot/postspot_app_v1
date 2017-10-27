<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';

session_start();

$id_tarefa = $_POST["id_tarefa"];
$motivo = $_POST["motivo"];
$id_usuario = $_SESSION['id_usuario'];

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa);
    $novo_log_aprovado = new stdClass();
    $novo_log_aprovado->etapa = 5;
    $novo_log_aprovado->status = 1;
    $novo_log_aprovado->data_prevista = retornaDataPrevista(5);
    $novo_log_aprovado->id_tarefa = $id_tarefa;
    $novo_log_aprovado->id_usuario = $id_usuario;
    

    if(!empty($motivo)){
        $comentario = new stdClass();
        $comentario->comentario = $motivo;
        $comentario->id_tarefa = $id_tarefa;
        $comentario->id_usuario = $id_usuario;
        $comentario->equipe = ($_SESSION['funcao_usuario'] == '3') ? 0 : 1;
        $comentario->status = 0;
        if(!comentarios::insert($comentario)){
            header('Location: ../../view/adm/detalhes_pauta.php?t='.$id_tarefa.'&retorno=nErro');
        }
        
    }
    if(log_tarefas::insert($novo_log_aprovado)){
        header('Location: ../../view/adm/pautas.php?retorno=apOk');
    }else{
        header('Location: ../../view/adm/detalhes_pauta.php?t='.$id_tarefa.'&retorno=nErro');
    }
}else{
    header('Location: ../../view/adm/detalhes_pauta.php?t='.$id_tarefa.'&retorno=nErro');
}