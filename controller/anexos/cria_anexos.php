<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/anexos.php';

//pre_r($_FILES);

/*$id_responsavel = $_SESSION["id_usuario"];
$id_projeto = $_SESSION['projeto_usuario'];*/
$id_responsavel = 1;
$id_projeto = 1;
$local = DIR_ROOT."/uploads/projetos/";
$erros = 0;

//die();

foreach ($_FILES['anexos']['error'] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {


        $obj = new stdClass();
        $obj->nome_anexo = $_FILES['anexos']["name"][$key];
        $obj->id_responsavel = $id_responsavel;
        $obj->id_projeto = $id_projeto;        

        if (anexos::insert($obj)) {

            // Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = $local;

            // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
            $_UP['renomeia'] = false;

            // Array com os tipos de erros de upload do PHP
            $_UP['erros'][0] = 'Não houve erro';
            $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
            $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
            $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
            $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

            // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
            if ($_FILES['anexos']['error'][$key] != 0) {
                die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivos']['error'][$key]]);
                exit; // Para a execução do script
            }

            // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
            else {
                $nome_final = $_FILES['anexos']['name'][$key];

                // Depois verifica se é possível mover o arquivo para a pasta escolhida
                if (move_uploaded_file($_FILES['anexos']['tmp_name'][$key], $_UP['pasta'] . $nome_final)) {
                    continue;
                } else {
                    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                    $erros++;
                }
            }
        } else {
           redireciona(SITE . 'view/adm/documentos.php?resp=error');
        }
    }
}

if ($erros > 0) {
    redireciona(SITE . 'view/adm/documentos.php?resp=error');
} else {
    redireciona(SITE . 'view/adm/documentos.php?resp=ok');
}