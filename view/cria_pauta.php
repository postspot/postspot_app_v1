<?php
require_once '../config/config.php';
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
                        <h4 class="title"><i class="ti-light-bulb"></i> Criar Pauta</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <form class="form-horizontal">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <!--Preencha as informações abaixo-->
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Título</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="Título da Pauta" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Tipo</label>
                                                <div class="col-md-4">
                                                    <select class="form-control">
                                                        <option>Blog Post</option>
                                                        <option>Ebook</option>
                                                        <option>Newsletter</option>
                                                        <option>Social Post</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Palavra Chave</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Briefing</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Estágio de Compra</label>
                                                <div class="col-md-10">

                                                    <div class="radio">
                                                        <input type="radio" name="estagio" id="estagio1" value="option1" checked="">
                                                        <label for="estagio1">
                                                            Aprendizado e Descoberta
                                                        </label>
                                                    </div>

                                                    <div class="radio">
                                                        <input type="radio" name="estagio" id="estagio2" value="option2">
                                                        <label for="estagio2">
                                                            Reconhecimento do Problema
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="estagio" id="estagio3" value="option2">
                                                        <label for="estagio3">
                                                            Consideração da Solução
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="estagio" id="estagio4" value="option2">
                                                        <label for="estagio4">
                                                            Decisão de Compra
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Persona</label>
                                                <div class="col-md-4">
                                                    <select class="form-control">
                                                        <option>Persona 1</option>
                                                        <option>Persona 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Tipo de CTA</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Referências</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Considerações Gerais</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group">
                                                <div class="col-md-3 col-md-offset-2">
                                                    <button type="button" class="btn btn-wd btn-info btn-fill btn-magnify pull-left">
                                                        <span class="btn-label">
                                                            <i class="ti-save"></i>
                                                        </span>
                                                        Salvar
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-wd btn-success btn-fill btn-move-right pull-right">
                                                        Enviar Aprovação
                                                        <span class="btn-label">
                                                            <i class="ti-control-forward"></i>
                                                        </span>
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
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

</html>