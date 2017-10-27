<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
session_start();

$id_tarefa = $_POST["id_tarefa"];
$link_publicado = $_POST["link_publicado"];

if (isset($id_tarefa)){
    if(tarefas::atualizaLink($id_tarefa, $link_publicado)){
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=lOk');
    }else{
        header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
    }
}else{
    header('Location: ../../view/adm/detalhes_conteudo.php?t='.$id_tarefa.'&retorno=cErro');
}