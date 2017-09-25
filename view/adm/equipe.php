<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/membros_equipe.php';
require_once '../../model/usuarios.php';

$id_projeto = 1;
$membros = membros_equipe::buscarPessoasDaEquipe($id_projeto);
$possiveis_menbros = usuarios::getMenosEscritores();
$qtd_escritores = usuarios::countRedatores();
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
                            <h4 class="title"><i class="ti-world"></i> Equipe</h4>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card card-vincula-membro">
                                    <div class="card-header">
                                        <h4 class="card-title">Inserir Profissional</h4>
                                    </div>
                                    <div class="card-content">
                                        <form action="../../controller/membros_equipe/inclui_membro.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Membro</label>
                                                        <select multiple title="Escolha um membro" class="selectpicker form-control border-input" data-style="no-border" data-size="7" name="usuarios[]">
                                                            <?php foreach($possiveis_menbros as $membro): ?>
                                                                <option value="<?= $membro->id_usuario ?>"><?= $membro->nome_usuario ?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-info btn-fill">Incluir Profissionais</button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-warning text-center">
                                                    <i class="ti-ruler-pencil"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Redatores</p>
                                                    <?= $qtd_escritores ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <hr>
                                        <a href="vincula_redator.php" class="btn btn-info btn-warning">Incluir Redator</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if(empty($membros)):?>
                                <div class="col-md-12 text-center">
                                    <h2>:( Equipe sem profissionais</h2>
                                </div>
                            <?php else:?>
                                <?php foreach ($membros as $membro): ?>
                                    <div class="col-md-3" id="membro<?= $membro->id_membros ?>">
                                        <div class="card card-membro">
                                            <div class="card-content">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <div class="avatar">
                                                            <img src="assets/img/faces/<?= $membro->foto_usuario ?>" alt="Foto do <?= $membro->nome_usuario ?>" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <h5><?= $membro->nome_usuario ?></h5>
                                                    </div>
                                                </div>
                                                <i class="fa fa-trash" aria-hidden="true" onclick="deletaMembro('<?= $membro->id_membros ?>');"></i>
                                            </div>
                                            <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                    <span class="label label-info"><?= funcaoCliente($membro->funcao_usuario) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-12 text-center">
                                <h2>:( Equipe sem profissionais</h2>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

    <script>
    var codDeletado;
    var elem;
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - membros vinculados corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - membros não vinculados.');
            });
        <?php } ?>
        function deletaMembro(cod) { 
            elem = '#membro' + cod;
            codDeletado = cod;
            funcoes.showSwal('deletaMembro');
         }
    </script>
</html>