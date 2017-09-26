<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_adm.php';
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
                            <h4 class="title"><i class="ti-panel"></i> Gestão - Usuários</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Usuários</h4>
                                    </div>
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php
                                            $users = usuarios::getAll();
                                            foreach ($users as $u) {
                                            ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-1">
                                                        <div class="avatar">
                                                            <img src="assets/img/faces/<?= $u->foto_usuario ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        Nome
                                                        <br>
                                                        <span class="text-muted"><small><?= $u->nome_usuario ?></small></span>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        E-mail
                                                        <br>
                                                        <span class="text-muted"><small><?= $u->email_usuario ?></small></span>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        Função
                                                        <br>
                                                        <span class="text-muted"><small><?= funcaoCliente($u->funcao_usuario) ?></small></span>
                                                    </div>
                                                    <div class="col-xs-4 text-right">
                                                        <a  class="btn btn-sm btn-info btn-icon" href="edita_usuario.php?u=<?= $u->id_usuario?>">Detalhes <i class="fa fa-search"></i></a>
                                                        <btn class="btn btn-sm btn-danger btn-icon">Deletar <i class="fa fa-times"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            ?>
                                         
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="cria_usuario.php" class="btn btn-icon btn-fixed">
                    <i class="ti-plus"></i>
                </a>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

</html>