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
$aprovacao = ($_POST["aprovacao"] == 1) ? 1 : 0;
$etapa = $_POST['etapa'];


if (!empty($id_tarefa) && !empty($texto_publicacao)) {
    
    // Prepara o conteúdo
    $conteudo_texto = new stdClass();
    $conteudo_texto->texto_publicacao = $texto_publicacao;
    $conteudo_texto->id_tarefa = $id_tarefa;
    $conteudo_texto->status_publicacao = 0;

    if(publicacoes::insert($conteudo_texto)){ // Insere a tarefa
        
        resetStatusTarefa($id_tarefa);    
        if(!$aprovacao){ // Senão for para aprovação, apenas cria o log de salvo
            $nova_etapa = ($etapa == 5) ? 5 : 8;
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
        }else{ // Senão, ja cria dois log´s
            $nova_etapa = ($etapa == 5) ? 6 : 9;
            $novo_log_conteudo = new stdClass();
            $novo_log_conteudo->etapa = 5;
            $novo_log_conteudo->status = 0;
            $novo_log_conteudo->data_prevista = retornaDataPrevista(5);
            $novo_log_conteudo->id_tarefa = $id_tarefa;
            $novo_log_conteudo->id_usuario = $id_usuario;
            
            $novo_log_aprovacao = new stdClass();
            $novo_log_aprovacao->etapa = $nova_etapa;
            $novo_log_aprovacao->status = 1;
            $novo_log_aprovacao->data_prevista = retornaDataPrevista($nova_etapa);
            $novo_log_aprovacao->id_tarefa = $id_tarefa;
            $novo_log_aprovacao->id_usuario = $id_usuario;
        
            if(log_tarefas::insert($novo_log_conteudo) && log_tarefas::insert($novo_log_aprovacao)){
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