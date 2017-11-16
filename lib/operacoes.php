<?php

function listFiles($dir) {
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
function pre_r($obj_or_array) {

    echo '<pre>';
    print_r($obj_or_array);
    echo '</pre>';
}

function redireciona($url, $alert = null) {

    $msg = ($alert != null) ? "alert('$alert'); " : '';
    $output = '<script>'
            . $msg
            . 'location.href = "' . $url . '";'
            . '</script>';

    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    echo $output;
}

function validaObj($obj) {
    $exceptions = array('pontos_reais', 'pontos_bonus', 'cod_categoria_usuario', 'nivel_usuario', 'status', 'complemento');
    $array = (array) $obj;
    $missing = array();
    foreach ($array as $index => $item):
        if (($item == null || $item == '') && !in_array($index, $exceptions)):
            array_push($missing, $index);
        endif;
    endforeach;
    return $missing;
}

function remove_caracteres($string) {

    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', ' ');
    $b = array('a', 'a', 'a', 'a', 'a', 'a', 'AE', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'h', 'h', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'IJ', 'ij', 'j', 'j', 'k', 'k', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'OE', 'oe', 'r', 'r', 'r', 'r', 'r', 'r', 's', 's', 's', 's', 's', 's', 's', 's', 't', 't', 't', 't', 't', 't', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'w', 'y', 'y', 'y', 'z', 'z', 'z', 'z', 'z', 'z', 's', 'f', 'o', 'o', 'u', 'u', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'a', 'a', 'AE', 'ae', 'o', 'o', '-');

    $str = strtolower(str_replace($a, $b, $string));

    return $str;
}

/**
 * 
 * @param type $date
 * @return string mes por escrito
 */
function mesEscrito($date) {
    $meses = array('01' => 'Jan',
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


function funcaoCliente($funcao){
    $funcoes = array('0' => 'Gerente de Projeto',
        '1' => 'Analista',
        '2' => 'Redator',
        '3' => 'Cliente',
        '4' => 'Designer'
    );

    return $funcoes[$funcao];
}


function dataBRparaPHP($data) {
    if ($data == null):
        return null;
    else:
        return date('Y-m-d', strtotime(implode("-", array_reverse(explode("/", $data)))));
    endif;
}

function retornaDataPrevista($aux){
    $date = date('Y-m-d H:i');
    switch ($aux) {
        case 0: // Pauta salva / escrevendo
            return date('Y-m-d H:i:s', strtotime("+3 days",strtotime($date)));
            break;
        case 1: // Pauta enviada para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+3 days",strtotime($date)));
            break;
        case 2: // Pauta enviada para aprovação do cliente
            return date('Y-m-d H:i:s', strtotime("+5 days",strtotime($date)));
            break;
        case 3: // Pauta Reprovada
            return date('Y-m-d H:i:s', strtotime("+5 days",strtotime($date)));
            break;
        case 4: // Ajuste de Pauta
            return date('Y-m-d H:i:s', strtotime("+7 days",strtotime($date)));
            break;
        case 5: // Pauta enviada para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+7 days",strtotime($date)));
            break;
        case 6: // Reaprovando Pauta
            return date('Y-m-d H:i:s', strtotime("+7 days",strtotime($date)));
            break;
        case 7: // Criando conteudo
            return date('Y-m-d H:i:s', strtotime("+11 days",strtotime($date)));
            break;
        case 8: // Conteúdo enviado para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+11 days",strtotime($date)));
            break;
        case 9: // Conteúdo enviado para aprovação
            return date('Y-m-d H:i:s', strtotime("+13 days",strtotime($date)));
            break;
        case 10: // Conteúdo reprovado
            return date('Y-m-d H:i:s', strtotime("+13 days",strtotime($date)));
            break;
        case 11: // Ajustes do conteúdo
            return date('Y-m-d H:i:s', strtotime("+15 days",strtotime($date)));
            break;
        case 12: // Conteúdo enviado para aprovação do moderador
            return date('Y-m-d H:i:s', strtotime("+15 days",strtotime($date)));
            break;
        case 13: // Reaprovação do conteúdo
        return date('Y-m-d H:i:s', strtotime("+15 days",strtotime($date)));
            break;
        case 14: // Conteúdo para publicar
            return date('Y-m-d H:i:s', strtotime("+17 days",strtotime($date)));
            break;
        case 15: // Conteúdo publicado
            return date('Y-m-d H:i:s', strtotime("+17 days",strtotime($date)));
            break;
        default:
            break;
    }
}

function retornaStatusTarefa($status){
    switch ($status) {
        case 0: 
            return 'Escrevendo';
            break;
        case 1: 
            return 'Aguardando Aprovação Moderador';
            break;
        case 2: 
            return 'Aguardando Aprovação Cliente';
            break;
        case 3: 
            return 'Pauta Reprovada';
            break;
        case 4: 
            return 'Ajustando Pauta';
            break;
        case 5: 
            return 'Reaprovação do moderador';
            break;
        case 6: 
            return 'Reaprovando Pauta';
            break;
        case 7: 
            return 'Criando Conteúdo';
            break;
        case 8: 
            return 'Aguardando Aprovação Moderador';
            break;
        case 9: 
            return 'Aguardando Aprovação Cliente';
            break;
        case 10: 
            return 'Conteúdo Reprovado';
            break;
        case 11: 
            return 'Ajustando Conteúdo';
            break;
        case 12: 
            return 'Aguardando Aprovação Moderador';
            break;
        case 13: 
            return 'Aprovação Final';
            break;
        case 14: 
            return 'Conteúdo para Publicar';
            break;
        case 15: 
            return 'Conteúdo Publicado';
            break;
        default:
            break;
    }
}

function resetStatusTarefa($tarefa){
    log_tarefas::resetStatus($tarefa);
}