<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/categorias.php';

$id_categoria = $_POST["id_categoria"];

if(isset($id_categoria)){
    if(!empty($id_categoria)){
        if(categorias::delete($id_categoria)){
            echo json_encode("true");
        }
        else{
            echo json_encode("erro");
        }
    }
    else{
        echo json_encode("erro");
    }
}
else{
    echo json_encode("erro");
}