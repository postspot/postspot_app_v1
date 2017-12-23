<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/idiomas.php';
require_once 'includes/header_adm.php';

$idiomas = idiomas::getAllIdiomas();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>PostSpot</title>
        <?php require_once './includes/header_imports.php'; ?>
    </head>

    <body>
        <div class="wrapper">

            <!--Side Bar-->
            <?php require_once './includes/side_bar.php'; ?>

            <div class="main-panel">

                <!--Menu Topo-->
                <?php require_once './includes/menu_topo.php'; ?>

                <div class="content">
                    <div class="container-fluid">
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Gestão - Idiomas</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php foreach ($idiomas as $idioma) : ?>
                                            <li id="idioma<?= $idioma->id_idioma ?>">
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                    <?= $idioma->nome_idioma ?>
                                                    </div>
                                                    <div class="col-xs-4 text-right">
                                                        <btn class="btn btn-sm btn-icon fundo-roxo-padrao" onclick="deletaIdioma('<?= $idioma->id_idioma ?>',this);"><i class="fa fa-times"></i> Deletar</btn>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-icon btn-fixed" onclick="funcoes.showSwal('idioma')">
                    <i class="ti-plus"></i>
                </a>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    
    <script>
    var codDeletado;
    var elem;
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - idioma criado corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - idioma não foi criado.');
            });
        <?php } ?>
        function deletaIdioma(cod_idioma,btn) { 
            elem = '#idioma' + cod_idioma;
            codDeletado = cod_idioma;
            funcoes.showSwal('deletaIdioma');
         }
    </script>
</html>