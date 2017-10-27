<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_adm.php';
require_once '../../model/categorias.php';

$categorias = categorias::getAll();
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
                        <h4 class="title"><i class="ti-panel"></i> Gestão - Categorias</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php foreach ($categorias as $categoria) : ?>
                                            <li id="categoria<?= $categoria->id_categoria ?>">
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                    <?= $categoria->nome_categoria ?>
                                                    </div>
                                                    <div class="col-xs-4 text-right">
                                                        <btn class="btn btn-sm btn-danger btn-icon" onclick="deletaCategoria('<?= $categoria->id_categoria ?>',this);">Deletar <i class="fa fa-times"></i></btn>
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
                <a href="#" class="btn btn-icon btn-fixed" onclick="funcoes.showSwal('categoria')">
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
                funcoes.showNotification(0,1,'<b>Sucesso</b> - categoria criada corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - categoria não foi criada.');
            });
        <?php } ?>
        function deletaCategoria(cod_categoria,btn) { 
            elem = '#categoria' + cod_categoria;
            codDeletado = cod_categoria;
            funcoes.showSwal('deletaCategoria');
         }
    </script>
</html>