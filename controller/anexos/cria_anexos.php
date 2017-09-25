<?php

require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/anexos.php';

$id = filter_input(INPUT_POST, 'cliente', FILTER_VALIDATE_INT);
$usuario = usuarios::getUnicId($id);

$local1 = filter_input(INPUT_POST, 'local_pasta');
$valorErrado = filter_input(INPUT_POST, 'valor');
$valor = str_replace(",", ".", str_replace(".", "", $valorErrado));
$modelo = filter_input(INPUT_POST, 'modelo');
$tipo_pesquisa = $_POST['tipo_pesquisa'];
$valor_pesquisa_errado = $_POST['valor_pesquisa'];
$valor_pesquisa = str_replace(",", ".", str_replace(".", "", $valor_pesquisa_errado));
//pre_r($_POST);
//die();

$local = "../../uploads/" . $id . "-" . $usuario->nome_usuario . $local1;
$erros = 0;
foreach ($_FILES['arquivos']['error'] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {


        $obj = new stdClass();
        $obj->nome_arquivo = $_FILES['arquivos']["name"][$key];
        $obj->id_usuario = $id;
        $obj->tamanho = $_FILES['arquivos']['size'][$key];
        $obj->local = $local1;
        $obj->valor = $valor;
        $obj->modelo = $modelo;
        $obj->tipo = 1;
        $obj->tipo_pesquisa = $tipo_pesquisa;
        $obj->valor_pesquisa = $valor_pesquisa;

        if (arquivos::insert($obj)) {

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
            if ($_FILES['arquivos']['error'][$key] != 0) {
                die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivos']['error'][$key]]);
                exit; // Para a execução do script
            }

            // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
            else {
                // Primeiro verifica se deve trocar o nome do arquivo
                if ($_UP['renomeia'] == true) {
                    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                    $nome_final = time() . '.jpg';
                } else {
                    // Mantém o nome original do arquivo
                    $nome_final = $_FILES['arquivos']['name'][$key];
                }

                // Depois verifica se é possível mover o arquivo para a pasta escolhida
                if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$key], $_UP['pasta'] . $nome_final)) {
                    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
                    //echo "Upload efetuado com sucesso!";
                    //echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
//                    redireciona(SITE . 'view/adm/cria_user.php?resp=file_true');
                } else {
                    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                    $erros++;
                }
            }
        } else {
            redireciona(SITE . 'view/adm/cria_user.php?resp=arquivo_false');
        }
    }
}

if ($erros > 0) {
    redireciona(SITE . 'view/adm/cria_user.php?resp=arquivo_false');
} else {
    redireciona(SITE . 'view/adm/cria_user.php?resp=arquivo_true');
}