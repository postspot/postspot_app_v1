<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';

session_start();

$id_tarefa = $_POST["id_tarefa"];
$motivo = $_POST["motivo"];
$id_usuario = $_SESSION['id_usuario'];
$equipe = $_SESSION['id_projeto'];
$etapa = $_POST['etapa'];

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa);
    $novo_log_reprovado = new stdClass();
    $novo_log_reprovado->etapa = PAUTA_REPROVADA;
    $novo_log_reprovado->status = 0;
    $novo_log_reprovado->data_prevista = retornaDataPrevista(PAUTA_REPROVADA);
    $novo_log_reprovado->id_tarefa = $id_tarefa;
    $novo_log_reprovado->id_usuario = $id_usuario;

    $log_ajuste = new stdClass();
    $log_ajuste->etapa = ($etapa == PAUTA_APROVACAO_MODERADOR) ? PAUTA_ESCREVENDO : PAUTA_AJUSTANDO;
    $log_ajuste->status = 1;
    $log_ajuste->data_prevista = retornaDataPrevista($log_ajuste->etapa);
    $log_ajuste->id_tarefa = $id_tarefa;
    $log_ajuste->id_usuario = $id_usuario;

    if(!empty($motivo)){
        $comentario = new stdClass();
        $comentario->comentario = $motivo;
        $comentario->id_tarefa = $id_tarefa;
        $comentario->id_usuario = $id_usuario;
        $comentario->equipe = 1;
        $comentario->status = 0;
        if(!comentarios::insert($comentario)){
            header('Location: ../../view/adm/detalhes_pauta.php?t='.$id_tarefa.'&retorno=nErro');
        }
    }

    if(log_tarefas::insert($novo_log_reprovado) && log_tarefas::insert($log_ajuste)){
            header('Location: ../../view/adm/pautas.php?retorno=reOk');
    }else{
        header('Location: ../../view/adm/cria_pauta.php?retorno=erro');
    }
}else{
    header('Location: ../../view/adm/cria_pauta.php?retorno=erro');
}