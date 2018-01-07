<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';
require_once 'includes/header_padrao.php';

$projetos = projetos::getByUsuario($_SESSION['id_usuario']);
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium - Projetos</title>
        <?php require_once './includes/header_imports.php'; ?>
    </head>

    <body>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 lista-projetos">
                        <img src="assets/img/logo-colorido.png" alt="Logo PostSpot">
                        <h1>Bem vindo novamente, <?= $_SESSION['nome_usuario'] ?>!</h1>
                        <p>Selecione o projeto que deseja acompanhar</p>
                        <hr>
                        <fieldset style="padding: 0px 60px;">
                            <div class="form-group">
                                <select class="form-control select-customizado" name="titulo_noticia">
                                    <option selected disabled>Procurar conta...</option>
                                    <?php foreach ($projetos as $projeto) : ?>
                                        <option value="<?= $projeto->id_projeto ?>"><?= $projeto->nome_projeto ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </fieldset>
                        <ul>
                            <?php foreach ($projetos as $projeto) : ?>
                            <a href="dashboard.php?p=<?= $projeto->id_projeto ?>"><li class="<?= ($projeto->id_projeto == $_SESSION['id_projeto']) ? 'active' : '' ?>"><?= $projeto->nome_projeto ?> <i class="fa fa-chevron-right"></i></li></a>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    <script>
        $(".select-customizado").select2();

        $('.select-customizado').on("change", function(e) {
        var siteBase = '<?= SITE ?>';
        window.location.href = siteBase + 'view/adm/dashboard.php?p='+$(this).val();
        });

    </script>
</html>