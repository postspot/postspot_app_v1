<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';
require_once '../../model/publicacoes.php';
require_once '../../model/tarefas.php';

session_start();

$texto_publicacao = $_POST["texto_publicacao"];
$id_tarefa = $_POST["id_tarefa"];
$motivo = $_POST["motivo"];
$id_usuario = $_SESSION['id_usuario'];
$equipe = $_SESSION['id_projeto'];
$etapa = $_POST['etapa'];


    // Prepara o conteúdo
$conteudo_texto = new stdClass();
$conteudo_texto->texto_publicacao = $texto_publicacao;
$conteudo_texto->id_tarefa = $id_tarefa;
$conteudo_texto->status_publicacao = 0;

if (publicacoes::insert($conteudo_texto)) {
    if (isset($id_tarefa)) {
        resetStatusTarefa($id_tarefa);
        $novo_log_reprovado = new stdClass();
        $novo_log_reprovado->etapa = CONTEUDO_REPROVADO;
        $novo_log_reprovado->status = 0;
        $novo_log_reprovado->data_prevista = retornaDataPrevista(CONTEUDO_REPROVADO,$id_tarefa);
        $novo_log_reprovado->id_tarefa = $id_tarefa;
        $novo_log_reprovado->id_usuario = $id_usuario;

        $log_ajuste = new stdClass();
        $log_ajuste->etapa = ($etapa == CONTEUDO_APROVACAO_MODERADOR) ? CONTEUDO_ESCREVENDO : CONTEUDO_AJUSTANDO;
        $log_ajuste->status = 1;
        $log_ajuste->data_prevista = retornaDataPrevista($log_ajuste->etapa,$id_tarefa);
        $log_ajuste->id_tarefa = $id_tarefa;
        $log_ajuste->id_usuario = $id_usuario;

        if (!empty($motivo)) {
            $comentario = new stdClass();
            $comentario->comentario = $motivo;
            $comentario->id_tarefa = $id_tarefa;
            $comentario->id_usuario = $id_usuario;
            $comentario->equipe = 1;
            $comentario->status = 1;
            if (!comentarios::insert($comentario)) {
                header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=nErro');
            }
        }

        if (log_tarefas::insert($novo_log_reprovado) && log_tarefas::insert($log_ajuste)) {
            header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=reOk');
        } else {
            header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=erro');
        }
    } else {
        header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=erro');
    }
} else {
    header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=cErro');
}