<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_adm.php';
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
        <title>Projetos - PostSpot</title>
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
                    <div class="container-fluid relative">
                        <a href="#" onclick="ativaModal()" class="btn btn-fixed fundo-rosa">
                            <i class="material-icons">add</i> Novo Projeto
                        </a>
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Gestão - Projetos</h4>
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
                                                        <div class="col-xs-2">
                                                            <span class="text-muted"><small>Cod Projeto</small></span>
                                                            <br>
                                                            <?= $projeto->id_projeto ?>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <span class="text-muted"><small>Nome Projeto</small></span>
                                                            <br>
                                                            <?= $projeto->nome_projeto ?>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <span class="text-muted"><small>Data Criação</small></span>
                                                            <br>
                                                            <?= date("d", strtotime($projeto->cadastro_projeto)) ?>, <?= mesEscrito($projeto->cadastro_projeto) ?> <?= date("Y", strtotime($projeto->cadastro_projeto)) ?>
                                                        </div>
                                                        <div class="col-xs-4 text-right">
                                                            <a href="dashboard.php?p=<?= $projeto->id_projeto ?>" class="btn btn-sm btn-info btn-icon fundo-roxo-escuro"><i class="fa fa-search"></i> Acessar Projeto</a>
                                                            <btn type="button" onclick="deletaProjeto('<?= $projeto->id_projeto ?>',this);" class="btn btn-sm btn-icon fundo-rosa-claro"><i class="fa fa-times"></i> Deletar</btn>
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
                funcoes.showNotification(0,1,'Projeto foi criado.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'error') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'Projeto editado.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'empty') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'Informe o nome do projeto.');
            });
        <?php } ?>
        function deletaProjeto(cod_projeto,btn) { 
            elem = '#projetoId' + cod_projeto;
            codDeletado = cod_projeto;
            funcoes.showSwal('deletaProjeto');
         }

    </script>
</html>