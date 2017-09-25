<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/projetos.php';

$projetos = projetos::getAll();
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
                                            <?php foreach($projetos as $projeto): ?>
                                                <li id="projetoId<?= $projeto->id_projeto ?>">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <span class="text-muted"><small>Nome Projeto</small></span>
                                                            <br>
                                                            <?= $projeto->nome_projeto ?>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <span class="text-muted"><small>Data Criação</small></span>
                                                            <br>
                                                            <?= date("d", strtotime($projeto->cadastro_projeto)) ?>, <?= mesEscrito($projeto->cadastro_projeto) ?> <?= date("Y", strtotime($projeto->cadastro_projeto)) ?>
                                                        </div>
                                                        <div class="col-xs-4 text-right">
                                                            <a href="dashboard.php" class="btn btn-sm btn-info btn-icon">Acessar Projeto <i class="fa fa-search"></i></a>
                                                            <btn type="button" onclick="deletaProjeto('<?= $projeto->id_projeto ?>',this);" class="btn btn-sm btn-danger btn-icon">Deletar <i class="fa fa-times"></i></btn>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach;?>
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

        var codDeletado;
        var elem;
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - projeto foi criado corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'error') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - projeto editado com sucesso.');
            });
        <?php } ?>
        function deletaProjeto(cod_projeto,btn) { 
            elem = '#projetoId' + cod_projeto;
            codDeletado = cod_projeto;
            funcoes.showSwal('deletaProjeto');
         }

    </script>
</html>