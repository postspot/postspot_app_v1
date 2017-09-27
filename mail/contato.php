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
        <table cellspacing="0" cellpadding="10" border="0" width="600" style="margin: 0 auto;background-color: white;border-bottom: 2px solid #F8931E">
            <tr><td align="center"><img src="../view/adm/assets/img/logo-postspo.png" align="center"></td></tr>
            <tr>
                <td height="40" style="vertical-align: bottom;font-weight: bold;">Olá <?= $nome_adm ?>.</td>
            </tr>
            <tr>
                <td height="70" style="vertical-align: middle;padding: 15px 40px;">
                    Você tem uma pauta para ser aprovada:<br><br>
                    <b>Título:</b> <?= $nome_usuario ?><br>
                    <b>Acesse </b>
                </td>
            </tr>
        </table>        
    </body>
</html>