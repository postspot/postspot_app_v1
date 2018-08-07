<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';

pre_r($_FILES);
pre_r($_POST);
DIE();
$obj = new stdClass();
$obj->id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
$obj->telefone_usuario = filter_input(INPUT_POST, 'telefone_usuario');
$nascimento_usuario = filter_input(INPUT_POST, 'nascimento_usuario');
$obj->nascimento_usuario = dataBRparaPHP($nascimento_usuario);
$obj->estado_candidato = filter_input(INPUT_POST, 'estado_candidato');
$obj->cidade_candidato = filter_input(INPUT_POST, 'cidade_candidato');
$obj->certificacao_candidato = filter_input(INPUT_POST, 'certificacao_candidato');
$obj->linkedin_candidato = filter_input(INPUT_POST, 'linkedin_candidato');
$obj->portifolio_candidato = filter_input(INPUT_POST, 'portifolio_candidato');
$obj->experiencia_candidato = filter_input(INPUT_POST, 'experiencia_candidato');
$obj->producao_candidato = filter_input(INPUT_POST, 'producao_candidato');
$obj->formacao_candidato = filter_input(INPUT_POST, 'formacao_candidato');
$obj->area_estudo_candidato = filter_input(INPUT_POST, 'area_estudo_candidato');
$obj->curso_candidato = filter_input(INPUT_POST, 'curso_candidato');
$obj->profissao_candidato = filter_input(INPUT_POST, 'profissao_candidato');
$obj->ingles_candidato = filter_input(INPUT_POST, 'ingles_candidato');
$obj->espanhol_candidato = filter_input(INPUT_POST, 'espanhol_candidato');
$obj->modalidade_conta_usuario = filter_input(INPUT_POST, 'modalidade_conta_usuario');
$obj->doc_usuario = filter_input(INPUT_POST, 'doc_usuario');
$obj->agencia_usuario = filter_input(INPUT_POST, 'agencia_usuario');
$obj->conta_usuario = filter_input(INPUT_POST, 'conta_usuario');
$obj->banco_usuario = filter_input(INPUT_POST, 'banco_usuario');
$obj->tipo_conta_usuario = filter_input(INPUT_POST, 'tipo_conta_usuario');
$obj->nome_usuario = filter_input(INPUT_POST, 'nome_usuario');
$obj->email_usuario = filter_input(INPUT_POST, 'email_usuario');
$obj->modalidade_candidatos = filter_input(INPUT_POST, 'modalidade_candidatos');
$obj->especialidade_candidatos = filter_input(INPUT_POST, 'especialidade_candidatos');
$obj->motivo_candidatos = filter_input(INPUT_POST, 'motivo_candidatos');
$obj->texto_candidatos = filter_input(INPUT_POST, 'texto_candidatos');
$obj->foto_usuario = (!isset($_FILES['foto_usuario']["name"])) ? '1-avatar-postspot.png' : $_FILES['foto_usuario']["name"];
$obj->status_candidato = 1;

echo 'me ajuda ai';
if (isset($obj->id_usuario)) {
    echo 'me ajuda ai 2';
    $uploads_dir = DIR_ROOT . '/postspot/uploads/usuarios';
    $fotoPadrao = DIR_ROOT . '/postspot/view/adm/assets/img/faces/1-avatar-postspot.png';
    $nomeFotoNova = $uploads_dir . '/' . $obj->id_usuario . '-' . str_replace(' ', '_',$obj->nome_usuario) . '.png';
    echo $obj->foto_usuario;
    if ($obj->foto_usuario == '1-avatar-postspot.png'):
        echo 'Copiar de '. $fotoPadrao;
        echo 'Para '. $nomeFotoNova;
        copy($fotoPadrao, $nomeFotoNova);
    else:
        if ($_FILES['foto_usuario']['error'] != 4) {

            if ($_FILES['foto_usuario']['error'] == UPLOAD_ERR_OK) {
                $obj->foto_usuario = $nomeFotoNova;
                $nome_arquivo = $_FILES['foto_usuario']["name"];
                $ext = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
                if ($ext != 'png' || $ext != 'jpg' || $ext != 'jpeg'):
                    //redireciona(SITE . 'view/adm/registro_detalhes.php?r=arquivo_false&u=' . $obj->id_usuario);
                else:
                    $tmp_name = $_FILES["foto_usuario"]["tmp_name"];
                    move_uploaded_file($tmp_name, $nomeFotoNova);
                endif;
            }
        } else {
            copy($fotoPadrao, $nomeFotoNova);
        }
    endif;
    die();

    if (!empty($obj->id_usuario)) {

        if (usuarios::updatePerfil($obj) && candidatos::update($obj)) {
            //pre_r($_POST);
            //die();
            header('Location: ../../view/adm/boas_vindas.php?r=ok');
        } else {
            //echo 'Error';
            //pre_r($_POST);
            //die();
            header('Location: ../../view/adm/registro.php?retorno=erro');
        }
    } else {
        header('Location: ../../view/adm/registro.php?retorno=erro');
    }
} else {
    header('Location: ../../view/registro.php?retorno=erro');
}
