<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once '../../model/log_tarefas.php';

session_start();

$nome_tarefa = $_POST["nome_tarefa"];
$tipo_tarefa = $_POST["tipo_tarefa"];
$palavra_chave = $_POST["palavra_chave"];
$briefing_tarefa = $_POST["briefing_tarefa"];
$tipo_cta = $_POST["tipo_cta"];
$referencias = $_POST["referencias"];
$consideracoes_gerais = $_POST["consideracoes_gerais"];
$id_persona = $_POST["id_persona"];
$estagio_compra = $_POST["estagio_compra"];
$id_projeto = $_SESSION['id_projeto'];
$id_usuario = $_SESSION['id_usuario'];
$aprovacao = ($_POST["aprovacao"] == 1) ? 1 : 0;


if (isset($nome_tarefa) && isset($tipo_tarefa) && isset($palavra_chave) && 
    isset($briefing_tarefa) && isset($estagio_compra) && isset($id_persona) &&
    isset($tipo_cta) && isset($referencias) && isset($consideracoes_gerais) && isset($id_projeto)) {

    if (!empty($nome_tarefa) && !empty($tipo_tarefa) && !empty($estagio_compra) &&
    !empty($id_persona) && !empty($tipo_tarefa) && !empty($estagio_compra) && !empty($id_projeto)) {
    
        // Prepara a Tarefa
        $nova_tarefa = new stdClass();
        $nova_tarefa->nome_tarefa = $nome_tarefa;
        $nova_tarefa->palavra_chave = $palavra_chave;
        $nova_tarefa->briefing_tarefa = $briefing_tarefa;
        $nova_tarefa->estagio_compra = $estagio_compra;
        $nova_tarefa->tipo_cta = $tipo_cta;
        $nova_tarefa->referencias = $referencias;
        $nova_tarefa->consideracoes_gerais = $consideracoes_gerais;
        $nova_tarefa->id_persona = $id_persona;
        $nova_tarefa->id_projeto = $id_projeto;
        $nova_tarefa->id_tipo = $tipo_tarefa;
        $nova_tarefa->id_equipe = $id_projeto; // É o mesmo que o projeto porque o ID da equipe é igual 
        $id_tarefa = tarefas::getAutoInc();
        if(tarefas::insert($nova_tarefa)){ // Insere a tarefa
            
            if(!$aprovacao){ // Senão for para aprovação, apenas cria o log de salvo
                $date = date('Y-m-d H:i');
                $novo_log_salvo = new stdClass();
                $novo_log_salvo->etapa = 0;
                $novo_log_salvo->status = 1;
                $novo_log_salvo->data_prevista = retornaDataPrevista(0);
                $novo_log_salvo->id_tarefa = $id_tarefa;
                $novo_log_salvo->id_usuario = $id_usuario;
                if(log_tarefas::insert($novo_log_salvo)){
                    header('Location: ../../view/adm/pautas.php?retorno=nOk');
                }else{
                    header('Location: ../../view/adm/cria_pauta.php?retorno=nErro');
                }
            }else{ // Senão, ja cria dois log´s
                $date = date('Y-m-d H:i');
                $novo_log_salvo = new stdClass();
                $novo_log_salvo->etapa = 0;
                $novo_log_salvo->status = 0;
                $novo_log_salvo->data_prevista = retornaDataPrevista(0);
                $novo_log_salvo->id_tarefa = $id_tarefa;
                $novo_log_salvo->id_usuario = $id_usuario;
                
                $date = date('Y-m-d H:i');
                $novo_log_aprovacao = new stdClass();
                $novo_log_aprovacao->etapa = 1;
                $novo_log_aprovacao->status = 1;
                $novo_log_aprovacao->data_prevista = retornaDataPrevista(1);
                $novo_log_aprovacao->id_tarefa = $id_tarefa;
                $novo_log_aprovacao->id_usuario = $id_usuario;
            
                if(log_tarefas::insert($novo_log_salvo) && log_tarefas::insert($novo_log_aprovacao)){
                    header('Location: ../../view/adm/pautas.php?retorno=naOk');
                }else{
                    header('Location: ../../view/adm/cria_pauta.php?retorno=nErro');
                }
            }
        }else{
            header('Location: ../../view/adm/cria_pauta.php?retorno=nErro');
        }
    }
    else {
        header('Location: ../../view/adm/cria_pauta.php?retorno=nErro');
    }
} 
else {
    header('Location: ../../view/adm/cria_pauta.php?retorno=nErro');
}