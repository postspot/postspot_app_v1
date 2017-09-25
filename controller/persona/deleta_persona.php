<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';

//$id_persona = $_POST["id_persona"];
$id_persona = 1;

if(isset($id_persona)){
    
    if(!empty($id_persona)){
        if(personas::delete($id_persona)){
            echo json_encode("true");
        }
        else{
            echo json_encode("false1");
        }
    }
    else{
        echo json_encode("false2");
    }
}
else{
    echo json_encode("false3");
}