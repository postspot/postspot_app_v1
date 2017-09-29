<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_padrao.php';
/*pre_r($projeto);
die();*/
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
                                                    5
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="#">
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
                                                    10
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-eye"></i> Ver todos
                                        </div>
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
                                                    5
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-timer"></i> Ver todos
                                        </div>
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
                                                    5
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-eye"></i> Ver todos
                                        </div>
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
                                <p class="title"><strong>Conteúdos</strong> para publicar</p>
                            </div>
                            <div class="col-lg-2">
                                <p>Aprovado em:</p>
                            </div>
                            <div class="col-lg-2">
                                Recebido em:
                            </div>
                        </div>
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <div class="card-tarefa">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>[ESTENDER + 500] Quais as diferenças entre o marketing tradicionar e o marketing dital?</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>08/11/2015</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>08/11/2015</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="detalhes_conteudo.php?t=1" class="btn btn-success btn-fill fill-up">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                        <a href="cria_pauta.php" class="btn btn-icon btn-fixed">
                            <i class="ti-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

</html>