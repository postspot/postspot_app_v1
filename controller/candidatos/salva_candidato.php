<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';  

$obj = new stdClass();
$obj->id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
$obj->rede_social_candidato = filter_input(INPUT_POST, 'rede_social_candidato');
$obj->razao_social_candidato = filter_input(INPUT_POST, 'razao_social_candidato');
$obj->telefone_usuario = filter_input(INPUT_POST, 'telefone_usuario');
$obj->cnpj_candidato = filter_input(INPUT_POST, 'cnpj_candidato');
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
$obj->digito_verificador_usuario = filter_input(INPUT_POST, 'digito_verificador_usuario');
$obj->banco_usuario = filter_input(INPUT_POST, 'banco_usuario');
$obj->tipo_conta_usuario = filter_input(INPUT_POST, 'tipo_conta_usuario');
$obj->nome_usuario = filter_input(INPUT_POST, 'nome_usuario');
$obj->email_usuario = filter_input(INPUT_POST, 'email_usuario');
$obj->motivo_candidatos = filter_input(INPUT_POST, 'motivo_candidatos');
$obj->texto_candidatos = filter_input(INPUT_POST, 'texto_candidatos');

if (isset($obj->id_usuario)) {

    if (!empty($obj->id_usuario)) {

        if (usuarios::updatePerfil($obj) && candidatos::update($obj)) {
            echo json_encode('true');
        } else {
            echo json_encode('false1');
        }
    } else {
        echo json_encode('false2');
    }
} else {
    echo json_encode('false3');
}
