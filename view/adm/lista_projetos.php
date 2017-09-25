<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';

$projetos = projetos::getAll();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium - Projetos</title>
        <?php require_once './includes/header_imports.php'; ?>
    </head>

    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 lista-projetos">
                        <img src="assets/img/logo-postspo.png" alt="Logo PostSpot">
                        <h1>Bem vindo novamente, Andress!</h1>
                        <p>Selecione o projeto que deseja acompanhar</p>
                        <ul>
                            <?php foreach($projetos as $projeto): ?>
                                <li class="<?= ($projeto->id_projeto == 1) ? 'active' : '' ?>"><a href="dashboard.php?p=<?= $projeto->id_projeto ?>"><?= $projeto->nome_projeto ?> <i class="fa fa-chevron-right"></i></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

</html>