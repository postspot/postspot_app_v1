<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';

$nome_usuario = $_POST["nome_usuario"];
$sobrenome_usuario = $_POST["sobrenome_usuario"];
$funcao_usuario = 5;
$email_usuario = $_POST["email_usuario"];
$senha_usuario = $_POST["senha_usuario"];

$checkUsuario = usuarios::getByEmail($email_usuario);

if(!isset($checkUsuario)){
    if (isset($nome_usuario) && isset($email_usuario) && isset($senha_usuario)) {

        if (!empty($nome_usuario)) {
    
            $obj = new stdClass();
    
            $obj->nome_usuario = $nome_usuario;
            $obj->sobrenome_usuario = $sobrenome_usuario;
            $obj->funcao_usuario = $funcao_usuario;
            $obj->email_usuario = $email_usuario;
            $obj->senha_usuario = md5($senha_usuario);
            $obj->obs = '';
            $obj->status_candidato = 0;
    
            $obj->id_usuario = usuarios::getAutoInc();
                
            if (usuarios::insert($obj) && candidatos::insert($obj)) {
                header('Location: ../../view/redator/registro_detalhes.php?r=ok&u=' . $obj->id_usuario);
            } else {
                header('Location: ../../view/redator/registro.php?retorno=erro');
            }
        } else {
            header('Location: ../../view/redator/registro.php?retorno=erro');
        }
    } else {
        header('Location: ../../view/redator/registro.php?retorno=erro');
    }
    
}else {
    header('Location: ../../view/redator/registro.php?retorno=exi');
}