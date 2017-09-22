<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/habilidades.php';

$id_habilidade = $_POST["id_habilidade"];

if(isset($id_habilidade)){
    if(!empty($id_habilidade)){
        if(habilidades::delete($id_habilidade)){
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






