<?php

function listFiles($dir)
{
    $diretorio = dir($dir);

    $galeria = array();

    while ($arquivo = $diretorio->read()) {
        if ($arquivo != '.' && $arquivo != '..') {
            array_push($galeria, $arquivo);
        }
    }
    $diretorio->close();
    return $galeria;
}

/**
 * Imprime o conteúdo da array ou objeto, dentro da tag pre
 * @access public 
 * @param stdClass $obj_or_array
 * @return void 
 */
function pre_r($obj_or_array)
{

    echo '<pre>';
    print_r($obj_or_array);
    echo '</pre>';
}

function redireciona($url, $alert = null)
{

    $msg = ($alert != null) ? "alert('$alert'); " : '';
    $output = '<script>'
        . $msg
        . 'location.href = "' . $url . '";'
        . '</script>';

    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    echo $output;
}

function validaObj($obj)
{
    $exceptions = array('pontos_reais', 'pontos_bonus', 'cod_categoria_usuario', 'nivel_usuario', 'status', 'complemento');
    $array = (array)$obj;
    $missing = array();
    foreach ($array as $index => $item) :
        if (($item == null || $item == '') && !in_array($index, $exceptions)) :
        array_push($missing, $index);
    endif;
    endforeach;
    return $missing;
}

function remove_caracteres($str)
{
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    //$str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
    $str = preg_replace('/[^a-z0-9]/i', '_', $str);
    $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
    return $str;
}

/**
 * 
 * @param type $date
 * @return string mes por escrito
 */
function mesEscrito($date)
{
    $meses = array(
        '01' => 'Jan',
        '02' => 'Fev',
        '03' => 'Mar',
        '04' => 'Abr',
        '05' => 'Mai',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Ago',
        '09' => 'Set',
        '10' => 'Out',
        '11' => 'Nov',
        '12' => 'Dez'
    );



    $mes = date('m', strtotime($date));

    return $meses[$mes];
}


function funcaoCliente($funcao)
{
    $funcoes = array(
        '0' => 'Analista de Sucesso',
        '1' => 'Analista de Planejamento',
        '2' => 'Redator',
        '3' => 'Cliente',
        '4' => 'Designer',
        '5' => 'Candidato'
    );

    return $funcoes[$funcao];
}

function statusCandidato($funcao)
{
    $funcoes = array(
        '0' => 'Incompleto',
        '1' => 'Inscrito',
        '2' => 'Aceito',
        '3' => 'Negado'
    );

    return $funcoes[$funcao];
}


function dataBRparaPHP($data)
{
    if ($data == null) :
        return null;
    else :
        return date('Y-m-d', strtotime(implode("-", array_reverse(explode("/", $data)))));
    endif;
}
function dataBr($data){
    if ($data == null):
        return null;
    else:
        return date('d/m/Y', strtotime($data));
    endif;
}

function dataBrComTempo($data){
    if ($data == null):
        return null;
    else:
        return date('d/m/Y h:i', strtotime($data));
    endif;
}
function retornaDataPrevista($aux, $tarefa = null)
{
    $date = (empty($tarefa) ? date('Y-m-d H:i') : tarefas::getDateCriacao($tarefa));
    switch ($aux) {
        case 0: // Pauta salva / escrevendo
            return date('Y-m-d H:i:s', strtotime("+3 days", strtotime($date)));
            break;
        case 1: // Pauta enviada para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+4 days", strtotime($date)));
            break;
        case 2: // Pauta enviada para aprovação do cliente
            return date('Y-m-d H:i:s', strtotime("+5 days", strtotime($date)));
            break;
        case 3: // Pauta Reprovada
            return date('Y-m-d H:i:s', strtotime("+5 days", strtotime($date)));
            break;
        case 4: // Ajuste de Pauta
            return date('Y-m-d H:i:s', strtotime("+7 days", strtotime($date)));
            break;
        case 5: // Pauta enviada para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+7 days", strtotime($date)));
            break;
        case 6: // Reaprovando Pauta
            return date('Y-m-d H:i:s', strtotime("+7 days", strtotime($date)));
            break;
        case 7: // Criando conteudo
            return date('Y-m-d H:i:s', strtotime("+11 days", strtotime($date)));
            break;
        case 8: // Conteúdo enviado para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+12 days", strtotime($date)));
            break;
        case 9: // Conteúdo enviado para aprovação
            return date('Y-m-d H:i:s', strtotime("+13 days", strtotime($date)));
            break;
        case 10: // Conteúdo reprovado
            return date('Y-m-d H:i:s', strtotime("+13 days", strtotime($date)));
            break;
        case 11: // Ajustes do conteúdo
            return date('Y-m-d H:i:s', strtotime("+15 days", strtotime($date)));
            break;
        case 12: // Conteúdo enviado para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+15 days", strtotime($date)));
            break;
        case 13: // Reaprovação do conteúdo
            return date('Y-m-d H:i:s', strtotime("+15 days", strtotime($date)));
            break;
        case 14: // Conteúdo para publicar
            return date('Y-m-d H:i:s', strtotime("+17 days", strtotime($date)));
            break;
        case 15: // Conteúdo publicado
            return date('Y-m-d H:i:s', strtotime("+17 days", strtotime($date)));
            break;
        default:
            break;
    }
}

