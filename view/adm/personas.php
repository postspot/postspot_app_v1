<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
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
                            <h4 class="title"><i class="ti-user"></i> Personas</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-1">
                                                        <div class="avatar">
                                                            <img src="assets/img/faces/face-0.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Andress
                                                        <br>
                                                        <span class="text-muted"><small>90 anos</small></span>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Educação
                                                        <br>
                                                        <span class="text-muted"><small>Curso Superior</small></span>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        Trabalho
                                                        <br>
                                                        <span class="text-muted"><small>Administrador de empresa</small></span>
                                                    </div>
                                                    <div class="col-xs-1">
                                                        Segmento
                                                        <br>
                                                        <span class="text-muted"><small>Comércio</small></span>
                                                    </div>
                                                    <div class="col-xs-3 text-right">
                                                        <btn class="btn btn-sm btn-info btn-icon">Detalhes <i class="fa fa-search"></i></btn>
                                                        <btn class="btn btn-sm btn-danger btn-icon">Excluir <i class="fa fa-times"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-1">
                                                        <div class="avatar">
                                                            <img src="assets/img/faces/face-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Andress
                                                        <br>
                                                        <span class="text-muted"><small>90 anos</small></span>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Educação
                                                        <br>
                                                        <span class="text-muted"><small>Curso Superior</small></span>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        Trabalho
                                                        <br>
                                                        <span class="text-muted"><small>Administrador de empresa</small></span>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Segmento
                                                        <br>
                                                        <span class="text-muted"><small>Comércio</small></span>
                                                    </div>
                                                    <div class="col-xs-2 text-right">
                                                        <btn class="btn btn-sm btn-info btn-icon"><i class="fa fa-search"></i></btn>
                                                        <btn class="btn btn-sm btn-danger btn-icon"><i class="fa fa-times"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-1">
                                                        <div class="avatar">
                                                            <img src="assets/img/faces/face-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Andress
                                                        <br>
                                                        <span class="text-muted"><small>90 anos</small></span>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Educação
                                                        <br>
                                                        <span class="text-muted"><small>Curso Superior</small></span>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        Trabalho
                                                        <br>
                                                        <span class="text-muted"><small>Administrador de empresa</small></span>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Segmento
                                                        <br>
                                                        <span class="text-muted"><small>Comércio</small></span>
                                                    </div>
                                                    <div class="col-xs-2 text-right">
                                                        <a href="edita_persona.php" class="btn btn-sm btn-info btn-icon"><i class="fa fa-search"></i></a>
                                                        <a class="btn btn-sm btn-danger btn-icon"><i class="fa fa-times"></i></a>
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
                <a href="cria_persona.php" class="btn btn-icon btn-fixed">
                    <i class="ti-plus"></i>
                </a>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

</html>