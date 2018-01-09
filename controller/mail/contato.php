<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../lib/phpMailer.php';


$contato = new stdClass();

$contato->nome = "Matheus";
$contato->titulo = "teste com andress";
$contato->data = "11/01/2018";
$contato->id_tarefa = "21";

$assunto = 'Nova pauta para você aprovar';

//    PREPARA AS VARIAVEIS
$param_email = array(
    'nome' => $contato->nome,
    'titulo' => $contato->titulo,
    'data' => $contato->data,
    'id_tarefa' => $contato->id_tarefa
);

//    LINKA + PARAMETROS
$parametros = SITE . 'mail/cliente_pauta.php?' . http_build_query($param_email);
//
$tmp = file_get_contents($parametros);

// echo $tmp;
// die();
$para = "matheuzaum_007@hotmail.com";
smtpmailer($para, $assunto, $tmp);