<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/estrategias.php';

$estrategia = estrategias::getById(1);
//pre_r($estrategia);
//die();
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

                    <div class="content">
                        <div class="container-fluid">
                            <h4 class="title"><i class="ti-direction-alt"></i> Estratégia</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="nav-tabs-navigation">
                                                <div class="nav-tabs-wrapper">
                                                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                        <li class="active"><a href="#estrategia" data-toggle="tab">Estratégia</a></li>
                                                        <li><a href="#editar" data-toggle="tab">Editar</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="tab-persona" class="tab-content">
                                                <div class="tab-pane pane-pauta active" id="estrategia">
                                                    <h3>Sobre a empresa</h3>
                                                    <p><?= $estrategia->empresa ?></p>
                                                    <p><strong>Site:</strong> <?= $estrategia->site ?></p>
                                                    <hr>
                                                    <h3>Sobre o projeto</h3>
                                                    <?= $estrategia->projeto ?>
                                                    <hr>
                                                    <h3>Produtos e Serviço</h3>
                                                    <?= $estrategia->produtos_servicos ?>
                                                    <hr>
                                                    <h3>Links de Midia Sociais</h3>
                                                    <?= $estrategia->links ?>
                                                    <hr>
                                                    <h3>Objetivo primário</h3>
                                                    <?= $estrategia->objetivo_primario ?>
                                                    <hr>
                                                    <h3>KPIs de acompanhamento primário</h3>
                                                    <?= $estrategia->kpis_primario ?>
                                                    <hr>
                                                    <h3>Objetivo secundário</h3>
                                                    <?= $estrategia->objetivo_secundario ?>
                                                    <hr>
                                                    <h3>KPIs de acompanhamento secundário</h3>
                                                    <?= $estrategia->kpis_secundario ?>
                                                    <hr>
                                                    <h3>Concorrentes(de segmento e/ou palavras-chave)</h3>
                                                    <?= $estrategia->concorrentes ?>
                                                    <hr>
                                                    <h3>Com quem falar</h3>
                                                    <?= $estrategia->com_quem_falar ?>
                                                    <hr>
                                                    <h3>Com quem não falar</h3>
                                                    <?= $estrategia->com_quem_nao_falar ?>
                                                    <hr>
                                                    <h3>Abordar</h3>
                                                    <?= $estrategia->abordar ?>
                                                    <hr>
                                                    <h3>Evitar</h3>
                                                    <?= $estrategia->evitar ?>
                                                    <hr>
                                                    <h3>Linguagem</h3>
                                                    <?= $estrategia->linguagem ?>
                                                    <hr>
                                                    <h3>Links para Referências</h3>
                                                    <?= $estrategia->links_ref ?>
                                                    <hr>
                                                    <h3>Categorias de conteúdo</h3>
                                                    <?= $estrategia->categorias_conteudo ?>
                                                    <hr>
                                                    <h3>Canais de aquisição de tráfeco</h3>
                                                    <?= $estrategia->canais ?>
                                                    <hr>
                                                    <h3>Ações de marketing levantadas</h3>
                                                    <?= $estrategia->acoes ?>
                                                    <hr>
                                                    <h3>Considerações gerais de freelancers</h3>
                                                    <?= $estrategia->consideracoes_gerais ?>
                                                </div>
                                                <div class="tab-pane" id="editar">
                                                    <form class="" action="../../controller/estrategia/criar_estrategia.php" method="POST">
                                                    <div class="form-group">
                                                        <label>Sobre a empresa</label>
                                                        <textarea name="empresa" class="form-control" rows="3" placeholder="Descreve brevemente a empresa ou o negócio"><?= $estrategia->empresa ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Site</label>
                                                        <input name="site" type="text" placeholder="Informe o site" class="form-control" value="<?= $estrategia->site ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sobre o projeto</label>
                                                        <textarea name="projeto" class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa"><?= $estrategia->projeto ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Blog</label>
                                                        <input name="blog" type="text" placeholder="Informe o Blog" class="form-control" value="<?= $estrategia->blog ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Produtos e Serviço</label>
                                                        <textarea name="produtos_servicos" class="form-control" rows="3" placeholder="Descreve os produtos e ou serviços que queremos vender com o Marketing de Conteúdo"><?= $estrategia->produtos_servicos ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Links de Midia Sociais</label>
                                                        <input name="links" type="text" placeholder="Informe a url" class="form-control" value="<?= $estrategia->links ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Objetivo primário</label>
                                                        <select name="objetivo_primario" class="form-control">
                                                            <option value="0" selected disabled>Educar Cliente</option>
                                                            <option value="1">Vender</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>KPIs de acompanhamento primário</label>
                                                        <select class="form-control" name="kpis_primario">
                                                            <option value="0" selected disabled>Educar Cliente</option>
                                                            <option value="1">Vender</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Objetivo secundário</label>
                                                        <select class="form-control" name="objetivo_secundario">
                                                            <option value="0" selected disabled>Geração de Leads</option>
                                                            <option value="1">Vender</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>KPIs de acompanhamento secundário</label>
                                                        <select class="form-control" name="kpis_secundario">
                                                            <option value="0" selected disabled>Lead gerados</option>
                                                            <option value="1">Vender</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Concorrentes(de segmento e/ou palavras-chave)</label>
                                                        <input type="text" placeholder="Informe a url" class="form-control" name="concorrentes" value="<?= $estrategia->concorrentes ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Com quem falar</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="com_quem_falar"><?= $estrategia->com_quem_falar ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Com quem não falar</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="com_quem_nao_falar"><?= $estrategia->com_quem_nao_falar ?></textarea>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Abordar</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="abordar"><?= $estrategia->abordar ?></textarea>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>Evitar</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="evitar"><?= $estrategia->evitar ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Linguagem</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="linguagem"><?= $estrategia->linguagem ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Links para Referências</label>
                                                        <input type="text" placeholder="Informe a url" class="form-control" name="links_ref" value="<?= $estrategia->links_ref ?>">
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Categorias de conteúdo</label>
                                                        <input type="text" placeholder="Informe a url" class="form-control" name="categorias_conteudo" value="<?= $estrategia->categorias_conteudo ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Canais de aquisição de tráfeco</label>
                                                        <input type="text" placeholder="Informe a url" class="form-control" name="canais" value="<?= $estrategia->canais ?>">
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Ações de marketing levantadas</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="acoes"><?= $estrategia->acoes ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Considerações gerais de freelancers</label>
                                                        <textarea class="form-control" rows="3" placeholder="Descreve o projeto, caso ele seja um produto/serviço específico de uma empresa" name="consideracoes_gerais"><?= $estrategia->consideracoes_gerais ?></textarea>
                                                    </div>
                                                    <hr>
                                                    <input type="hidden" name="id_projeto" value="1" class="form-control border-input">
                                                    <button type="submit" class="btn btn-fill btn-success pull-right">Salvar</button>
                                                    <div class="clearfix"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-md-12 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
</html>