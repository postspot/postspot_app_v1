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
        '3' => 'Cliente'
    );

    return $funcoes[$funcao];
}


/**
 * 
 * Envia notificação OneSignal para todos registrados
 * @access public 
 * @param type $titulo
 * @param type $mensagem
 * @param type $pagina estabelecimento/listaProd/carrinho/ofertas/pedido
 * @return 0 errado e 1 pra certo
 */
function enviaNotificacao($titulo, $mensagem, $pagina, $codParam, $arrayHash) {
    $msg = array(
        'message' => $mensagem,
        'title' => $titulo,
        'image' => 'www/img/icones/android-icon-48x48.png',
        'vibrate' => 1,
        'sound' => 1,
        'pagina' => $pagina,
        'codParam' => $codParam
    );
    $fields = array(
        'registration_ids' => $arrayHash,
        'data' => $msg
    );
    $headers = array(
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $response = curl_exec($ch);
    curl_close($ch);
    if (strpos($response, 'errors') !== false):
        return 0;
    else:
        return 1;
    endif;
}

function dataBRparaPHP($data) {
    if ($data == null):
        return null;
    else:
        return date('Y-m-d', strtotime(implode("-", array_reverse(explode("/", $data)))));
    endif;
}