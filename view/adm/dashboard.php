<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once '../../model/tipo_tarefa.php';
require_once 'includes/header_padrao.php';
/*pre_r($projeto);
die();*/

$filtroStatus = '0';
$filtroTipo = '0';
if (isset($_GET["t"]) || isset($_GET["s"])) {
    $filtroTipo = (($_GET["t"] != '0') ? ' AND t.id_tipo = ' . $_GET["t"] : '');
    $filtroStatus = $_GET["s"];

    switch ($filtroStatus) {
        case '0':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, $filtroTipo);
            break;
        case '1':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND (l.etapa = ' . CONTEUDO_ESCREVENDO . ' OR l.etapa = ' . CONTEUDO_AJUSTANDO . ')' . $filtroTipo);
            break;
        case '2':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND (l.etapa = ' . PAUTA_APROVACAO_CLIENTE . ' OR l.etapa = ' . PAUTA_REAPROVACAO_CLIENTE . ')' . $filtroTipo);
            break;
        case '3':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND l.etapa = ' . PAUTA_AJUSTANDO . $filtroTipo);
            break;
        case '4':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND (l.etapa = ' . CONTEUDO_APROVACAO_MODERADOR . ' OR l.etapa = ' . CONTEUDO_REAPROVACAO_MODERADOR . ')' . $filtroTipo);
            break;
        case '5':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND l.etapa = ' . PAUTA_ESCREVENDO . $filtroTipo);
            break;
        case '6':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND (l.etapa = ' . PAUTA_APROVACAO_MODERADOR . ' OR l.etapa = ' . PAUTA_REAPROVACAO_MODERADOR . ')' . $filtroTipo);
            break;
        case '7':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND (l.etapa = ' . CONTEUDO_APROVACAO_CLIENTE . ' OR l.etapa = ' . CONTEUDO_REAPROVACAO_CLIENTE . ')' . $filtroTipo);
            break;
        case '8':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND l.etapa = ' . CONTEUDO_AJUSTANDO . $filtroTipo);
            break;
        case '9':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND l.etapa = ' . CONTEUDO_PARA_PUBLICAR . $filtroTipo);
            break;
        case '10':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND l.etapa = ' . CONTEUDO_PUBLICADO . $filtroTipo);
            break;
    }
    $textoTitulo = 'Materiais encontrados';
    $param = true;
} else if (isset($_GET["a"])) {
    $tarefas = tarefas::tarefasProjetoAtrasadas($_SESSION['id_projeto']);
    $textoTitulo = 'Conteúdos atrasados';
    $param = true;
    // pre_r($tarefas);
    // die();
} else {
    $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 100, 'AND l.etapa = ' . CONTEUDO_PARA_PUBLICAR);
    $textoTitulo = 'Conteúdos para Publicar';
    $param = false;
}
$totasTarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 1000, 'AND l.etapa >= 0');
$tiposTarefa = tipo_tarefa::getAllTiposTaredas();

