<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/anexos.php';
session_start();

//pre_r($_FILES);

$id_anexo = $_POST['id_anexo'];
$nome_anexo = $_POST['nome_anexo'];
$id_responsavel = $_SESSION["id_usuario"];
$id_projeto = $_SESSION['id_projeto'];
$local = DIR_ROOT."/uploads/projetos/".$id_projeto."-arquivos";

if (anexos::delete($id_anexo)) {
    unlink("$local/$nome_anexo");
    echo json_encode('true');
}else{
    echo json_encode('false');
}
//pre_r($_FILES);
//die();