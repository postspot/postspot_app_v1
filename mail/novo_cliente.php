<?php
require_once '../config/config.php';
$nome = isset($_GET['nome']) ? $_GET['nome'] : 'ErroParametro';
$email = isset($_GET['email']) ? $_GET['email'] : 'ErroParametro';
$senha = isset($_GET['senha']) ? $_GET['senha'] : 'ErroParametro';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    </head>

    <body style="background-color: #efefef;font-family: sans-serif;">
        <table cellspacing="0" cellpadding="10" border="0" width="600" style="margin: 0 auto;background-color: white;border-bottom: 2px solid #9e6dce;padding-bottom: 10px;">
            <tr><td align="center"><img src="<?=SITE?>view/adm/assets/img/logo-colorido-horizontal.png" style="width: 200px;" align="center"></td></tr>
            <tr>
                <td bgcolor="transparent" align="left" style="font-size: 16px; line-height: 150%; font-family: Helvetica, Arial, sans-serif; color: rgb(102, 102, 102); padding: 9px 18px">
                    <p style="line-height: 150%;">Olá, <?= $nome ?>!</p> 
                    <p style="line-height: 150%">O seu analista de sucesso de cliente convidou você para utilizar nossa plataforma de gestão de conteúdo. Uma senha temporária foi gerada para você acessar a sua conta</p>     
                    <p style="line-height: 150%;"><b>E-mail:</b> <?= $email ?><br><b>Senha:</b> <?= $senha ?><br><b>Endereço de login:</b> <a target="_blank" href="<?=SITE?>view/adm/index.php" style="color: #9f6fcf;">https://app.postspot.com.br/view/adm/index.php</a></p> 
                </td>   
            </tr>
            <tr>
                <td align="center" height="70"><a target="_blank" href="<?=SITE?>view/adm/index.php" style="text-decoration: none;background-color: #ec268f;border-color: #ec268f;color: #fff;border-radius: 20px;border: 2px;font-size: 14px;font-weight: 600;padding: 10px 20px;cursor: pointer;">ACESSAR PLATAFORMA</a></td>
            </tr>
            <tr>
            <td bgcolor="transparent" align="left" style="font-size: 16px; line-height: 150%; font-family: Helvetica, Arial, sans-serif; color: rgb(102, 102, 102); padding: 9px 18px">
                <p style="line-height: 150%;">Caso deseje alterar esta senha, basta clicar no seu perfil na plataforma.</p> 
                <p style="line-height: 150%;">Estamos o tempo todo compartilhando novidades e conteúdos que podem ajudá-lo com sua estratégia de marketing digital:</p> 
                <p style="line-height: 150%;">Siga-nos no <a target="_blank" href="https://twitter.com/postspotcontent" style="color: #9f6fcf;">Twitter</a> e acompanhe o <a target="_blank" style="color: #9f6fcf;" href="http://postspot.com.br/blog/">nosso blog</a>!</p> 
                <p style="line-height: 150%;">Se você tiver qualquer dúvida, nossa  <a target="_blank" href="https://postspot.zendesk.com/hc/pt-br" style="color: #9f6fcf;">Central de Ajuda</a> é constantemente atualizada para ajudá-lo.</p> 
                <p style="line-height: 150%;"><b>Equipe PostSpot</b></p> 
                </td>
            </tr>
        </table>        
    </body>
</html>