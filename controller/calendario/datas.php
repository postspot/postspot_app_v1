<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
session_start();

// pre_r($_FILES);

$id_responsavel = $_SESSION["id_usuario"];
$id_projeto = $_SESSION['id_projeto'];

$tarefas = tarefas::getTarefasCalendario($id_projeto);

// echo $id_projeto;
// pre_r($tarefas);
// die();

$events = array();

foreach ($tarefas as $tarefa) :
    // Calcula datas
    //$pautaAvaliacao = date('Y-m-d', strtotime("+4 days", strtotime($tarefa->data_criacao)));
    //$pautaAprovacao = date('Y-m-d', strtotime("+7 days", strtotime($tarefa->data_criacao)));
    $conteudoProducao = date('Y-m-d', strtotime("+11 days", strtotime($tarefa->data_criacao)));
    //$conteudoAvaliacao = date('Y-m-d', strtotime("+12 days", strtotime($tarefa->data_criacao)));
    //$conteudoAprovacao = date('Y-m-d', strtotime("+13 days", strtotime($tarefa->data_criacao)));
    $conteudoPublicacao = date('Y-m-d', strtotime("+17 days", strtotime($tarefa->data_criacao)));

    // seta valores basicos
    $e = array();
    $e['id'] = $tarefa->id_tarefa;
    $e['color'] = '#'.$tarefa->cor_tarefa;
    $e['textColor'] = 'white';
    if($tarefa->etapa > PAUTA_REAPROVACAO_CLIENTE):
        $pagina =  'detalhes_conteudo.php';
        $prefixo = '(C) ';
    else: 
        $prefixo = '(P) ';
        $pagina = 'detalhes_pauta.php';
    endif;
    $e['title'] = $prefixo . $tarefa->nome_tarefa;
    $e['url'] = SITE .'view/adm/'. $pagina . '?t='. $tarefa->id_tarefa;
    $e['allDay'] = false;

    // Insere pauta avaliacao
    //$e['start'] = $pautaAvaliacao;
    //array_push($events, $e);
    
    // Insere pauta aprovacao
    //$e['start'] = $pautaAprovacao;
    //array_push($events, $e);
    
    // Insere conteudo producao
    $e['start'] = $conteudoProducao;
    array_push($events, $e);
    
    // Insere conteudo avaliacao
    //$e['start'] = $conteudoAvaliacao;
    //array_push($events, $e);
    
    // Insere conteudo aprovacao
    //$e['start'] = $conteudoAprovacao;
    //array_push($events, $e);
    
    // Insere conteudo publicacao
    $e['start'] = $conteudoPublicacao;
    array_push($events, $e);



endforeach;

// pre_r($events);
echo json_encode($events);

// if ($erros > 0) {
//     redireciona(SITE . 'view/adm/documentos.php?retorno=error');
// } else {
//     redireciona(SITE . 'view/adm/documentos.php?retorno=ok');
// }