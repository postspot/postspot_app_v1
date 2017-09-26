<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_padrao.php';
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
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="card card-user">
                                    <div class="image">
                                        <img src="assets/img/background.jpg" alt="..."/>
                                    </div>
                                    <div class="card-content">
                                        <div class="author">
                                            <img class="avatar border-white" src="assets/img/faces/face-2.jpg" alt="..."/>
                                            <h4 class="card-title">Andress Bento<br />
                                                <a href="#"><small>Gerente</small></a>
                                            </h4>
                                        </div>
                                        <p class="description text-center">
                                            bento@gmail.com <br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Editar Perfil</h4>
                                    </div>
                                    <div class="card-content">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input type="text" class="form-control border-input" placeholder="Nome">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Sexo</label>
                                                        <select class="form-control border-input">
                                                            <option value="m">Masculino</option>
                                                            <option value="f">Feminino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Foto</label>
                                                        <input type="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Idioma</label>
                                                        <input type="text" class="form-control border-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Função</label>
                                                        <select class="form-control border-input">
                                                            <option value="0">Analista</option>
                                                            <option value="1">Cliente</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Habilidade</label>
                                                        <select class="form-control border-input">
                                                            <option value="0">Falar</option>
                                                            <option value="1">Escrever</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control border-input">
                                                    </div>
                                                </div>
                                                </div>
<!--                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Senha</label>
                                                        <input type="text" class="form-control border-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Confirmar Senha</label>
                                                        <input type="text" class="form-control border-input">
                                                    </div>
                                                </div>

                                            </div>-->
                                            <div>
                                                <button type="button" class="btn btn-warning btn-fill btn-wd" onclick="funcoes.showSwal('trocarSenha')">Trocar Senha</button>
                                                <button type="submit" class="btn btn-info btn-fill btn-wd pull-right">Atualizar Perfil</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
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