<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/membros_equipe.php';
require_once '../../model/usuarios.php';
require_once 'includes/header_padrao.php';

$membros = membros_equipe::buscarPessoasDaEquipe($_SESSION['id_projeto']);
$possiveis_membros = usuarios::getMenosEscritores($_SESSION['id_projeto']);
$qtd_escritores = usuarios::countRedatores();

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
                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">group</i> Equipe</h4>
                        <?php if ($_SESSION['funcao_usuario'] == 0) : ?>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="card card-vincula-membro">
                                    <div class="card-content">
                                        <form action="../../controller/membros_equipe/inclui_membro.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="material-icons">person_add</i>
                                                    <div class="form-group">
                                                        <label>Adicionar Membro</label>
                                                        <select multiple title="Escolha um membro" class="selectpicker form-control border-input" data-style="no-border" data-size="7" name="usuarios[]">
                                                            <?php foreach ($possiveis_membros as $membro) : ?>
                                                                <option value="<?= $membro->id_usuario ?>"><?= $membro->nome_usuario ?> - <?= funcaoCliente($membro->funcao_usuario) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-md-offset-8">
                                                    <button type="submit" class="btn btn-info btn-fill fundo-rosa">Incluir Membro</button>
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
                                                <i class="material-icons cor-roxo-escuro">folder_shared</i>
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
                                        <a href="vincula_redator.php" class="btn fundo-rosa">adicionar Redator</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php if (empty($membros)) : ?>
                                <div class="col-md-12 text-center">
                                <h2 class="cor-roxo-escuro">:( Equipe sem profissionais</h2>
                                </div>
                            <?php else : ?>
                            <div class="col-md-6">
                            <h3 class="cor-roxo-escuro" style="margin-left: 15;">Sua equipe</h3>
                            <?php foreach ($membros as $membro) :
                                if ($membro->funcao_usuario == 3) :
                            ?>
                                <div class="col-md-12" id="membro<?= $membro->id_membros ?>">
                                    <div class="card card-membro">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="avatar">
                                                        <img src="../../uploads/usuarios/<?= $membro->foto_usuario ?>" alt="Foto do <?= $membro->nome_usuario ?>" class="img-circle img-no-padding img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <h5><?= $membro->nome_usuario ?></h5>
                                                    <span><i class="material-icons mail">mail_outline</i> <?= $membro->email_usuario ?></span>
                                                </div>
                                            </div>
                                            <div class="stats ">
                                                <span class="label label-info fundo-roxo-padrao"><?= funcaoCliente($membro->funcao_usuario) ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <?= ($_SESSION['funcao_usuario'] == 0) ? '<i class="material-icons trash" onclick="deletaMembro(' . $membro->id_membros . ');">delete</i>' : '' ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
                            endforeach;
                            ?>
                            </div>
                            <div class="col-md-6">
                            <h3 class="cor-roxo-escuro" style="margin-left: 15;">Equipe PostSpot</h3>
                            <?php foreach ($membros as $membro) :
                                if ($membro->funcao_usuario != 3 && $membro->funcao_usuario != 2) :
                            ?>
                                <div class="col-md-12" id="membro<?= $membro->id_membros ?>">
                                    <div class="card card-membro">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="avatar">
                                                        <img src="../../uploads/usuarios/<?= $membro->foto_usuario ?>" alt="Foto do <?= $membro->nome_usuario ?>" class="img-circle img-no-padding img-responsive">
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <h5><?= $membro->nome_usuario ?></h5>
                                                    <span><i class="material-icons mail">mail_outline</i> <?= $membro->email_usuario ?></span>
                                                </div>
                                            </div>
                                            <div class="stats ">
                                                <span class="label label-info fundo-roxo-padrao"><?= funcaoCliente($membro->funcao_usuario) ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <hr>
                                            <p><?= $membro->obs ?></p>
                                            <?= ($_SESSION['funcao_usuario'] == 0) ? '<i class="material-icons trash" onclick="deletaMembro(' . $membro->id_membros . ');">delete</i>' : '' ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
                            endforeach;
                            ?>
                            </div>
                            <?php endif; ?>
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
        <?php 
    } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - membros não vinculados.');
            });
        <?php 
    } ?>
        function deletaMembro(cod) { 
            elem = '#membro' + cod;
            codDeletado = cod;
            funcoes.showSwal('deletaMembro');
         }
    </script>
</html>