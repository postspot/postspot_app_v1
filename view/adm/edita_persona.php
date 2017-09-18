<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
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
                        <h4 class="title"><i class="ti-user"></i> Edita Persona</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <img id="fotoPersona" class="avatar border-white" src="assets/img/faces/face-2.jpg" alt="Foto Persona">                                                    
                                                </div>
                                                <button class="btn btn-fill btn-success" onclick="funcoes.showSwal('personas')">Escolher Foto</button>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control border-input">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Idade</label>
                                                    <input type="number" class="form-control border-input">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Sexo</label>
                                                    <select class="form-control border-input">
                                                        <option value="m">Masculino</option>
                                                        <option value="f">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Características</label>
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Educação</label>
                                                    <input type="text" class="form-control border-input">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Trabalho</label>
                                                    <input type="text" class="form-control border-input">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Segmento</label>
                                                    <input type="text" class="form-control border-input">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Seus objetivos são:</label>
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Seus problemas são:</label>
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Como vamos ajudar?</label>
                                                    <textarea rows="5" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill btn-info pull-right">Salvar</button>                                               
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
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
</html>