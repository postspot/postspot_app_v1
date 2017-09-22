<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tipo_tarefa.php';

$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium</title>
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
                        <h4 class="title"><i class="ti-panel"></i> Gestão - Tipo de Conteúdo</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                            <li id="tipo<?= $tipoTarefa->id_tipo ?>">
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                    <?= $tipoTarefa->nome_tarefa ?>
                                                    </div>
                                                    <div class="col-xs-4 text-right">
                                                        <btn class="btn btn-sm btn-danger btn-icon" onclick="deletaTipoTarefa('<?= $tipoTarefa->id_tipo ?>',this);"><i class="fa fa-times"></i></btn>
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
                <a href="#" class="btn btn-icon btn-fixed" onclick="funcoes.showSwal('tipoConteudo')">
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
                funcoes.showNotification(0,1,'<b>Sucesso</b> - tipo de conteúdo criado corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - tipo de conteúdo não foi criado.');
            });
        <?php } ?>
        function deletaTipoTarefa(cod_tipo,btn) { 
            elem = '#tipo' + cod_tipo;
            codDeletado = cod_tipo;
            funcoes.showSwal('deletaTipoTarefa');
         }
    </script>
</html>