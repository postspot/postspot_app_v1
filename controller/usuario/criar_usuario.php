<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';

$nome_usuario = $_POST["nome_usuario"];
$sexo_usuario = $_POST["sexo_usuario"];
$foto_usuario = $_POST["foto_usuario"];
$funcao_usuario = $_POST["funcao_usuario"];
$email_usuario = $_POST["email_usuario"];
$senha_usuario = $_POST["senha_usuario"];
$idioma = $_POST["idioma"];


pre_r($_POST);
die();    

if (isset($nome_usuario) && isset($sexo_usuario) && isset($foto_usuario) && 
    isset($funcao_usuario) && isset($email_usuario) && isset($senha_usuario) &&
    isset($idioma)) {

    if (!empty($id_persona)) {
      
        $obj = new stdClass();
        
        $obj->nome_usuario = $nome_usuario;
        $obj->sexo_usuario = $sexo_usuario;
	$obj->foto_usuario = $foto_usuario;
	$obj->funcao_usuario = $funcao_usuario;
	$obj->email_usuario = $email_usuario;
	$obj->senha_usuario = md5($senha_usuario);
//	$obj->senha_usuario = $estagio_compra;
        
        $obj->id_usuario = usuarios::getAutoInc();
        $obj->id_idioma = $idioma;
         
//        pre_r($obj);
        if(usuarios::insert($obj)){
            
            if(idiomas_usuario::insert($obj)){
                header('Location: ../../view/cria_usuario.php?retorno=ok');
            }
            else{
                header('Location: ../../view/cria_usuario.php?retorno=erro');
            }
        }
        else{
            header('Location: ../../view/cria_usuario.php?retorno=erro');
        }
    }
    else {
        header('Location: ../../view/cria_usuario.php?retorno=falha');
    }
} 
else {
    header('Location: ../../view/cria_usuario.php?retorno=falha');
}




