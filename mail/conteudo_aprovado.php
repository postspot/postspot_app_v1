<?php
require_once '../config/config.php';
$nome = isset($_GET['nome']) ? $_GET['nome'] : 'ErroParametro';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : 'ErroParametro';
$projeto = isset($_GET['projeto']) ? $_GET['projeto'] : 'ErroParametro';
$aprovador = isset($_GET['aprovador']) ? $_GET['aprovador'] : 'ErroParametro';
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
                    <p style="line-height: 150%">O conteúdo <b><?= $titulo ?></b> do projeto <b><?= $projeto ?></b> foi aprovado por <b><?= $aprovador ?></b></p>     
                </td>   
            </tr>
            <tr>
            <td bgcolor="transparent" align="left" style="font-size: 16px; line-height: 150%; font-family: Helvetica, Arial, sans-serif; color: rgb(102, 102, 102); padding: 9px 18px">
                <p style="line-height: 150%;">Qualquer dúvida estamos à disposição.</p> 
                <p style="line-height: 150%;">Abraços,</p> 
                <p style="line-height: 150%;"><b>Time PostSpot</b></p> 
                </td>
            </tr>
        </table>        
    </body>
</html>