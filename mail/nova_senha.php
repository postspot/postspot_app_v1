<?php
require_once '../config/config.php';
$nome = isset($_GET['nome']) ? $_GET['nome'] : 'ErroParametro';
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
                    <p style="line-height: 150%;">Olá, <b><?= $nome ?></b></p> 
                    <p style="line-height: 150%">Esqueceu sua senha? Não se preocupe. Isso acontece ;) </p>     
                    <p style="line-height: 150%">Geramos uma nova senha, para que você possa acessar o portal novamente. Lembrando que aconselhamos você a trocar de senha ao acessar o portal.</p>     
                    <p style="line-height: 150%;"><b>Nova senha:</b> <?= $senha ?></p> 
                </td>   
            </tr>
            <tr>
                <td align="center" height="70"><a target="_blank" href="<?=SITE?>view/adm/index.php" style="text-decoration: none;background-color: #ec268f;border-color: #ec268f;color: #fff;border-radius: 20px;border: 2px;font-size: 14px;font-weight: 600;padding: 10px 20px;cursor: pointer;">ACESSAR PLATAFORMA</a></td>
            </tr>
            <td bgcolor="transparent" align="left" style="font-size: 16px; line-height: 150%; font-family: Helvetica, Arial, sans-serif; color: rgb(102, 102, 102); padding: 9px 18px">
                <p style="line-height: 150%;">Qualquer dúvida estamos à disposição.</p> 
                <p style="line-height: 150%;">Abraços,</p> 
                <p style="line-height: 150%;"><b>Equipe PostSpot</b></p> 
                </td>
            </tr>
        </table>        
    </body>
</html>