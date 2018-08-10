<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';

$obj = new stdClass();
$obj->id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
$obj->rede_social_candidato = filter_input(INPUT_POST, 'rede_social_candidato');
$obj->telefone_usuario = filter_input(INPUT_POST, 'telefone_usuario');
$nascimento_usuario = filter_input(INPUT_POST, 'nascimento_usuario');
$obj->nascimento_usuario = dataBRparaPHP($nascimento_usuario);
$obj->estado_candidato = filter_input(INPUT_POST, 'estado_candidato');
$obj->cidade_candidato = filter_input(INPUT_POST, 'cidade_candidato');
$obj->certificacao_candidato = filter_input(INPUT_POST, 'certificacao_candidato');
$obj->linkedin_candidato = filter_input(INPUT_POST, 'linkedin_candidato');
$obj->portifolio_candidato = filter_input(INPUT_POST, 'portifolio_candidato');
$obj->experiencia_candidato = filter_input(INPUT_POST, 'experiencia_candidato');
$array_producao_candidato = $_POST['producao_candidato'];
$obj->producao_candidato = implode(", ", $array_producao_candidato);
$array_especialidade_candidatos = $_POST['especialidade_candidatos'];
$obj->especialidade_candidatos = implode(", ", $array_especialidade_candidatos);
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
$obj->motivo_candidatos = filter_input(INPUT_POST, 'motivo_candidatos');
$obj->texto_candidatos = filter_input(INPUT_POST, 'texto_candidatos');
$obj->status_candidato = 1;



if (isset($obj->id_usuario)) {

    $uploads_dir = DIR_ROOT . '/uploads/usuarios';
    $fotoPadrao = DIR_ROOT . '/view/adm/assets/img/faces/1-avatar-postspot.png';
    $nomeFotoNova = $uploads_dir . '/' . $obj->id_usuario . '-' . str_replace(' ', '_',$obj->nome_usuario) . '.png';
   
    if ($_FILES['foto_usuario']['error'] != 4){
        if($_FILES['foto_usuario']['error'] == UPLOAD_ERR_OK){
            
            $info = pathinfo($_FILES['foto_usuario']["name"]);
            if ($info['extension'] == 'png' || $info['extension'] == 'jpg' || $info['extension'] == 'jpeg'):
                $name = $obj->id_usuario . '-' .remove_caracteres($info['filename']) . '.' . $info['extension'];
                $tmp_name = $_FILES['foto_usuario']["tmp_name"];
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
                $obj->foto_usuario = $name;
            else:
                $obj->foto_usuario = '1-avatar-postspot.png';
            endif;
        }
        else{
            $obj->foto_usuario = '1-avatar-postspot.png';
        }
    }
    else{
        $obj->foto_usuario = '1-avatar-postspot.png';
    }

    if (!empty($obj->id_usuario)) {

        if (usuarios::updatePerfil($obj) && candidatos::update($obj)) {
            //pre_r($_POST);
            //die();
            header('Location: '.SITE.'view/adm/boas_vindas.php?r=ok');
        } else {
            //echo 'Error';
            //pre_r($_POST);
            //die();
            header('Location: '.SITE.'view/adm/registro.php?retorno=erro');
        }
    } else {
        header('Location: '.SITE.'view/adm/registro.php?retorno=erro');
    }
} else {
    header('Location: '.SITE.'view/registro.php?retorno=erro');
}
