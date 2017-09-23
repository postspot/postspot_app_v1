<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/idiomas.php';

$id_idioma = $_POST["id_idioma"];

if(isset($id_idioma)){
    if(!empty($id_idioma)){
        if(idiomas::delete($id_idioma)){
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