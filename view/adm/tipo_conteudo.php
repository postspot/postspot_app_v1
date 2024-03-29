<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_adm.php';
require_once '../../model/tipo_tarefa.php';

$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Tipo Conteúdo - PostSpot</title>
        <?php require_once './includes/header_imports.php'; ?>
        <style>
        .swal2-container{
            z-index: 1000 !important;
        }
        </style>
    </head>

    <body>
        <div class="wrapper">

            <!--Side Bar-->
            <?php require_once './includes/side_bar.php'; ?>

            <div class="main-panel">

                <!--Menu Topo-->
                <?php require_once './includes/menu_topo.php'; ?>

                <div class="content">
                    <div class="container-fluid relative">
                    <a href="#" class="btn btn-fixed fundo-rosa" onclick="funcoes.showSwal('tipoConteudo')">
                        <i class="material-icons">add</i> Novo tipo
                    </a>
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Gestão - Tipo de Conteúdo</h4>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                            <li id="tipo<?= $tipoTarefa->id_tipo ?>">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <?= $tipoTarefa->nome_tarefa ?>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        R$ <?= str_replace(".", ",", $tipoTarefa->valor_pauta_tipo_tarefa) ?>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        R$ <?= str_replace(".", ",", $tipoTarefa->valor_conteudo_tipo_tarefa) ?>
                                                    </div>
                                                    <div class="col-xs-1">
                                                        <div class="quadrado-cor" style="background-color: #<?= $tipoTarefa->cor_tarefa ?>"></div>
                                                    </div>
                                                    <div class="col-xs-3 text-right">
                                                        <btn class="btn btn-sm btn-icon fundo-rosa-claro" onclick="deletaTipoTarefa('<?= $tipoTarefa->id_tipo ?>',this);"><i class="fa fa-times"></i> Deletar</btn>
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
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    <script src="assets/js/jscolor.min.js"></script>
    <script src="assets/js/mask.js"></script>
    
    <script>
    var codDeletado;
    var elem;
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'Tipo de conteúdo criado.');
            });
        <?php 
    } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'Tipo de conteúdo não foi criado.');
            });
        <?php 
    } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'empty') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'Informe os campos corretamente.');
            });
        <?php 
    } ?>
        function deletaTipoTarefa(cod_tipo,btn) { 
            elem = '#tipo' + cod_tipo;
            codDeletado = cod_tipo;
            funcoes.showSwal('deletaTipoTarefa');
         }
    </script>
</html>