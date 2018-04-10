<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/comentarios.php';
require_once '../../model/membros_equipe.php';
require_once '../../model/tarefas.php';
require_once '../../lib/phpMailer.php';

session_start();
$id_tarefa = $_POST["id_tarefa"];
$id_usuario = $_SESSION['id_usuario'];
$nome_tarefa = $_POST["nome_tarefa"];
$motivo = $_POST["motivo"];
$equipe = $_SESSION['id_projeto'];
$moderadores = membros_equipe::buscarModeradorDaEquipe($_SESSION['id_projeto']);

if (isset($id_tarefa)){
    resetStatusTarefa($id_tarefa); 

    $novo_log_reprovado = new stdClass();
    $novo_log_reprovado->etapa = CONTEUDO_REPROVADO;
    $novo_log_reprovado->status = 0;
    $novo_log_reprovado->data_prevista = retornaDataPrevista(CONTEUDO_REPROVADO,$id_tarefa);
    $novo_log_reprovado->id_tarefa = $id_tarefa;
    $novo_log_reprovado->id_usuario = $id_usuario;

    $log_ajuste = new stdClass();
    $log_ajuste->etapa = CONTEUDO_AJUSTANDO;
    $log_ajuste->status = 1;
    $log_ajuste->data_prevista = retornaDataPrevista(CONTEUDO_APROVACAO_MODERADOR,$id_tarefa);
    $log_ajuste->id_tarefa = $id_tarefa;
    $log_ajuste->id_usuario = $id_usuario;
    
    //Vai enviar email aqui

    $assunto = 'Conteúdo precisa de ajustes no projeto ' . $_SESSION['nome_projeto'] . ' - ' . date("d/m/Y") . ' às ' . date("H:i");
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
    if(!empty($motivo)){
        $comentario = new stdClass();
        $comentario->comentario = $motivo;
        $comentario->id_tarefa = $id_tarefa;
        $comentario->id_usuario = $id_usuario;
        $comentario->equipe = ($_SESSION['funcao_usuario'] == '3') ? 0 : 1;
        $comentario->status = 1;
        if(!comentarios::insert($comentario)){
            header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
        }
    }
    
    if(log_tarefas::insert($novo_log_reprovado) && log_tarefas::insert($log_ajuste)){
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=reOk');
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
    }
}else{
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
}