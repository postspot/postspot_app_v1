<?php
$nome_adm = isset($_GET['nome_adm']) ? $_GET['nome_adm'] : 'ErroParametro';
$nome_usuario = isset($_GET['nome']) ? $_GET['nome'] : 'ErroParametro';
$email_usuario = isset($_GET['email']) ? $_GET['email'] : 'ErroParametro';
$assunto_usuario = isset($_GET['assunto']) ? $_GET['assunto'] : 'ErroParametro';
$mensagem_usuario = isset($_GET['mensagem']) ? $_GET['mensagem'] : 'ErroParametro';
$textoInformativo = isset($_GET['texto']) ? $_GET['texto'] : 'ErroParametro';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    </head>

    <body style="background-color: #efefef;font-family: sans-serif;">
        <table cellspacing="0" cellpadding="10" border="0" width="600" style="margin: 0 auto;background-color: white;border-bottom: 2px solid #9e6dce;padding-bottom: 10px;">
            <tr><td align="center"><img src="../view/adm/assets/img/logo-colorido-horizontal.png" style="width: 200px;" align="center"></td></tr>
            <tr>
                <td bgcolor="transparent" align="left" style="font-size: 16px; line-height: 150%; font-family: Helvetica, Arial, sans-serif; color: rgb(102, 102, 102); padding: 9px 18px">
                    <p style="line-height: 150%;">Olá, <?= $nome_adm ?>!</p> 
                    <p style="line-height: 150%">O conteúdo <b><?= $nome_adm ?></b> do projeto <b><?= $nome_adm ?></b> foi aprovado por <b><?= $nome_adm ?></b></p>     
                </td>   
            </tr>
            <tr>
            <td bgcolor="transparent" align="left" style="font-size: 16px; line-height: 150%; font-family: Helvetica, Arial, sans-serif; color: rgb(102, 102, 102); padding: 9px 18px">
                <p style="line-height: 150%;">Qualquer dúvida estamos à disposição.</p> 
                <p style="line-height: 150%;">Abraços,</p> 
                <p style="line-height: 150%;"><b>Equipe PostSpot</b></p> 
                </td>
            </tr>
        </table>        
    </body>
</html>