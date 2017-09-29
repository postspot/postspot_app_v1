<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';

function resizePersonal($originalFile, $pasta) {
    $targetFile = '../uploads/usuarios/' . $pasta;
    $info = getimagesize($originalFile);
    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func = 'imagejpeg';
            $new_image_ext = 'jpg';
            break;

        case 'image/png':
            $image_create_func = 'imagecreatefrompng';
            $image_save_func = 'imagepng';
            $new_image_ext = 'png';
            break;

        case 'image/gif':
            $image_create_func = 'imagecreatefromgif';
            $image_save_func = 'imagegif';
            $new_image_ext = 'gif';
            break;

        default:
            throw new Exception('Unknown image type.');
    }
    echo $originalFile;
    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = 200;
    $newWidth = 200;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
        unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile");
}

$nome_usuario = $_POST["nome_usuario"];
$sexo_usuario = $_POST["sexo_usuario"];
$funcao_usuario = $_POST["funcao_usuario"];
$email_usuario = $_POST["email_usuario"];
$senha_usuario = $_POST["senha_usuario"];
$idioma = $_POST["idioma"];
$habilidades = $_POST["habilidade"];

if (isset($nome_usuario) && isset($sexo_usuario) && 
    isset($funcao_usuario) && isset($email_usuario) && isset($senha_usuario)) {

    if (!empty($nome_usuario)) {
      
        $obj = new stdClass();
        
        $obj->nome_usuario = $nome_usuario;
        $obj->sexo_usuario = $sexo_usuario;
	$obj->funcao_usuario = $funcao_usuario;
	$obj->email_usuario = $email_usuario;
	$obj->senha_usuario = md5($senha_usuario);
//	$obj->senha_usuario = $estagio_compra;
        
        $obj->id_usuario = usuarios::getAutoInc();
        $obj->id_idioma = $idioma;
        
        $uploads_dir = DIR_ROOT.'/uploads/usuarios';
        
        if ($_FILES['foto_usuario']['error'] != 4){
            
            
            if($_FILES['foto_usuario']['error'] == UPLOAD_ERR_OK){
                $tmp_name = $_FILES["foto_usuario"]["tmp_name"];
                $name = $_FILES["foto_usuario"]["name"];
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
            }
            
            resizePersonal("$uploads_dir/$name", $uploads_dir);
            
            
            
            $obj->foto_usuario = $_FILES["foto_usuario"]["name"];
        }
        else{
            $obj->foto_usuario = "sem_foto.png";
        }
            
        
//        pre_r($obj);
        if(usuarios::insert($obj)){
            $flag_idiomas = 0;
            foreach ($idioma as $value) {
                $novo_idioma = new stdClass();
                $novo_idioma->id_idioma = $value;
                $novo_idioma->id_usuario = $obj->id_usuario;
                
                if(idiomas_usuario::insert($novo_idioma)){
                    $flag_idiomas = 0;
                }
                else{
                    $flag_idiomas = 1;
                    header('Location: ../../view/adm/time.php?retorno=erro');
                }
            }
            if($flag_idiomas == 0){
                $flag_idiomas=0;
                 foreach ($habilidades as $value) {
                    $nova_habilidade = new stdClass();
                    $nova_habilidade->habilidades_id_habilidade = $value;
                    $nova_habilidade->usuarios_id_usuario = $obj->id_usuario;
//                   
//                    echo habilidades_usuario::insert($nova_habilidade);
//                    die();
                    
                    if(habilidades_usuario::insert($nova_habilidade)){
                        $flag_idiomas = 0;
                    }
                    else{
                        $flag_idiomas = 1;
                        header('Location: ../../view/adm/time.php?retorno=erro');
                    }
                }
                if($flag_idiomas == 0){ 
                    header('Location: ../../view/adm/time.php?retorno=ok');
                }
            }
        }
        else{
            header('Location: ../../view/adm/time.php?retorno=erro');
        }
    }
    else {
        header('Location: ../../view/adm/time.php?retorno=erro');
    }
} 
else {
    header('Location: ../../view/time.php?retorno=erro');
}




