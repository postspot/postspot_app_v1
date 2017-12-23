<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_adm.php';
require_once '../../model/habilidades.php';

$habilidades = habilidades::getAllSkills();
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
                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Gestão - Habilidades</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php foreach ($habilidades as $habilidade) : ?>
                                                <li id="habilidadeId<?= $habilidade->id_habilidade ?>">
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                            <?= $habilidade->nome_habilidade ?>
                                                        </div>
                                                        <div class="col-xs-4 text-right">
                                                            <btn class="btn btn-sm btn-icon fundo-roxo-padrao" onclick="deletaHabilidade('<?= $habilidade->id_habilidade ?>',this);"><i class="fa fa-times"></i> Deletar</btn>
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
                <a href="#" class="btn btn-icon btn-fixed" onclick="funcoes.showSwal('habilidade')">
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
                funcoes.showNotification(0,1,'<b>Sucesso</b> - habilidade criada corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - habilidade não foi criada.');
            });
        <?php } ?>
        function deletaHabilidade(cod_habilidade,btn) { 
            elem = '#habilidadeId' + cod_habilidade;
            codDeletado = cod_habilidade;
            funcoes.showSwal('deletaHabilidade');
         }
    </script>
</html>