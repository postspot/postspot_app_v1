<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/estrategias.php';
require_once '../../model/linguagens.php';
require_once '../../model/categorias.php';
require_once '../../model/linguagens_estrategia.php';
require_once '../../model/categorias_estrategia.php';
require_once 'includes/header_padrao.php';

$estrategia = estrategias::getById($_SESSION['id_projeto']);
$linguagens = linguagens::getAll();
$categorias = categorias::getAll();
$linguagens_estrategia = linguagens_estrategia::getById($estrategia->id_estrategia);
$categorias_estrategias = categorias_estrategia::getById($estrategia->id_estrategia);
$linksReferenciasBanco = explode("\n", $estrategia->links); 
$linksSociaisBanco = explode("\n", $estrategia->links_ref);
$linksSociais = '';$linksReferencias = '';
foreach ($linksSociaisBanco as $linkSocial):
    $linksSociais .= '<li><a href="' . $linkSocial . '" target="_blank">' . $linkSocial . '</a></li>';
endforeach;
foreach ($linksReferenciasBanco as $linkReferencia):
    $linksReferencias .= '<li><a href="' . $linkReferencia . '" target="_blank">' . $linkReferencia . '</a></li>';
endforeach;
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
                                                        <?= ($_SESSION['funcao_usuario'] == 0)? '<li><a href="#editar" data-toggle="tab">Editar</a></li>' : '' ?>
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
                                                    <p><?= $estrategia->projeto ?></p>
                                                    <p><b>Blog:</b> <?= $estrategia->blog ?></p>
                                                    <hr>
                                                    <h3>Produtos e Serviço</h3>
                                                    <?= $estrategia->produtos_servicos ?>
                                                    <hr>
                                                    <h3>Links de Midia Sociais</h3>
                                                    <ol>
                                                        <?= $linksSociais ?>
                                                    </ol>
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
                                                    <?php foreach($linguagens_estrategia as $lingua):?>
                                                        <p><?=  $lingua->nome_linguagem ?></p> 
                                                    <?php endforeach;?>
                                                    <hr>
                                                    <h3>Links para Referências</h3>
                                                    <ol>
                                                        <?= $linksReferencias ?>
                                                    </ol>
                                                    <hr>
                                                    <h3>Categorias de conteúdo</h3>
                                                    <?php foreach($categorias_estrategias as $categ):?>
                                                        <p><?=  $categ->nome_categoria ?></p> 
                                                    <?php endforeach;?>
                                                    <hr>
                                                    <h3>Canais de aquisição de tráfego</h3>
                                                    <?= $estrategia->canais ?>
                                                    <hr>
                                                    <h3>Ações de marketing levantadas</h3>
                                                    <?= $estrategia->acoes ?>
                                                    <hr>
                                                    <h3>Considerações gerais de freelancers</h3>
                                                    <?= $estrategia->consideracoes_gerais ?>
                                                </div>
                                                <div class="tab-pane pane-pauta" id="editar">
                                                    <form class="" action="../../controller/estrategia/criar_estrategia.php" method="POST">
                                                    <div class="form-group">
                                                        <label>Sobre a empresa</label>
                                                        <p class="text-muted">Descreva brevemente a empresa ou o negócio.</p>
                                                        <textarea name="empresa" class="form-control" rows="3" placeholder="Descreve brevemente a empresa ou o negócio"><?= $estrategia->empresa ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Site</label>
                                                        <input name="site" type="text" placeholder="Informe o site" class="form-control" value="<?= $estrategia->site ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sobre o projeto</label>
                                                        <p class="text-muted">Descreva o projeto, caso ele seja um produto/serviço específico dentro da empresa</p>
                                                        <textarea name="projeto" class="form-control" rows="3" ><?= $estrategia->projeto ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Blog</label>
                                                        <input name="blog" type="text" placeholder="Informe o Blog" class="form-control" value="<?= $estrategia->blog ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Produtos e Serviço</label>
                                                        <p class="text-muted">Descreva os produtos e ou serviços que queremos vender com o Marketing de Conteúdo</p>
                                                        <textarea name="produtos_servicos" class="form-control" rows="3" ><?= $estrategia->produtos_servicos ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Links de Midia Sociais</label>
                                                        <p class="text-muted">Uma URL para cada tópico</p>
                                                        <textarea name="links" class="form-control" rows="3" ><?= $estrategia->links ?></textarea>                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Objetivo primário</label>
                                                        <select name="objetivo_primario" class="form-control">
                                                            <option value="0" <?=($estrategia->objetivo_primario == '0') ? 'selected="selected"' : ''?> disabled>Selecione um Objetivo</option>
                                                            <option value="Conhecimento de marca" <?=($estrategia->objetivo_primario == 'Conhecimento de marca') ? 'selected="selected"' : ''?>>Conhecimento de marca</option>
                                                            <option value="Geração de leads" <?=($estrategia->objetivo_primario == 'Geração de leads') ? 'selected="selected"' : ''?>>Geração de leads</option>
                                                            <option value="Educar o cliente" <?=($estrategia->objetivo_primario == 'Educar o cliente') ? 'selected="selected"' : ''?>>Educar o cliente</option>
                                                            <option value="Tornar-se referência" <?=($estrategia->objetivo_primario == 'Tornar-se referência') ? 'selected="selected"' : ''?>>Tornar-se referência</option>
                                                            <option value="Geração de tráfego" <?=($estrategia->objetivo_primario == 'Geração de tráfego') ? 'selected="selected"' : ''?>>Geração de tráfego</option>
                                                            <option value="Engajamento com a marca" <?=($estrategia->objetivo_primario == 'Engajamento com a marca') ? 'selected="selected"' : ''?>>Engajamento com a marca</option>
                                                            <option value="Outro" <?=($estrategia->objetivo_primario == 'Outro') ? 'selected="selected"' : ''?>>Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>KPIs de acompanhamento primário</label>
                                                        <select class="form-control" name="kpis_primario">
                                                            <option value="0" <?=($estrategia->kpis_primario == '0') ? 'selected="selected"' : ''?> selected="selected" disabled>Selecione um KPI</option>
                                                            <option value="Tráfego total" <?=($estrategia->kpis_primario == 'Tráfego total') ? 'selected="selected"' : ''?>>Tráfego total</option>
                                                            <option value="Tráfego orgânico" <?=($estrategia->kpis_primario == 'Tráfego orgânico') ? 'selected="selected"' : ''?>>Tráfego orgânico</option>
                                                            <option value="Leads gerados" <?=($estrategia->kpis_primario == 'Leads gerados') ? 'selected="selected"' : ''?>>Leads gerados</option>
                                                            <option value="Assinantes" <?=($estrategia->kpis_primario == 'Assinantes') ? 'selected="selected"' : ''?>>Assinantes</option>
                                                            <option value="Conversão" <?=($estrategia->kpis_primario == 'Conversão') ? 'selected="selected"' : ''?>>Conversão</option>
                                                            <option value="Taxa de cancelamento" <?=($estrategia->kpis_primario == 'Taxa de cancelamento') ? 'selected="selected"' : ''?>>Taxa de cancelamento</option>
                                                            <option value="Outro" <?=($estrategia->kpis_primario == 'Outro') ? 'selected="selected"' : ''?>>Outro</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Objetivo secundário</label>
                                                        <select class="form-control" name="objetivo_secundario">
                                                            <option value="0" <?=($estrategia->objetivo_secundario == '0') ? 'selected="selected"' : ''?> selected="selected" disabled>Selecione um Objetivo</option>
                                                            <option value="Conhecimento de marca" <?=($estrategia->objetivo_secundario == 'Conhecimento de marca') ? 'selected="selected"' : ''?>>Conhecimento de marca</option>
                                                            <option value="Geração de leads" <?=($estrategia->objetivo_secundario == 'Geração de leads') ? 'selected="selected"' : ''?>>Geração de leads</option>
                                                            <option value="Educar o cliente" <?=($estrategia->objetivo_secundario == 'Educar o cliente') ? 'selected="selected"' : ''?>>Educar o cliente</option>
                                                            <option value="Tornar-se referência" <?=($estrategia->objetivo_secundario == 'Tornar-se referência') ? 'selected="selected"' : ''?>>Tornar-se referência</option>
                                                            <option value="Geração de tráfego" <?=($estrategia->objetivo_secundario == 'Geração de tráfego') ? 'selected="selected"' : ''?>>Geração de tráfego</option>
                                                            <option value="Engajamento com a marca" <?=($estrategia->objetivo_secundario == 'Engajamento com a marca') ? 'selected="selected"' : ''?>>Engajamento com a marca</option>
                                                            <option value="Outro" <?=($estrategia->objetivo_secundario == 'Outro') ? 'selected="selected"' : ''?>>Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>KPIs de acompanhamento secundário</label>
                                                        <select class="form-control" name="kpis_secundario">
                                                            <option value="0" <?=($estrategia->kpis_secundario == '0') ? 'selected="selected"' : ''?> selected="selected" disabled>Selecione um KPI</option>
                                                            <option value="Tráfego total" <?=($estrategia->kpis_secundario == 'Tráfego total') ? 'selected="selected"' : ''?>>Tráfego total</option>
                                                            <option value="Tráfego orgânico" <?=($estrategia->kpis_secundario == 'Tráfego orgânico') ? 'selected="selected"' : ''?>>Tráfego orgânico</option>
                                                            <option value="Leads gerados" <?=($estrategia->kpis_secundario == 'Leads gerados') ? 'selected="selected"' : ''?>>Leads gerados</option>
                                                            <option value="Assinantes" <?=($estrategia->kpis_secundario == 'Assinantes') ? 'selected="selected"' : ''?>>Assinantes</option>
                                                            <option value="Conversão" <?=($estrategia->kpis_secundario == 'Conversão') ? 'selected="selected"' : ''?>>Conversão</option>
                                                            <option value="Taxa de cancelamento" <?=($estrategia->kpis_secundario == 'Taxa de cancelamento') ? 'selected="selected"' : ''?>>Taxa de cancelamento</option>
                                                            <option value="Outro" <?=($estrategia->kpis_secundario == 'Outro') ? 'selected="selected"' : ''?>>Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Concorrentes(de segmento e/ou palavras-chave)</label>
                                                        <textarea class="form-control" rows="3"  name="concorrentes"><?= $estrategia->concorrentes ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Com quem falar</label>
                                                        <p class="text-muted">Público que queremos atrair</p>
                                                        <textarea class="form-control" rows="3"  name="com_quem_falar"><?= $estrategia->com_quem_falar ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Com quem não falar</label>
                                                        <p class="text-muted">Público que não queremos atrair</p>
                                                        <textarea class="form-control" rows="3"  name="com_quem_nao_falar"><?= $estrategia->com_quem_nao_falar ?></textarea>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Abordar</label>
                                                        <p class="text-muted">Assuntos para <b>abordar</b> nos conteúdos</p>
                                                        <textarea class="form-control" rows="3"  name="abordar"><?= $estrategia->abordar ?></textarea>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>Evitar</label>
                                                        <p class="text-muted">Assuntos para <b>evitar</b> nos conteúdos</p>
                                                        <textarea class="form-control" rows="3"  name="evitar"><?= $estrategia->evitar ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="block">Linguagem</label>
                                                        <p class="text-muted">Descreve o tom e a voz da escrita</p>
                                                        <select multiple title="Escolha as Linguagens" class="selectpicker" data-style="no-border" data-size="7" name="linguagem[]">
                                                            <?php foreach($linguagens as $linguagem):
                                                                $selected = '';
                                                                foreach ($linguagens_estrategia as $linguagem_escolhida) {
                                                                    if($linguagem_escolhida->id_linguagem == $linguagem->id_linguagem){
                                                                        $selected = 'selected="selected"';
                                                                    }
                                                                }
                                                                ?>
                                                                <option value="<?= $linguagem->id_linguagem ?>" <?= $selected?>><?= $linguagem->nome_linguagem ?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Links para Referências</label>
                                                        <textarea class="form-control" rows="3"  name="links_ref"><?= $estrategia->links_ref ?></textarea>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Categorias de conteúdo</label>
                                                        <p class="text-muted">Selecione as duas ou três principais</p>                                              
                                                        <select require multiple title="Escolha as Categorias" class="selectpicker" data-style="no-border" data-size="7" name="categorias_conteudo[]">
                                                            <?php foreach($categorias as $categoria):
                                                                $selected = '';
                                                                foreach ($categorias_estrategias as $categoria_escolhida) {
                                                                    if($categoria->id_categoria == $categoria_escolhida->id_categoria){
                                                                        $selected = 'selected="selected"';
                                                                    }
                                                                }
                                                                ?>
                                                                <option value="<?= $categoria->id_categoria ?>" <?= $selected ?>><?= $categoria->nome_categoria ?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Canais de aquisição de tráfego</label>
                                                        <p class="text-muted">Liste os principais canais de aquisição de tráfego</p>
                                                        <input type="text"  class="form-control" name="canais" value="<?= $estrategia->canais ?>">
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Ações de marketing levantadas</label>
                                                        <p class="text-muted">Informações sobre ações de marketing passadas e seus resultados, separadas por quebra de linha</p>
                                                        <textarea class="form-control" rows="3"  name="acoes"><?= $estrategia->acoes ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Considerações gerais de freelancers</label>
                                                        <p class="text-muted">Considerações gerais de pauta devem ser atualizadas a cada ciclo</p>
                                                        <textarea class="form-control" rows="3"  name="consideracoes_gerais"><?= $estrategia->consideracoes_gerais ?></textarea>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Termos proibidos</label>
                                                        <p class="text-muted">Liste os termos proibidos para a estratégia do cliente, separados por vírgula</p>
                                                        <input type="text"  class="form-control" name="termos_proibidos" value="<?= $estrategia->termos_proibidos ?>">
                                                    </div>
                                                    <hr>
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
    <script>
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,1,'<b>Sucesso</b> - estratégia editada corretamente.');
            });
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            $(document).ready(function() {
                funcoes.showNotification(0,4,'<b>Erro</b> - estratégia não editada.');
            });
        <?php } ?>
    </script>
</html>