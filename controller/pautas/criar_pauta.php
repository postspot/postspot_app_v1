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


if (isset($nome_tarefa) && isset($tipo_tarefa) && isset($palavra_chave) && 
    isset($briefing_tarefa) && isset($estagio_compra) && isset($id_persona) &&
    isset($tipo_cta) && isset($referencias) && isset($consideracoes_gerais) && isset($id_projeto)) {

    if (!empty($nome_tarefa) && !empty($tipo_tarefa) && !empty($estagio_compra) &&
    !empty($id_persona) && !empty($tipo_tarefa) && !empty($estagio_compra) && !empty($id_projeto)) {
      
        $obj = new stdClass();
        
        $obj->nome_tarefa = $nome_tarefa;
        
	$obj->palavra_chave = $palavra_chave;
	$obj->briefing_tarefa = $briefing_tarefa;
	$obj->estagio_compra = $estagio_compra;
	$obj->tipo_cta = $tipo_cta;
	$obj->referencias = $referencias;
	$obj->consideracoes_gerais = $consideracoes_gerais;
	$obj->id_persona = $id_persona;
	$obj->id_projeto = $id_projeto;
        $obj->id_tipo = $tipo_tarefa;
	$obj->id_equipe = 1;
        
        $id_tarefa = tarefas::getAutoInc();
//        die();
        
        
        
        if(tarefas::insert($obj)){
            $flag_log = 1;
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');
            for($aux = 0; $aux < 6;$aux ++){
                
                $novo_log = new stdClass();
                $novo_log->status = 0;
                $novo_log->etapa = $aux;
                switch ($aux) {
                    case 0:
                        $novo_log->data_prevista = date('Y-m-d H:i:s', strtotime("+3 days",strtotime($date)));
                        break;
                    case 1:
                        $novo_log->data_prevista = date('Y-m-d H:i:s', strtotime("+5 days",strtotime($date)));
                        break;
                    case 2:
                        $novo_log->data_prevista = date('Y-m-d H:i:s', strtotime("+9 days",strtotime($date)));
                        break;
                    case 3:
                        $novo_log->data_prevista = date('Y-m-d H:i:s', strtotime("+10 days",strtotime($date)));
                        break;
                    case 4:
                        $novo_log->data_prevista = date('Y-m-d H:i:s', strtotime("+12 days",strtotime($date)));
                        break;

                    default:
                        break;
                }
                
                
                $novo_log->data_entregue = "";
                $novo_log->id_tarefa = $id_tarefa;
                $novo_log->id_usuario = $id_usuario;
                
                if(log_tarefas::insert($novo_log)){
                    $flag_log = 1;
                }
                else{
                    $flag_log = 0;
                    header('Location: ../../view/adm/cria_pauta.php?retorno=erro1');
                }
                
            }
            if($flag_log == 1){
                header('Location: ../../view/adm/cria_pauta.php?retorno=ok');
            }
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




