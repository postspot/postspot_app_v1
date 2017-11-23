<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once '../../model/tipo_tarefa.php';
require_once 'includes/header_padrao.php';

if (isset($_GET["t"])) {
    $codFiltroDesejado = $_GET["t"];
    $filtroTipo = ' AND t.id_tipo = '. $codFiltroDesejado ;
}else{
    $codFiltroDesejado = '0';
    $filtroTipo = '';
}
if (isset($_GET["s"])) {
    $filtro = $_GET["s"];
    switch ($filtro) {
        case '1':
            $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa >= ' . PAUTA_ESCREVENDO . $filtroTipo);
            break;
        case '2':
            $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = '. PAUTA_APROVACAO_CLIENTE .' OR l.etapa = '. PAUTA_REAPROVACAO_CLIENTE .')' . $filtroTipo);
            break;
        case '3':
            $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . PAUTA_AJUSTANDO . $filtroTipo);
            break;
        case '4':
            $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa > ' . PAUTA_REAPROVACAO_CLIENTE . $filtroTipo);
            break;
        case '5':
            $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . PAUTA_ESCREVENDO . $filtroTipo);
            break;
        case '6':
            $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = ' . PAUTA_APROVACAO_MODERADOR.' OR l.etapa = '. PAUTA_REAPROVACAO_MODERADOR .')' . $filtroTipo);
            break;
    }
} else {
    $filtro = 0;
    $pautas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, $filtroTipo);
}
// pre_r($pautas);
// die();
$totalPautas = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], '>= '. PAUTA_ESCREVENDO);
$escrevendo = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], '= '.PAUTA_ESCREVENDO);
$aprovando = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], '= '.PAUTA_APROVACAO_CLIENTE.' OR l.etapa = '.PAUTA_REAPROVACAO_CLIENTE);
$ajustando = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], '= ' .PAUTA_AJUSTANDO);
$aprovadas = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], '> '. PAUTA_REAPROVACAO_CLIENTE);
$aprovando_moderador = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], '= '. PAUTA_APROVACAO_MODERADOR. ' OR l.etapa = ' . PAUTA_REAPROVACAO_MODERADOR);
$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
$totasTarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 1000, 'AND l.etapa >= 0');
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium - Pautas</title>
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
                        <h4 class="title"><i class="ti-light-bulb"></i> Pautas</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12 fundo-campos-busca">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control select-customizado" name="titulo_noticia">
                                                        <option selected disabled>Buscar pelo nome...</option>
                                                        <?php foreach ($totasTarefas as $tarefa):?>
                                                            <option value="<?= $tarefa->id_tarefa ?>"><?= $tarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-4">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control" id="filtroTipoTarefa">
                                                        <option value="0" >Tipos de Pautas</option>
                                                        <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                            <option value="<?= $tipoTarefa->id_tipo ?>" <?= ($tipoTarefa->id_tipo == $codFiltroDesejado) ? 'selected' : '' ?>><?= $tipoTarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-info btn-fill fill-up">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card card-resumo-tarefas">
                                    <div class="card-content">
                                        <ol class="list-unstyled">
                                            <a href="pautas.php?s=1"><li class="<?= ($filtro == '1') ? 'active' : '' ?>"><div class="count"><?= $totalPautas ?></div><div class="text">Todas as Pautas</div></li></a>
                                            <a href="pautas.php?s=5"><li class="<?= ($filtro == '5') ? 'active' : '' ?>"><div class="count"><?= $escrevendo ?></div><div class="text"><small>pautas</small>Em Produção</div></li></a>
                                            <a href="pautas.php?s=6"><li class="<?= ($filtro == '6') ? 'active' : '' ?>"><div class="count"><?= $aprovando_moderador ?></div><div class="text"><small>pautas</small>Aprovação moderador</div></li></a>
                                            <a href="pautas.php?s=2"><li class="<?= ($filtro == '2') ? 'active' : '' ?>"><div class="count"><?= $aprovando ?></div><div class="text"><small>pautas</small>Aprovação cliente</div></li></a>
                                            <a href="pautas.php?s=3"><li class="<?= ($filtro == '3') ? 'active' : '' ?>"><div class="count"><?= $ajustando ?></div><div class="text"><small>pautas</small>Em ajustes</div></li></a>
                                            <a href="pautas.php?s=4"><li class="<?= ($filtro == '4') ? 'active' : '' ?>"><div class="count"><?= $aprovadas ?></div><div class="text"><small>pautas</small>Aprovadas</div></li></a>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="title"><strong>Pautas</strong> em geral</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>Status:</p>
                                    </div>
                                </div>
                                <?php if (empty($pautas)): ?>
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="typo-line text-center">
                                                <h2>Nenhuma pauta encontrada! <br><small>Toque no botão laranja "+" para criar uma pauta</small> </h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php else:
                                    foreach ($pautas as $pauta):
                                        ?>
                                        <div class="card-tarefa">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p><?= $pauta->nome_tarefa ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <p><?= retornaStatusTarefa($pauta->etapa) ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <a href="detalhes_pauta.php?t=<?= $pauta->id_tarefa ?>" class="btn btn-success btn-fill fill-up btn-wd">Detalhes</a>
                                                </div>  
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($_SESSION['funcao_usuario'] == '0' || $_SESSION['funcao_usuario'] == '1'):?>
                        <a href="cria_pauta.php" class="btn btn-icon btn-fixed">
                            <i class="ti-plus"></i>
                        </a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </body>

<?php require_once './includes/footer_imports.php'; ?>

    <script>
        $(document).ready(function () {
<?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'apOk') { ?>
                funcoes.showNotification(0, 1, '<b>Sucesso</b> - Pauta aprovada.');
<?php } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'nOk') { ?>
                funcoes.showNotification(0, 1, '<b>Sucesso</b> - Pauta salva.');
<?php } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'naOk') { ?>
                funcoes.showNotification(0, 1, '<b>Sucesso</b> - Pauta enviada para aprovação.');
<?php } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'reOk') { ?>
                funcoes.showNotification(0, 1, '<b>Sucesso</b> - Pauta reprovada.');
<?php } ?>
        });

        $(".select-customizado").select2();

        $('.select-customizado').on("change", function(e) {
         var siteBase = '<?= SITE ?>';
         window.location.href = siteBase + 'view/adm/detalhes_pauta.php?t='+$(this).val();
        });

        $('#filtroTipoTarefa').on("change", function(e) {
         var siteBase = '<?= SITE ?>';
         var statusPautasParam = (<?= $filtro ?> > 0) ? <?= $filtro ?> : '';
         window.location.href = siteBase + 'view/adm/pautas.php?t='+$(this).val()+'&s=' + statusPautasParam;
        });
    </script>
</html>