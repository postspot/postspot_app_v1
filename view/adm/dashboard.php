<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';
/*pre_r($projeto);
die();*/
$tarefas = tarefas::getUltimasDez($_SESSION['id_projeto'], 10);

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
                        <!--Estagios da Tarefa-->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-warning text-center">
                                                    <i class="ti-light-bulb"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Pautas</p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'],'< 4') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="pautas.php">
                                            <div class="stats">
                                                <i class="ti-eye"></i>  todas
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-info text-center">
                                                    <i class="ti-write"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Produzindo</p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= 4") ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="conteudos.php">
                                            <div class="stats">
                                                <i class="ti-eye"></i> Ver todos
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-danger text-center">
                                                    <i class="ti-alarm-clock"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Atrasados
                                                    </p>
                                                    <?= tarefas::countTarefasProjetoAtrasadas($_SESSION['id_projeto']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="conteudos.php">
                                            <div class="stats">
                                                <i class="ti-timer"></i> Ver todos
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="ti-check-box"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Publicados</p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= 9") ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="conteudos.php">
                                            <div class="stats">
                                                <i class="ti-eye"></i> Ver todos
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Campos de Busca-->
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
                                            <button type="submit" class="btn btn-info btn-fill fill-up">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Lista de Conteúdos-->
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="title"><strong>Pautas em geral</strong></p>
                            </div>
                            <div class="col-lg-2">
                                <p>Status:</p>
                            </div>
                            <div class="col-lg-2">
                                Data Previsão:
                            </div>
                        </div>
                        <?php 
                            if(empty($tarefas)):?>
                                <div class="card">
                                    <div class="card-content">
                                        <div class="typo-line text-center">
                                            <h2>Nenhuma pauta / conteúdo encontrado <br><small>Toque no botão laranja "+" para criar uma pauta</small> </h2>
                                        </div>
                                    </div>
                                </div>
                            <?php else: 
                            foreach ($tarefas as $tarefa): ?>
                            <div class="card-tarefa">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p> <?= $tarefa->nome_tarefa ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p><?= retornaStatusTarefa($tarefa->etapa) ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p><?= date('d/m/Y', strtotime($tarefa->data_prevista)) ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="detalhes_conteudo.php?t=<?= $tarefa->id_tarefa ?>" class="btn btn-success btn-fill btn-wd">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; endif;     ?>
                        <a href="cria_pauta.php" class="btn btn-icon btn-fixed">
                            <i class="ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    
    <script>
    $(document).ready(function() {
        
    });
    </script>
    
</html>