<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';

$id_usuario = $_POST["id_usuario"];
$nome_usuario = $_POST["nome_usuario"];
$sexo_usuario = $_POST["sexo_usuario"];
$funcao_usuario = $_POST["funcao_usuario"];
$email_usuario = $_POST["email_usuario"];
$senha_usuario = $_POST["senha_usuario"];
$idioma = $_POST["idioma"];
$habilidades = $_POST["habilidade"];

//pre_r($_POST);
//pre_r($_FILES);
//
//die();

if (isset($nome_usuario) && isset($sexo_usuario) && 
    isset($funcao_usuario) && isset($email_usuario) &&
    isset($idioma)) {

    if (!empty($nome_usuario)) {
      
        $obj = new stdClass();
        
        $obj->nome_usuario = $nome_usuario;
        $obj->id_usuario = $id_usuario.
        $obj->sexo_usuario = $sexo_usuario;
        $obj->funcao_usuario = $funcao_usuario;
        $obj->email_usuario = $email_usuario;
        
        if(usuarios::update($obj)){
            idiomas_usuario::delete($id_usuario);
            foreach ($idioma as $value) {
                $novo_idioma = new stdClass();
                $novo_idioma->id_idioma = $value;
                $novo_idioma->id_usuario = $obj->id_usuario;
                if(idiomas_usuario::insert($novo_idioma)){
                    $flag_idiomas = 0;
                }
                else{
                    $flag_idiomas = 1;
                }
            }

            habilidades_usuario::delete($id_usuario);
            foreach ($habilidades as $value) {
                $nova_habilidade = new stdClass();
                $nova_habilidade->habilidades_id_habilidade = $value;
                $nova_habilidade->usuarios_id_usuario = $obj->id_usuario;
                
                if(habilidades_usuario::insert($nova_habilidade)){
                    $flag_idiomas = 0;
                }
                else{
                    $flag_idiomas = 1;
                }
            }
            if($flag_idiomas == 0){ 
                header('Location: ../../view/adm/time.php?retorno=eok');
            }
        }
        else{
            header('Location: ../../view/adm/edita_usuario.php?u='.$obj->id_usuario.'&retorno=erro');
        }
    }
    else {
        header('Location: ../../view/adm/edita_usuario.php?u='.$obj->id_usuario.'&retorno=erro');
    }
}
else {
    header('Location: ../../view/adm/edita_usuario.php?u='.$obj->id_usuario.'&retorno=erro');
}