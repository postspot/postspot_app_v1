<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
require_once 'includes/header_padrao.php';

$personas = personas::getByProjeto($_SESSION['id_projeto']);
/*pre_r($personas);
die();*/
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
                            <h4 class="title"><i class="ti-user"></i> Personas</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                <?php if(empty($personas)):?>
                                    <div class="card-content">
                                        <div class="typo-line text-center">
                                            <h2>Nenhuma persona cadastrada <br><small>Toque no botão laranja "+" para criar</small> </h2>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                            <?php foreach($personas as $persona): ?>
                                                <li id="personaId<?= $persona->id_persona ?>">
                                                    <div class="row">
                                                        <div class="col-xs-1">
                                                            <div class="avatar">
                                                                <img src="assets/img/faces/<?= $persona->foto ?>" alt="Imagem persona <?= $persona->nome ?>" class="img-circle img-no-padding img-responsive">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            <?= $persona->nome ?>       
                                                            <br>
                                                            <span class="text-muted"><small><?= $persona->idade ?> anos</small></span>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            Educação
                                                            <br>
                                                            <span class="text-muted"><small><?= $persona->educacao ?></small></span>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            Trabalho
                                                            <br>
                                                            <span class="text-muted"><small><?= $persona->trabalho ?></small></span>
                                                        </div>
                                                        <div class="col-xs-2">
                                                            Segmento
                                                            <br>
                                                            <span class="text-muted"><small><?= $persona->segmento ?></small></span>
                                                        </div>
                                                        <div class="col-xs-3 text-right">
                                                            <a href="edita_persona.php?persona=<?= $persona->id_persona ?>" class="btn btn-sm btn-info btn-icon">Detalhes <i class="fa fa-search"></i></a>
                                                            <?= ($_SESSION['funcao_usuario'] == 0)? '<a href="#" onclick="deletaPersona(event,'. $persona->id_persona .',this);" class="btn btn-sm btn-danger btn-icon">Deletar <i class="fa fa-times"></i></a>' : '' ?>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
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

    <script>
    var codDeletado;
    var elem;
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - persona foi criada corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'eOk') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - persona editada com sucesso.');
            });
        <?php } ?>
        function deletaPersona(e,cod_persona,btn) { 
            elem = '#personaId' + cod_persona;
            codDeletado = cod_persona;
            funcoes.showSwal('deletaPersona');
         }
    </script>
</html>