<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';
session_start();

$id_usuario = $_SESSION['id_usuario'];

$usuario_banco = usuarios::getById($id_usuario);
$nome_usuario = $_POST["nome_usuario"];
$sexo_usuario = $_POST["sexo_usuario"];
$email_usuario = $_POST["email_usuario"];
$idioma = $_POST["idioma"];
$habilidades = $_POST["habilidade"];

pre_r($_POST);
pre_r($_FILES);
pre_r($usuario_banco);


if (isset($usuario_banco)) {

    if (!empty($usuario_banco)) {
      
        $usuario_atualizado = new stdClass();

        if ($_FILES['foto_usuario']['error'] != 4){

            $uploads_dir = DIR_ROOT.'/uploads/usuarios';
            if($usuario_banco->foto_usuario != 'sem_foto.jpg'):
                unlink("$uploads_dir/$usuario_banco->foto_usuario");
            endif;
            if($_FILES['foto_usuario']['error'] == UPLOAD_ERR_OK){
                $tmp_name = $_FILES["foto_usuario"]["tmp_name"];
                $name = $_FILES["foto_usuario"]["name"];
                move_uploaded_file($tmp_name, "$uploads_dir/$usuario_banco->id_usuario-$name");
            }

            $usuario_atualizado->foto_usuario = $usuario_banco->id_usuario."-".$_FILES["foto_usuario"]["name"];
        }
        else{
            $usuario_atualizado->foto_usuario = $usuario_banco->foto_usuario;
        }

        $usuario_atualizado->nome_usuario = $nome_usuario;
        $usuario_atualizado->id_usuario = $id_usuario;
        $usuario_atualizado->sexo_usuario = $sexo_usuario;
        $usuario_atualizado->email_usuario = $email_usuario;
        
        if(usuarios::updatePerfil($usuario_atualizado)){

            if(!empty($idioma)):
                idiomas_usuario::delete($id_usuario);
                foreach ($idioma as $value) {
                    $novo_idioma = new stdClass();
                    $novo_idioma->id_idioma = $value;
                    $novo_idioma->id_usuario = $usuario_atualizado->id_usuario;
                    if(idiomas_usuario::insert($novo_idioma)){
                        $flag_idiomas = 0;
                    }
                    else{
                        $flag_idiomas = 1;
                    }
                }
            endif;


            if(!empty($habilidades)):
                habilidades_usuario::delete($id_usuario);
                foreach ($habilidades as $value) {
                    $nova_habilidade = new stdClass();
                    $nova_habilidade->habilidades_id_habilidade = $value;
                    $nova_habilidade->usuarios_id_usuario = $usuario_atualizado->id_usuario;
                    
                    if(habilidades_usuario::insert($nova_habilidade)){
                        $flag_idiomas = 0;
                    }
                    else{
                        $flag_idiomas = 1;
                    }
                }
            endif;

            if($flag_idiomas == 0){ 
                $_SESSION['nome_usuario'] = $usuario_atualizado->nome_usuario;
                $_SESSION['foto_usuario'] = $usuario_atualizado->foto_usuario;
                header('Location: ../../view/adm/perfil.php?retorno=ok');
            }
        }
        else{
            header('Location: ../../view/adm/perfil.php?retorno=erro3');
        }
    }
    else {
        header('Location: ../../view/adm/perfil.php?retorno=erro2');
    }
}
else {
    header('Location: ../../view/adm/perfil.php?retorno=erro1');
}