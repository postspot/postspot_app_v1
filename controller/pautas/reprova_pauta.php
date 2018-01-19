<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';
require_once '../../model/membros_equipe.php';
require_once '../../lib/phpMailer.php';

session_start();

$id_tarefa = $_POST["id_tarefa"];
$motivo = $_POST["motivo"];
$id_usuario = $_SESSION['id_usuario'];
$nome_tarefa = $_POST['nome_tarefa'];
$moderadores = membros_equipe::buscarModeradorDaEquipe($_SESSION['id_projeto']);

if (isset($id_tarefa)) {
    resetStatusTarefa($id_tarefa);
    $novo_log_reprovado = new stdClass();
    $novo_log_reprovado->etapa = PAUTA_REPROVADA;
    $novo_log_reprovado->status = 0;
    $novo_log_reprovado->data_prevista = retornaDataPrevista(PAUTA_REPROVADA);
    $novo_log_reprovado->id_tarefa = $id_tarefa;
    $novo_log_reprovado->id_usuario = $id_usuario;

    $log_ajuste = new stdClass();
    $log_ajuste->etapa = PAUTA_AJUSTANDO;
    $log_ajuste->status = 1;
    $log_ajuste->data_prevista = retornaDataPrevista(PAUTA_AJUSTANDO);
    $log_ajuste->id_tarefa = $id_tarefa;
    $log_ajuste->id_usuario = $id_usuario;
    
    //Vai enviar email aqui

    $assunto = 'Pauta reprovada no projeto ' . $_SESSION['nome_projeto'] . ' - ' . date("d/m/Y") . ' às ' . date("H:i");
    foreach ($moderadores as $moderador) :
        //    PREPARA AS VARIAVEIS
        $param_email = array(
            'nome' => $moderador->nome_usuario,
            'titulo' => $nome_tarefa,
            'projeto' => $_SESSION['nome_projeto'],
            'data' => date("d/m/Y", strtotime($log_ajuste->data_prevista)),
            'id_tarefa' => $id_tarefa
        );

        //    LINKA + PARAMETROS
        $parametros = SITE . 'mail/pauta_reprovada.php?' . http_build_query($param_email);

        // VARIAVEIS
        $para = $moderador->email_usuario;
        $tmp = file_get_contents($parametros);
        smtpmailer($para, $assunto, $tmp);
    endforeach;

    if (!empty($motivo)) {
        $comentario = new stdClass();
        $comentario->comentario = $motivo;
        $comentario->id_tarefa = $id_tarefa;
        $comentario->id_usuario = $id_usuario;
        $comentario->equipe = ($_SESSION['funcao_usuario'] == '3') ? 0 : 1;
        $comentario->status = 0;
        if (!comentarios::insert($comentario)) {
            header('Location: ../../view/adm/detalhes_pauta.php?t=' . $id_tarefa . '&retorno=nErro');
        }
    }

    if (log_tarefas::insert($novo_log_reprovado) && log_tarefas::insert($log_ajuste)) {
        header('Location: ../../view/adm/pautas.php?retorno=reOk');
    } else {
        header('Location: ../../view/adm/detalhes_pauta.php?retorno=erro');
    }
} else {
    header('Location: ../../view/adm/detalhes_pauta.php?retorno=erro');
}