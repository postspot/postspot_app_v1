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
                        <h4 class="title"><i class="ti-user"></i> Cria Usuário</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Informações pessoais
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control border-input">
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Função</label>
                                                    <select class="form-control border-input">
                                                        <option value="0">Analista</option>
                                                        <option value="1">Cliente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Habilidade</label>
                                                    <select class="form-control border-input">
                                                        <option value="0">Falar</option>
                                                        <option value="1">Escrever</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-md-12 -->
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Informações Acesso
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control border-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Senha</label>
                                                    <input type="text" class="form-control border-input">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Confirmar Senha</label>
                                                    <input type="text" class="form-control border-input">
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
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