<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/publicacoes.php';

$id_publicacao = $_POST["id_publicacao"];

if (isset($id_publicacao)) {

    $publicacao = publicacoes::retornaPublicacao($id_publicacao);

    echo json_encode($publicacao);

}else{
    echo json_encode('false');
}