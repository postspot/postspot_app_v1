<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';

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
$foto_usuario = $_POST["foto_usuario"];
$funcao_usuario = $_POST["funcao_usuario"];
$email_usuario = $_POST["email_usuario"];
$senha_usuario = $_POST["senha_usuario"];
$idioma = $_POST["idioma"];

if (isset($nome_usuario) && isset($sexo_usuario) && isset($foto_usuario) && 
    isset($funcao_usuario) && isset($email_usuario) && isset($senha_usuario) &&
    isset($idioma)) {

    if (!empty($nome_usuario)) {
      
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
        
        mkdir('http://localhost/postspot/uploads/usuarios/' . $obj->id_usuario . "-" . $obj->nome_usuario, 0777);
        $uploads_dir = '../uploads/usuarios/' . $obj->id_usuario . "-" . $obj->nome_usuario;
        
        if ($_FILES['foto_usuario']['error'][0] != 4){
            if (is_dir($uploads_dir)) {
                $diretorio = dir($uploads_dir);
                while ($arquivo = $diretorio->read()) {
        //        chmod($uploads_dir . "/" . $arquivo, 0755);
                    if (($arquivo != '.') && ($arquivo != '..')) {
                        unlink($uploads_dir . "/" . $arquivo);
                    }
                }
                $diretorio->close();
            }
            
            foreach ($_FILES["foto_usuario"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["foto_usuario"]["tmp_name"][$key];
                    $name = $_FILES["foto_usuario"]["name"][$key];
                    move_uploaded_file($tmp_name, "$uploads_dir/$name");
                }
            }
            
            resizePersonal($uploads_dir/$name, $uploads_dir);
        }
            
        
//        pre_r($obj);
        if(usuarios::insert($obj)){
            
            if(idiomas_usuario::insert($obj)){
                header('Location: ../../view/adm/cria_usuario.php?retorno=ok');
            }
            else{
                header('Location: ../../view/adm/cria_usuario.php?retorno=erro');
            }
        }
        else{
            header('Location: ../../view/adm/cria_usuario.php?retorno=erro');
        }
    }
    else {
        header('Location: ../../view/adm/cria_usuario.php?retorno=falha');
    }
} 
else {
    header('Location: ../../view/cria_usuario.php?retorno=falha');
}




