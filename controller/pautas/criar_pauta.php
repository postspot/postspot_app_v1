<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';

$nome_tarefa = $_POST["nome_tarefa"];
$tipo_tarefa = $_POST["tipo_tarefa"];
$palavra_chave = $_POST["palavra_chave"];
$briefing_tarefa = $_POST["briefing_tarefa"];
$tipo_cta = $_POST["tipo_cta"];
$referencias = $_POST["referencias"];
$consideracoes_gerais = $_POST["consideracoes_gerais"];
$id_persona = $_POST["id_persona"];
$estagio_compra = $_POST["estagio_compra"];
$id_projeto = $_POST["id_projeto"];


if (isset($nome_tarefa) && isset($tipo_tarefa) && isset($palavra_chave) && 
    isset($briefing_tarefa) && isset($estagio_compra) && isset($id_persona) &&
    isset($tipo_cta) && isset($referencias) && isset($consideracoes_gerais) && isset($id_projeto)) {

    if (!empty($nome_tarefa) && !empty($tipo_tarefa) && !empty($estagio_compra) &&
    !empty($id_persona) && !empty($tipo_tarefa) && !empty($estagio_compra) && !empty($id_projeto)) {
      
        $obj = new stdClass();
        
        $obj->nome_tarefa = $nome_tarefa;
        $obj->tipo_tarefa = $tipo_tarefa;
	$obj->palavra_chave = $palavra_chave;
	$obj->briefing_tarefa = $briefing_tarefa;
	$obj->estagio_compra = $estagio_compra;
	$obj->tipo_cta = $tipo_cta;
	$obj->referencias = $referencias;
	$obj->consideracoes_gerais = $consideracoes_gerais;
	$obj->id_persona = $id_persona;
	$obj->id_projeto = $id_projeto;
	$obj->id_equipe = 1;
         
        if(tarefas::insert($obj)){
            header('Location: ../../view/adm/cria_pauta.php?retorno=ok');
        }
        else{
            header('Location: ../../view/adm/cria_pauta.php?retorno=erro');
            
        }
    }
    else {
        header('Location: ../../view/adm/cria_pauta.php?retorno=falha');
    }
} 
else {
    header('Location: ../../view/adm/cria_pauta.php?retorno=falha');
}




