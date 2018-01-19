<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../lib/phpMailer.php';
session_start();

$email_usuario = $_POST["email_usuario"];

$usuario = usuarios::getByEmail($email_usuario);

if (!empty($usuario)) {
    
    //Vai enviar email aqui

    $assunto = 'Nova senha acesso';
    $senha = 'ps'.date("Y").rand(100, 999);
    //    PREPARA AS VARIAVEIS
    $param_email = array(
        'nome' => $usuario->nome_usuario,
        'senha' => $senha
    );

    //    LINKA + PARAMETROS
    $parametros = SITE . 'mail/nova_senha.php?' . http_build_query($param_email);

    // VARIAVEIS
    $tmp = file_get_contents($parametros);
    smtpmailer($email_usuario, $assunto, $tmp);

    if(usuarios::trocaSenha($usuario->id_usuario, md5($senha))):
        header('Location: ../../view/adm/index.php?erro=rsOk');
    else:
        header('Location: ../../view/adm/index.php?erro=rsErro');
    endif;
} else {
    header('Location: ../../view/adm/index.php?erro=rsErro');
}