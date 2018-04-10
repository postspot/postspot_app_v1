<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';

$id_tarefa = $_POST['id_tarefa'];

//Deveria deletar os log, anexos e comentários
if(tarefas::deletaTarefa($id_tarefa)):   
    echo json_encode("true");
else:
    echo json_encode("false");
endif;
