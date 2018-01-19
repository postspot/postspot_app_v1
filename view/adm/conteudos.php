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

if(isset($_GET["s"])){  
    $filtro = $_GET["s"];
    switch ($filtro) {
        case '1':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa >= '.CONTEUDO_ESCREVENDO . $filtroTipo);
            break;
        case '2':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = '.CONTEUDO_APROVACAO_CLIENTE.' OR l.etapa = '.CONTEUDO_REAPROVACAO_CLIENTE.')' . $filtroTipo);
            break;
        case '3':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND l.etapa = '.CONTEUDO_AJUSTANDO . $filtroTipo);
            break;
        case '4':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = '.CONTEUDO_PUBLICADO . $filtroTipo);
            break;
        case '5':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND (l.etapa = '.CONTEUDO_ESCREVENDO.' OR l.etapa = '.CONTEUDO_AJUSTANDO.')' . $filtroTipo);
            break;
        case '6':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND (l.etapa = '.CONTEUDO_APROVACAO_MODERADOR.' OR l.etapa = '.CONTEUDO_REAPROVACAO_MODERADOR.')' . $filtroTipo);
            break;
        case '7':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND l.etapa = '.CONTEUDO_PARA_PUBLICAR . $filtroTipo);
            break;
    }
}else{
    $filtro = 0;
    $conteudos = tarefas::getConteudosDez($_SESSION['id_projeto'], 10, $filtroTipo);
}
// pre_r($conteudos);
// die();
$totalConteudos = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], ">= ". CONTEUDO_ESCREVENDO);
$escrevendo = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= " . CONTEUDO_ESCREVENDO);
$aprovando_moderador = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= ". CONTEUDO_APROVACAO_MODERADOR ." OR l.etapa = ". CONTEUDO_REAPROVACAO_MODERADOR);
$aprovando = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= ".CONTEUDO_APROVACAO_CLIENTE." OR l.etapa = ".CONTEUDO_REAPROVACAO_CLIENTE);
$ajustando = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= " . CONTEUDO_AJUSTANDO);
$para_publicar = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= ".CONTEUDO_PARA_PUBLICAR);
$publicados = tarefas::countTarefasProjetoEtapa($_SESSION['id_projeto'], "= ".CONTEUDO_PUBLICADO);
$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
$totasTarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 1000, 'AND l.etapa >= '.CONTEUDO_ESCREVENDO);
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Conteúdos - PostSpot</title>
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
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">description</i> Conteúdos</h4>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-12 fundo-campos-busca">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control select-customizado" name="titulo_noticia">
                                                        <option selected disabled>Buscar pelo título...</option>
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
                                                        <option value="0" >Tipos de Conteúdos</option>
                                                        <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                            <option value="<?= $tipoTarefa->id_tipo ?>" <?= ($tipoTarefa->id_tipo == $codFiltroDesejado) ? 'selected' : '' ?>><?= $tipoTarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn fill-up fundo-roxo-padrao">Buscar</button>
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
                                            <a href="conteudos.php?s=1"><li class="<?= ($filtro == '1') ? 'active' : '' ?>"><div class="count"><?= $totalConteudos ?></div><div class="text">Todos os Conteúdo</div></li></a>
                                            <a href="conteudos.php?s=5"><li class="<?= ($filtro == '5') ? 'active' : '' ?>"><div class="count azul-um"><?= $escrevendo ?></div><div class="text"><small>Conteúdos</small>Em Produção</div></li></a>
                                            <a href="conteudos.php?s=6"><li class="<?= ($filtro == '6') ? 'active' : '' ?>"><div class="count azul-dois"><?= $aprovando_moderador ?></div><div class="text"><small>Conteúdos</small>Em Avaliação</div></li></a>
                                            <a href="conteudos.php?s=2"><li class="<?= ($filtro == '2') ? 'active' : '' ?>"><div class="count azul-tres"><?= $aprovando ?></div><div class="text"><small>Conteúdos</small>Em Aprovação</div></li></a>
                                            <a href="conteudos.php?s=3"><li class="<?= ($filtro == '3') ? 'active' : '' ?>"><div class="count azul-quatro"><?= $ajustando ?></div><div class="text"><small>Conteúdos</small>Em Ajustes</div></li></a>
                                            <a href="conteudos.php?s=7"><li class="<?= ($filtro == '7') ? 'active' : '' ?>"><div class="count azul-cinco"><?= $para_publicar ?></div><div class="text"><small>Conteúdos</small>Em Publicação</div></li></a>
                                            <a href="conteudos.php?s=4"><li class="<?= ($filtro == '4') ? 'active' : '' ?>"><div class="count azul-seis"><?= $publicados ?></div><div class="text"><small>Conteúdos</small>Publicados</div></li></a>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="title"><strong>Todos os Conteúdos</strong></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p>Status:</p>
                                    </div>
                                </div>
                                <?php 
                                    if(empty($conteudos)):?>
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="typo-line text-center">
                                                <h2 class="cor-roxo-escuro empty-title">Nenhum conteúdo encontrado</h2>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: 
                                    foreach ($conteudos as $conteudo): ?>
                                    <div class="card-tarefa">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p><?= $conteudo->nome_tarefa ?></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <p><?= retornaStatusTarefa($conteudo->etapa) ?></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="detalhes_conteudo.php?t=<?= $conteudo->id_tarefa ?>" class="btn fill-up fundo-roxo-escuro">Ver Conteúdo</a>
                                        </div>  
                                    </div>
                                            <div class="badge"><?= $conteudo->nome_tipo ?></div>
                                </div>
                                <?php endforeach; endif;     ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

    <script>
        $(document).ready(function () {
            $(".select-customizado").select2();

            
            $('.select-customizado').on("change", function(e) {
                var siteBase = '<?= SITE ?>';
                window.location.href = siteBase + 'view/adm/detalhes_conteudo.php?t='+$(this).val();
            });

            $('#filtroTipoTarefa').on("change", function(e) {
                var siteBase = '<?= SITE ?>';
                var statusPautasParam = (<?= $filtro ?> > 0) ? <?= $filtro ?> : 1;
                window.location.href = siteBase + 'view/adm/conteudos.php?t='+$(this).val()+'&s=' + statusPautasParam;
            });
        });
    </script>
</html>