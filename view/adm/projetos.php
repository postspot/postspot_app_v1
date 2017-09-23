<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';

$clientes = usuarios::getAllTipo(3);
$listaClientes  = '';
foreach ($clientes as $cliente) {
    $listaClientes .= '<option value="'.$cliente->id_usuario.'">'.$cliente->nome_usuario.'</option>';
}
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
                                                        <btn class="btn btn-sm btn-info btn-icon">Acessar Projeto <i class="fa fa-search"></i></btn>
                                                        <btn class="btn btn-sm btn-danger btn-icon">Deletar <i class="fa fa-times"></i></btn>
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

        optionResponsaveis = '<?= $listaClientes ?>';


    </script>
</html>