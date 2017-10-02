<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';

$pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10);
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium - Pautas</title>
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
                        <h4 class="title"><i class="ti-light-bulb"></i> Pautas</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12 fundo-campos-busca">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <fieldset>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Buscar" class="form-control">
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option value="" selected>Ciclo</option>
                                                        <option value="">Ciclo 1</option>
                                                        <option value="">Ciclo 2</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option value="" selected>Tipo</option>
                                                        <option value="">Tipo 1</option>
                                                        <option value="">Tipo 2</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option value="" selected>Status</option>
                                                        <option value="">Status 1</option>
                                                        <option value="">Status 2</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-info btn-fill btn-wd">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="title"><strong>Pautas</strong> em geral</p>
                            </div>
                            <div class="col-lg-2">
                                <p>Aprovado em:</p>
                            </div>
                            <div class="col-lg-2">
                                Recebido em:
                            </div>
                        </div>
                        <?php 
                        foreach ($pautas as $value) {
                        ?>
                        <div class="card-tarefa">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p><?= $value->nome_tarefa ?></p>
                                </div>
                                <div class="col-lg-2">
                                    <p></p>
                                </div>
                                <div class="col-lg-2">
                                    <p><?= $value->data_criacao ?></p>
                                </div>
                                <div class="col-lg-2">
                                    <a href="detalhes_conteudo.php?t=<?= $value->id_tarefa ?>" class="btn btn-success btn-fill btn-wd">Detalhes</a>
                                </div>  
                            </div>
                        </div>
                        <?php
                        }
                        ?>
 
                    </div>
                    <a href="cria_pauta.php" class="btn btn-icon btn-fixed">
                        <i class="ti-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

</html>