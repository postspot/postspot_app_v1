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
                                                    <p><?= $estrategia->projeto ?></p>
                                                    <p><b>Blog:</b> <?= $estrategia->blog ?></p>
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
                                                            <option value="" selected="selected" disabled>Selecione um Objetivo</option>
                                                            <option value="Conhecimento de marca">Conhecimento de marca</option>
                                                            <option value="Geração de leads">Geração de leads</option>
                                                            <option value="Educar o cliente">Educar o cliente</option>
                                                            <option value="Tornar-se referência">Tornar-se referência</option>
                                                            <option value="Geração de tráfego">Geração de tráfego</option>
                                                            <option value="Engajamento com a marca">Engajamento com a marca</option>
                                                            <option value="Outro">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>KPIs de acompanhamento primário</label>
                                                        <select class="form-control" name="kpis_primario">
                                                            <option value="Selecione um KPI" selected="selected" disabled>Selecione um KPI</option>
                                                            <option value="Tráfego total">Tráfego total</option>
                                                            <option value="Tráfego orgânico">Tráfego orgânico</option>
                                                            <option value="Leads gerados">Leads gerados</option>
                                                            <option value="Assinantes">Assinantes</option>
                                                            <option value="Conversão">Conversão</option>
                                                            <option value="Taxa de cancelamento">Taxa de cancelamento</option>
                                                            <option value="Outro">Outro</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Objetivo secundário</label>
                                                        <select class="form-control" name="objetivo_secundario">
                                                            <option value="" selected="selected" disabled>Selecione um Objetivo</option>
                                                            <option value="Conhecimento de marca">Conhecimento de marca</option>
                                                            <option value="Geração de leads">Geração de leads</option>
                                                            <option value="Educar o cliente">Educar o cliente</option>
                                                            <option value="Tornar-se referência">Tornar-se referência</option>
                                                            <option value="Geração de tráfego">Geração de tráfego</option>
                                                            <option value="Engajamento com a marca">Engajamento com a marca</option>
                                                            <option value="Outro">Outro</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>KPIs de acompanhamento secundário</label>
                                                        <select class="form-control" name="kpis_secundario">
                                                            <option value="Selecione um KPI" selected="selected" disabled>Selecione um KPI</option>
                                                            <option value="Tráfego total">Tráfego total</option>
                                                            <option value="Tráfego orgânico">Tráfego orgânico</option>
                                                            <option value="Leads gerados">Leads gerados</option>
                                                            <option value="Assinantes">Assinantes</option>
                                                            <option value="Conversão">Conversão</option>
                                                            <option value="Taxa de cancelamento">Taxa de cancelamento</option>
                                                            <option value="Outro">Outro</option>
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
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem" type="checkbox" name="linguagem[]" value="Entusiasmado">
                                                            <label for="linguagem">
                                                                Entusiasmado
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem2" type="checkbox" name="linguagem[]" value="Especialista">
                                                            <label for="linguagem2">
                                                            Especialista
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem3" type="checkbox" name="linguagem[]" value="Prestativo">
                                                            <label for="linguagem3">
                                                            Prestativo
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem4" type="checkbox" name="linguagem[]" value="Informativo">
                                                            <label for="linguagem4">
                                                            Informativo
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem5" type="checkbox" name="linguagem[]" value="Franco">
                                                            <label for="linguagem5">
                                                            Franco
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem6" type="checkbox" name="linguagem[]" value="Autoritário">
                                                            <label for="linguagem6">
                                                            Autoritário
                                                            </label>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem7" type="checkbox" name="linguagem[]" value="Casual">
                                                            <label for="linguagem7">
                                                            Casual
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem8" type="checkbox" name="linguagem[]" value="Atrevido">
                                                            <label for="linguagem8">
                                                            Atrevido
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem9" type="checkbox" name="linguagem[]" value="Convencional">
                                                            <label for="linguagem9">
                                                            Convencional
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem10" type="checkbox" name="linguagem[]" value="Cortês">
                                                            <label for="linguagem10">
                                                            Cortês
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem11" type="checkbox" name="linguagem[]" value="Criativo">
                                                            <label for="linguagem11">
                                                            Criativo
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="linguagem12" type="checkbox" name="linguagem[]" value="Emocionado">
                                                            <label for="linguagem12">
                                                            Emocionado
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Links para Referências</label>
                                                        <textarea class="form-control" rows="3"  name="links_ref"><?= $estrategia->links_ref ?></textarea>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label>Categorias de conteúdo</label>
                                                        <p class="text-muted">Selecione as duas ou três principaiis</p>
                                                        <input type="text"  class="form-control" name="categorias_conteudo" value="<?= $estrategia->categorias_conteudo ?>">
                                                        <select name="" id="">
                                                        <option value="56">Atendimento ao Cliente</option>
                                                            <option value="Automobilismo">Automobilismo</option>
                                                            <option value="Big Data">Big Data</option>
                                                            <option value="44">Business Intelligence</option>
                                                            <option value="49">Call Center e VoIP</option>
                                                            <option value="22">Carreira</option>
                                                            <option value="38">Casa e Jardim</option>
                                                            <option value="24">Comportamento</option>
                                                            <option value="46">Contabilidade</option>
                                                            <option value="28">Design</option>
                                                            <option value="63">Diagramação</option>
                                                            <option value="27">DIY (Faça você mesmo)</option>
                                                            <option value="29">E-commerce</option>
                                                            <option value="5">Economia e Finanças</option>
                                                            <option value="2">Educação</option>
                                                            <option value="6">Empreendedorismo e Startups</option>
                                                            <option value="8">Engenharia</option>
                                                            <option value="12">Entretenimento</option>
                                                            <option value="4">Esportes e Fitness</option>
                                                            <option value="30">Estética e Beleza</option>
                                                            <option value="58">Fotografia</option>
                                                            <option value="17">Gastronomia</option>
                                                            <option value="52">Gestão de Projetos</option>
                                                            <option value="31">Gestão e Administração</option>
                                                            <option value="60">Inovação</option>
                                                            <option value="26">Lei e Direito</option>
                                                            <option value="32">Logística</option>
                                                            <option value="1">Marketing</option>
                                                            <option selected="selected" value="23">Marketing Digital</option>
                                                            <option value="57">Medicina e Gestão Hospitalar</option>
                                                            <option value="18">Meio Ambiente</option>
                                                            <option value="37">Mercado Imobiliário</option>
                                                            <option value="16">Moda</option>
                                                            <option value="33">Negócios</option>
                                                            <option value="59">Nutrição</option>
                                                            <option value="65">Odontologia</option>
                                                            <option value="55">Pauta</option>
                                                            <option value="45">Pequenas e Médias Empresas</option>
                                                            <option value="66">Produção de Eventos</option>
                                                            <option value="43">Produção de Textos</option>
                                                            <option value="48">Programação e APIs</option>
                                                            <option value="42">Recursos Humanos e Comunicação Interna</option>
                                                            <option value="67">Redação em Espanhol</option>
                                                            <option value="14">Revisão</option>
                                                            <option value="10">Saúde e Bem-estar</option>
                                                            <option value="47">Segurança Digital</option>
                                                            <option value="36">Tecnologia da Informação</option>
                                                            <option value="40">Traduções</option>
                                                            <option value="25">Turismo</option>
                                                            <option value="39">Vendas</option>
                                                            <option value="64">Veterinária</option>
                                                            <option value="62">X PREMIUM</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Canais de aquisição de tráfeco</label>
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
                                                        <input type="text"  class="form-control" name="xxxx" value="<?= $estrategia->xxx ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mapeamentos de conteúdo</label>
                                                        <textarea class="form-control" rows="3"  name="xxxx"><?= $estrategia->xxxx ?></textarea>
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