// pre_r($tarefas);
// die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Dashboard - PostSpot</title>
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
                        <!--Estagios da Tarefa-->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-warning text-center">
                                                <i class="material-icons cor-azul-quatro">list</i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Pautas <span>para aprovar</span></p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], 'AND (l.etapa = ' . PAUTA_APROVACAO_CLIENTE . ' OR l.etapa = ' . PAUTA_REAPROVACAO_CLIENTE . ')'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="pautas.php?s=2">
                                            <div class="stats">
                                                <i class="ti-eye"></i> Ver todas
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-info text-center">
                                                <i class="material-icons cor-azul-quatro">description</i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Conteúdos<span>para aprovar</span></p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], 'AND (l.etapa = ' . CONTEUDO_APROVACAO_CLIENTE . ' OR l.etapa = ' . CONTEUDO_REAPROVACAO_CLIENTE . ')') ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="conteudos.php?s=2">
                                            <div class="stats">
                                                <i class="ti-eye"></i> Ver todos
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-danger text-center">
                                                <i class="material-icons cor-azul-quatro">send</i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Conteúdos<span>para publicar</span>
                                                    </p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= ".CONTEUDO_PARA_PUBLICAR) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="conteudos.php?s=7">
                                            <div class="stats">
                                                <i class="ti-eye"></i> Ver todos
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                <i class="material-icons cor-azul-quatro">playlist_add_check</i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Conteúdos<span>publicados</span></p>
                                                    <?= tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= 15") ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr />
                                        <a href="conteudos.php?s=4">
                                            <div class="stats">
                                                <i class="ti-eye"></i> Ver todos
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Campos de Busca-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12 fundo-campos-busca">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control select-customizado" name="titulo_noticia">
                                                        <option selected disabled>Buscar pelo título...</option>
                                                        <?php foreach ($totasTarefas as $tarefa) : ?>
                                                            <option value="<?= ($tarefa->etapa > 4) ? 'detalhes_conteudo' : 'detalhes_pauta' ?>.php?t=<?= $tarefa->id_tarefa ?>"><?= $tarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control" id="filtroTipoTarefa">
                                                        <option value="0" >Tipos</option>
                                                        <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                            <option value="<?= $tipoTarefa->id_tipo ?>" <?= ($tipoTarefa->id_tipo == $filtroTipo) ? 'selected' : '' ?>><?= $tipoTarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control" id="filtroStatusTarefa">
                                                        <option value="0" <?= ($filtroStatus == '0') ? 'selected' : '' ?>>Status</option>
                                                        <option value="5" <?= ($filtroStatus == '5') ? 'selected' : '' ?>>Pautas em produção</option>
                                                        <option value="6" <?= ($filtroStatus == '6') ? 'selected' : '' ?>>Pautas em avaliação</option>
                                                        <option value="2" <?= ($filtroStatus == '2') ? 'selected' : '' ?>>Pautas em aprovação</option>
                                                        <option value="3" <?= ($filtroStatus == '3') ? 'selected' : '' ?>>Pautas em ajuste</option>
                                                        <option value="1" <?= ($filtroStatus == '1') ? 'selected' : '' ?>>Conteúdos em produção</option>
                                                        <option value="4" <?= ($filtroStatus == '4') ? 'selected' : '' ?>>Conteúdos em avaliação</option>
                                                        <option value="7" <?= ($filtroStatus == '7') ? 'selected' : '' ?>>Conteúdos em aprovação</option>
                                                        <option value="8" <?= ($filtroStatus == '8') ? 'selected' : '' ?>>Conteúdos em ajuste</option>
                                                        <option value="9" <?= ($filtroStatus == '9') ? 'selected' : '' ?>>Conteúdos em publicação</option>
                                                        <option value="10" <?= ($filtroStatus == '10') ? 'selected' : '' ?>>Conteúdos Publicados</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn fill-up fundo-roxo-padrao" id="btnBuscarFiltro">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Lista de Conteúdos-->
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="title"><strong><?= $textoTitulo ?></strong></p>
                            </div>
                            <div class="col-lg-2">
                                <?= (!$param) ? '<p>Aprovado em:</p>' : '' ?>
                            </div>
                            <div class="col-lg-2">
                                Recebido em:
                            </div>
                        </div>
                        <?php 
                        if (empty($tarefas)) : ?>
                                <div class="card">
                                    <div class="card-content">
                                        <div class="typo-line text-center">
                                            <h2 class="cor-roxo-escuro empty-title">Nenhum conteúdo encontrado</h2>
                                        </div>
                                    </div>
                                </div>
                            <?php else :
                                foreach ($tarefas as $tarefa) : ?>
                            <div class="card-tarefa">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p> <?= $tarefa->nome_tarefa ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p><?= (!$param) ? date('d/m/Y', strtotime(tarefas::dataAprovacao($tarefa->id_tarefa))) : '' ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p><?= date('d/m/Y', strtotime($tarefa->criacao_log)) ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="<?= ($tarefa->etapa > PAUTA_REAPROVACAO_CLIENTE) ? 'detalhes_conteudo' : 'detalhes_pauta' ?>.php?t=<?= $tarefa->id_tarefa ?>" class="btn fill-up fundo-roxo-escuro">Detalhes</a>
                                    </div>
                                </div>
                                <div class="badge"><?= $tarefa->nome_tipo ?></div>
                            </div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    
    <script>
    $(document).ready(function() {
        var siteBase = '<?= SITE ?>';
        $(".select-customizado").select2();

        $("#btnBuscarFiltro").click(function (e) { 
            var tipo = $("#filtroTipoTarefa").val();
            var status = $("#filtroStatusTarefa").val();
            window.location.href = siteBase + 'view/adm/dashboard.php?t='+tipo+'&s=' + status;
        });

        
        $('.select-customizado').on("change", function(e) {
            window.location.href = siteBase + 'view/adm/'+$(this).val();
        });
    });
    </script>
    
</html>