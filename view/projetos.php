<?php
require_once '../config/config.php';
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
                        <h4 class="title"><i class="ti-panel"></i> Gestão - Projetos</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Nome Projeto
                                                        <br>
                                                        <span class="text-muted"><small>Melhor Compra</small></span>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        Data Criação
                                                        <br>
                                                        <span class="text-muted"><small>01, Maio 2016</small></span>
                                                    </div>
                                                    <div class="col-xs-4 text-right">
                                                        <btn class="btn btn-sm btn-info btn-icon"><i class="fa fa-search"></i> Acessar Projeto</btn>
                                                        <btn class="btn btn-sm btn-danger btn-icon"><i class="fa fa-times"></i> Excluir</btn>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" onclick="ativaModal()" class="btn btn-icon btn-fixed">
                    <i class="ti-plus"></i>
                </a>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

    <script>
        function ativaModal() {
            funcoes.showSwal('criaProjeto');
            funcoes.initFormExtendedDatetimepickers();
        }
    </script>
</html>