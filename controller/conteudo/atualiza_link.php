<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../lib/phpMailer.php';
require_once '../../model/tarefas.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/membros_equipe.php';
session_start();

$id_tarefa = $_POST["id_tarefa"];
$link_publicado = $_POST["link_publicado"];
$id_usuario = $_SESSION['id_usuario'];
$tarefa = tarefas::getById($id_tarefa);
$clientes = membros_equipe::buscarClientesDaEquipe($_SESSION['id_projeto']);

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa); 
    $novo_log_publicado = new stdClass();
    $novo_log_publicado->etapa = CONTEUDO_PUBLICADO;
    $novo_log_publicado->status = 1;
    $novo_log_publicado->data_prevista = retornaDataPrevista(CONTEUDO_PARA_PUBLICAR,$id_tarefa);
    $novo_log_publicado->id_tarefa = $id_tarefa;
    $novo_log_publicado->id_usuario = $id_usuario;

    //Vai enviar email aqui

    $assunto = 'Conteúdo publicado';
    foreach ($clientes as $cliente) :
        //    PREPARA AS VARIAVEIS
        $param_email = array(
            'nome' => $cliente->nome_usuario,
            'titulo' => $tarefa->nome_tarefa,
            'projeto' => $_SESSION['nome_projeto'],
            'link' => $link_publicado
        );

        //    LINKA + PARAMETROS
        $parametros = SITE . 'mail/conteudo_publicado.php?' . http_build_query($param_email);

        // VARIAVEIS
        $para = $cliente->email_usuario;
        $tmp = file_get_contents($parametros);
        smtpmailer($para, $assunto, $tmp);
    endforeach;
    if(log_tarefas::insert($novo_log_publicado)){
        if(tarefas::atualizaLink($id_tarefa, $link_publicado)){
            header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=lOk');
        }
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
    }
}else{
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
}