function retornaStatusTarefa($status)
{
    switch ($status) {
        case 0:
            return 'Pauta em produção';
            break;
        case 1:
            return 'Pauta em avaliação'; //
            break;
        case 2:
            return 'Pauta em aprovação'; //
            break;
        case 3:
            return 'Pauta Reprovada'; //
            break;
        case 4:
            return 'Pauta em ajuste';
            break;
        case 5:
            return 'Pauta em avaliação';
            break;
        case 6:
            return 'Pauta em aprovação';
            break;
        case 7:
            return 'Conteúdo em produção';
            break;
        case 8:
            return 'Conteúdo em avaliação'; //
            break;
        case 9:
            return 'Conteúdo em aprovação'; //
            break;
        case 10:
            return 'Conteúdo Reprovado'; //
            break;
        case 11:
            return 'Conteúdo em ajuste';
            break;
        case 12:
            return 'Conteúdo em avaliação';
            break;
        case 13:
            return 'Conteúdo em aprovação';//
            break;
        case 14:
            return 'Conteúdo em publicar';
            break;
        case 15:
            return 'Conteúdo Publicado';//
            break;
        default:
            break;
    }
}

function retornaTextoNotificacaoTarefa($status)
{
    switch ($status) {
        case 0:
            return 'Pauta em produção';
            break;
        case 1:
            return 'Pauta em avaliação';
            break;
        case 2:
            return 'Pauta em aprovação';
            break;
        case 3:
            return 'Pauta Reprovada';
            break;
        case 4:
            return 'Pauta em ajuste';
            break;
        case 5:
            return 'Pauta em avaliação';
            break;
        case 6:
            return 'Pauta reprovada';
            break;
        case 7:
            return 'Conteúdo em produção';
            break;
        case 8:
            return 'Conteúdo em avaliação';
            break;
        case 9:
            return 'Conteúdo em aprovação';
            break;
        case 10:
            return 'Conteúdo Reprovado';
            break;
        case 11:
            return 'Conteúdo em ajuste';
            break;
        case 12:
            return 'Conteúdo em avaliação';
            break;
        case 13:
            return 'Conteúdo em aprovação';
            break;
        case 14:
            return 'Conteúdo em publicar';
            break;
        case 15:
            return 'Conteúdo Publicado';
            break;
        default:
            break;
    }
}

function resetStatusTarefa($tarefa)
{
    log_tarefas::resetStatus($tarefa);
}

function smtpmailer($para, $assunto, $corpo)
{
    if (AMBIENTE_PROD) :
        global $error;
        $mail = new PHPMailer();
        $mail->SetLanguage("br");
        $mail->CharSet = 'UTF-8';
        $mail->IsMail();
        $mail->IsHTML(true);
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;		// Autenticação ativada
        $mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
        $mail->Host = 'smtpi.uni5.net';	// SMTP utilizado
        $mail->Port = '465';  		// A porta 587 deverá estar aberta em seu servidor
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SetFrom(GUSER, APP_NOME);
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        $mail->AddAddress($para);
        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    endif;
}	