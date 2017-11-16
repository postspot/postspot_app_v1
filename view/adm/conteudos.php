<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once '../../model/tipo_tarefa.php';
require_once 'includes/header_padrao.php';

if(isset($_GET["s"])){  
    $filtro = $_GET["s"];
    switch ($filtro) {
        case '1':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa >= '.CONTEUDO_ESCREVENDO);
            break;
        case '2':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = '.CONTEUDO_APROVACAO_CLIENTE.' OR l.etapa = '.CONTEUDO_REAPROVACAO_CLIENTE.')');
            break;
        case '3':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND l.etapa = '.CONTEUDO_AJUSTANDO);
            break;
        case '4':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = '.CONTEUDO_PUBLICADO);
            break;
        case '5':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND (l.etapa = '.CONTEUDO_ESCREVENDO.' OR l.etapa = '.CONTEUDO_AJUSTANDO.')');
            break;
        case '6':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND (l.etapa = '.CONTEUDO_APROVACAO_MODERADOR.' OR l.etapa = '.CONTEUDO_REAPROVACAO_MODERADOR.')');
            break;
        case '7':
            $conteudos = tarefas::getPautasDez($_SESSION['id_projeto'], 10 ,'AND l.etapa = '.CONTEUDO_PARA_PUBLICAR);
            break;
    }
}else{
    $filtro = 0;
    $conteudos = tarefas::getConteudosDez($_SESSION['id_projeto'], 10, '');
}
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
        <title>Post Stadium - Conteudos</title>
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
                        <h4 class="title"><i class="ti-light-bulb"></i> Conteúdos</h4>

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
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option value="" selected>Tipo</option>
                                                        <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                            <option value="<?= $tipoTarefa->id_tipo ?>"><?= $tipoTarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-2">
                                            <fieldset>
                                                <div class="form-group">
                                                    <select class="form-control">
                                                        <option value="" selected>Status</option>
                                                        <option value="">Pautas Produzindo</option>
                                                        <option value="">Pautas Aprovando</option>
                                                        <option value="">Pautas Ajustando</option>
                                                        <option value="">Reaprovando Pauta</option>
                                                        <option value="">Conteúdos Produzindo</option>
                                                        <option value="">Conteúdos Aprovando</option>
                                                        <option value="">Conteúdos Ajustando</option>
                                                        <option value="">Conteúdos Aprovação Final</option>
                                                        <option value="">Conteúdos Publicados</option>
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
                                            <a href="conteudos.php?s=1"><li class="<?= ($filtro == '1') ? 'active' : '' ?>"><div class="count"><?= $totalConteudos ?></div><div class="text">Todos Conteúdo</div></li></a>
                                            <a href="conteudos.php?s=5"><li class="<?= ($filtro == '5') ? 'active' : '' ?>"><div class="count"><?= $escrevendo ?></div><div class="text"><small>Conteúdos</small>Em Produção</div></li></a>
                                            <a href="conteudos.php?s=6"><li class="<?= ($filtro == '6') ? 'active' : '' ?>"><div class="count"><?= $aprovando_moderador ?></div><div class="text"><small>Conteúdos</small>Aprovação Moderador</div></li></a>
                                            <a href="conteudos.php?s=2"><li class="<?= ($filtro == '2') ? 'active' : '' ?>"><div class="count"><?= $aprovando ?></div><div class="text"><small>Conteúdos</small>Aprovação Cliente</div></li></a>
                                            <a href="conteudos.php?s=3"><li class="<?= ($filtro == '3') ? 'active' : '' ?>"><div class="count"><?= $ajustando ?></div><div class="text"><small>Conteúdos</small>Em Ajustes</div></li></a>
                                            <a href="conteudos.php?s=7"><li class="<?= ($filtro == '7') ? 'active' : '' ?>"><div class="count"><?= $para_publicar ?></div><div class="text"><small>Conteúdos</small>Para Publicar</div></li></a>
                                            <a href="conteudos.php?s=4"><li class="<?= ($filtro == '4') ? 'active' : '' ?>"><div class="count"><?= $publicados ?></div><div class="text"><small>Conteúdos</small>Publicados</div></li></a>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="title"><strong>Conteúdos</strong> em geral</p>
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
                                                    <h2>Nenhum conteúdo encontrado! <br><small>Toque no botão laranja "+" para criar uma pauta</small> </h2>
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
                                            <a href="detalhes_conteudo.php?t=<?= $conteudo->id_tarefa ?>" class="btn btn-success btn-fill fill-up btn-wd">Detalhes</a>
                                        </div>  
                                    </div>
                                </div>
                                <?php endforeach; endif;     ?>
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
            $(".select-customizado").select2();
    </script>
</html>