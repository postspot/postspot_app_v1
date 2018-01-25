<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../lib/phpMailer.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';
require_once '../../model/tarefas.php';
require_once '../../model/membros_equipe.php';

session_start();
$id_tarefa = $_POST["id_tarefa"];
$id_usuario = $_SESSION['id_usuario'];
$nota = $_POST["nota_tarefa"];
$equipe = $_SESSION['id_projeto'];
$tarefa = tarefas::getById($id_tarefa);
$clientes = membros_equipe::buscarClientesDaEquipe($_SESSION['id_projeto']);
$moderadores = membros_equipe::buscarModeradorDaEquipe($_SESSION['id_projeto']);

if (isset($id_tarefa)) {
    resetStatusTarefa($id_tarefa);
    $novo_log_aprovado = new stdClass();
    $novo_log_aprovado->etapa = CONTEUDO_PARA_PUBLICAR;
    $novo_log_aprovado->status = 1;
    $novo_log_aprovado->data_prevista = retornaDataPrevista(CONTEUDO_PARA_PUBLICAR,$id_tarefa);
    $novo_log_aprovado->id_tarefa = $id_tarefa;
    $novo_log_aprovado->id_usuario = $id_usuario;
    

    //Vai enviar email aqui

    $assunto = 'Conteúdo aprovado';
    foreach ($clientes as $cliente) :
        //    PREPARA AS VARIAVEIS
    $param_email = array(
        'nome' => $cliente->nome_usuario,
        'titulo' => $tarefa->nome_tarefa,
        'projeto' => $_SESSION['nome_projeto'],
        'aprovador' => $_SESSION['nome_usuario']
    );

        //    LINKA + PARAMETROS
    $parametros = SITE . 'mail/conteudo_aprovado.php?' . http_build_query($param_email);

        // VARIAVEIS
    $para = $cliente->email_usuario;
    $tmp = file_get_contents($parametros);
    smtpmailer($para, $assunto, $tmp);
    endforeach;

    $assunto = 'Conteúdo para publicar no projeto ' . $_SESSION['nome_projeto'] . ' - ' . date("d/m/Y") . ' às ' . date("H:i");
    foreach ($moderadores as $moderador) :
        //    PREPARA AS VARIAVEIS
    $param_email = array(
        'nome' => $moderador->nome_usuario,
        'titulo' => $tarefa->nome_tarefa,
        'projeto' => $_SESSION['nome_projeto'],
        'data' => date("d/m/Y", strtotime($novo_log_aprovado->data_prevista)),
        'id_tarefa' => $id_tarefa
    );

        //    LINKA + PARAMETROS
    $parametros = SITE . 'mail/conteudo_para_publicar.php?' . http_build_query($param_email);

        // VARIAVEIS
    $para = $moderador->email_usuario;
    $tmp = file_get_contents($parametros);
    smtpmailer($para, $assunto, $tmp);
    endforeach;
    if (log_tarefas::insert($novo_log_aprovado)) {
        if (tarefas::classificaConteudo($id_tarefa, $nota)) {
            header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=apOk');
        }
    } else {
        header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=cErro');
    }
} else {
    header('Location: ../../view/adm/detalhes_conteudo.php?t=' . $id_tarefa . '&retorno=cErro');
}