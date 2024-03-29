<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
require_once '../../model/tipo_tarefa.php';
require_once 'includes/header_padrao.php';
$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
$persona = personas::getByProjeto($_SESSION['id_projeto']);
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Cria Pauta - PostSpot</title>
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
                        
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">list</i> Criar Pauta</h4>
                        <div class="row">
                            <form class="form-horizontal" action="../../controller/pautas/criar_pauta.php" method="POST" id="formCriaPauta" novalidate="">
                                <div class="col-md-8">
                                    <div class="card">
                                        <input type="hidden" name="aprovacao" id="controlaAprovacao">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <!--Preencha as informações abaixo-->
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Título</label>
                                                <div class="col-md-9">
                                                    <input required type="text" placeholder="Título da Pauta" name="nome_tarefa" class="form-control" required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Tipo</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="tipo_tarefa">
                                                        <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                            <option value="<?= $tipoTarefa->id_tipo ?>"><?= $tipoTarefa->nome_tarefa ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Palavra-chave</label>
                                                <div class="col-md-9">
                                                    <input required type="text" class="form-control" name="palavra_chave" required="true">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Briefing</label>
                                                <div class="col-md-9">
                                                    <textarea  required="true" rows="5" class="form-control border-input" placeholder="" name="briefing_tarefa"></textarea>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Estágio da Jornada de Compra</label>
                                                <div class="col-md-9">

                                                    <div class="radio">
                                                        <input type="radio" name="estagio_compra" id="estagio1" value="Conhecimento" checked="">
                                                        <label for="estagio1">
                                                            Conhecimento
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="estagio_compra" id="estagio3" value="Consideração">
                                                        <label for="estagio3">
                                                            Consideração
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="estagio_compra" id="estagio4" value="Decisão">
                                                        <label for="estagio4">
                                                            Decisão
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Persona</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="id_persona"  required="true">
                                                        <?php if(empty($persona)): ?>
                                                            <option value="" disabled selected>Nenhuma persona cadastrada!</option>
                                                        <?php else:
                                                        foreach ($persona as $pers) {
                                                        ?>
                                                        
                                                        <option value="<?= $pers->id_persona ?>"><?= $pers->nome ?></option>
                                                        
                                                        <?php
                                                        } endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Tipo de CTA</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder="" name="tipo_cta" required="true"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Referências</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder="" name="referencias" required="true"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Considerações Gerais</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder="" name="consideracoes_gerais" required="true"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Ação necessária</h4>
                                        </div>
                                        <div class="card-content">
                                            <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem fundo-roxo-escuro" id="salvaPauta">
                                                <span class="btn-label">
                                                    <i class="material-icons">save</i>
                                                </span>
                                                Salvar Pauta
                                            </button>
                                            <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem azul-cinco" id="enviaAprovacaoPauta">
                                                <span class="btn-label">
                                                    <i class="material-icons">fast_forward</i>
                                                </span>
                                                Enviar Moderador
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    
    <script>
    $(document).ready(function () {
        
        $('#formCriaPauta').validate();

        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'nErro') { ?>
            funcoes.showNotification(0,4,'<b>Erro</b> ao criar pauta.');
        <?php } ?>

        $("#salvaPauta").click(function (e) { 
            e.preventDefault();
            $("#controlaAprovacao").val('0');
            $("#formCriaPauta").submit();
        });
        $("#enviaAprovacaoPauta").click(function (e) { 
            e.preventDefault();
            $("#controlaAprovacao").val('1');
            $("#formCriaPauta").submit();            
        });
    });
    </script>
</html>