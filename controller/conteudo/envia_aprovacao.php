<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/publicacoes.php';
session_start();

$texto_publicacao = $_POST["texto_publicacao"];
$id_tarefa = $_POST["id_tarefa"];
$id_usuario = $_SESSION['id_usuario'];
$aprovacao = $_POST["aprovacao"];
$etapa = $_POST['etapa'];


if (!empty($id_tarefa) && !empty($texto_publicacao)) {
    
    // Prepara o conteúdo
    $conteudo_texto = new stdClass();
    $conteudo_texto->texto_publicacao = $texto_publicacao;
    $conteudo_texto->id_tarefa = $id_tarefa;
    $conteudo_texto->status_publicacao = 0;

    if(publicacoes::insert($conteudo_texto)){ // Insere a tarefa
        
        resetStatusTarefa($id_tarefa);    
        if($aprovacao == '0'){ // apenas cria o log de salvo
            $nova_etapa = ($etapa == CONTEUDO_ESCREVENDO) ? CONTEUDO_ESCREVENDO : CONTEUDO_AJUSTANDO;
            $novo_log_conteudo = new stdClass();
            $novo_log_conteudo->etapa = $nova_etapa;
            $novo_log_conteudo->status = 1;
            $novo_log_conteudo->data_prevista = retornaDataPrevista($nova_etapa);
            $novo_log_conteudo->id_tarefa = $id_tarefa;
            $novo_log_conteudo->id_usuario = $id_usuario;
            if(log_tarefas::insert($novo_log_conteudo)){
                header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=nOk');
            }else{
                header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
            }
        }else if($aprovacao == '1'){ // Pode enviar para aprovação do cliente            
            $novo_log_aprovacao = new stdClass();
            $novo_log_aprovacao->etapa = CONTEUDO_APROVACAO_CLIENTE;
            $novo_log_aprovacao->status = 1;
            $novo_log_aprovacao->data_prevista = retornaDataPrevista(CONTEUDO_APROVACAO_CLIENTE);
            $novo_log_aprovacao->id_tarefa = $id_tarefa;
            $novo_log_aprovacao->id_usuario = $id_usuario;
        
            if(log_tarefas::insert($novo_log_aprovacao)){
                header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=naOk');
            }else{
                header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
            }
        }else if($aprovacao == '2'){ // Pode enviar para aprovação do Moderador
            
            $novo_log_aprovacao = new stdClass();
            $novo_log_aprovacao->etapa = CONTEUDO_APROVACAO_MODERADOR;
            $novo_log_aprovacao->status = 1;
            $novo_log_aprovacao->data_prevista = retornaDataPrevista(CONTEUDO_APROVACAO_MODERADOR);
            $novo_log_aprovacao->id_tarefa = $id_tarefa;
            $novo_log_aprovacao->id_usuario = $id_usuario;
        
            if(log_tarefas::insert($novo_log_aprovacao)){
                header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=naOk');
            }else{
                header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
            }
        }
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
    }
} 
else {
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
}