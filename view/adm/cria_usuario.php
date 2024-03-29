<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/habilidades.php';
require_once '../../model/idiomas.php';
require_once 'includes/header_adm.php';

$habilidades = habilidades::getAllSkills();
$idiomas = idiomas::getAllIdiomas();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Cria Usuário - PostSpot</title>
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
                        <form action="../../controller/usuario/criar_usuario.php" enctype="multipart/form-data" method="POST" id="formCriaUsuario">
                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">group</i> Cria Usuário</h4>
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
                                                    <input type="text" class="form-control border-input" name="nome_usuario" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sexo</label>
                                                    <select class="form-control border-input" name="sexo_usuario">
                                                        <option value="m">Masculino</option>
                                                        <option value="f">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Foto</label>
                                                    <input type="file" class="form-control" name="foto_usuario">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Função</label>
                                                    <select class="form-control border-input" name="funcao_usuario">
                                                        <option value="0">Gestor</option>
                                                        <option value="1">Analista</option>
                                                        <option value="2">Redator</option>
                                                        <option value="3">Cliente</option>
                                                        <option value="4">Designer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="block">Idiomas</label>
                                                    <?php foreach ($idiomas as $idioma): ?>
                                                        <div class="checkbox checkbox-inline">
                                                            <input id="checkIdioma<?= $idioma->id_idioma ?>" type="checkbox" value="<?= $idioma->id_idioma ?>" name="idioma[]">
                                                            <label for="checkIdioma<?= $idioma->id_idioma ?>">
                                                                <?= $idioma->nome_idioma ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach;?>
	                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Habilidade</label>
                                                    <select multiple title="Escolha as Habilidades" class="selectpicker" data-style="no-border" data-size="7" name="habilidade[]">
                                                        <?php foreach($habilidades as $habilidade):?>
                                                            <option value="<?= $habilidade->id_habilidade ?>"><?= $habilidade->nome_habilidade ?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Descrição usuário</label>
                                                    <textarea rows="5" name="obs" class="form-control border-input" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CPF / CNPJ</label>
                                                    <input type="text" class="form-control border-input" name="doc_usuario">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Banco</label>
                                                    <input type="text" class="form-control border-input" name="banco_usuario">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agência</label>
                                                    <input type="text" class="form-control border-input" name="agencia_usuario">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Conta Corrente</label>
                                                    <input type="text" class="form-control border-input" name="conta_usuario">
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
                                                    <label>E-mail</label>
                                                    <input type="email" class="form-control border-input" name="email_usuario" email="true" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Senha</label>
                                                    <input type="password" class="form-control border-input" name="senha_usuario" id="senhaUser" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Confirmar Senha</label>
                                                    <input type="password" class="form-control border-input" name="confirmacao" equalTo="#senhaUser">
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill pull-right fundo-rosa-claro">Salvar</button>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-md-12 -->
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

    
    <script>
    $(document).ready(function() {
        $('#formCriaUsuario').validate();
    });
    </script>
</html>