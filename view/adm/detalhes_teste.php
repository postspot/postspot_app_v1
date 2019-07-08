<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/conteudo_teste_candidato.php';
require_once '../../model/usuarios.php';
require_once 'includes/header_padrao.php';

if(isset($_GET["t"])){
    $teste = conteudo_teste_candidato::getById($_GET["t"]);
}


//pre_r($teste);
//die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Detalhes Teste - PostSpot</title>
        <?php require_once './includes/header_imports.php'; ?>
        <script src="ckeditor/ckeditor.js"></script>
        <script src="ckeditor/sample.js"></script>
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
                        <form action="../../controller/candidato/edita_teste.php" enctype="multipart/form-data" method="POST">
                            <input type="hidden" value="<?= $teste->id_conteudo_teste_candidato ?>" name="id_conteudo_teste_candidato">
                            <h4 class="title"><i class="ti-user"></i>Detalhes Testes</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Detalhes do teste
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Categoria</label>
                                                        <input type="text" class="form-control border-input" value="<?= $teste->nome_teste_candidato ?>" name="nome_teste_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Assunto</label>
                                                        <input type="text" class="form-control border-input" value="<?= $teste->nome_habilidade ?>" name="nome_habilidade">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Conteúdo do Teste</label>
                                                        <textarea name="especificacoes_conteudo_teste_candidato" id="editor"><?= $teste->especificacoes_conteudo_teste_candidato ?></textarea>
                                                    </div>
                                                    <button type="submit" class="pull-right">Salvar</button>
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
    
    iniciaCkeditor();
    </script>
</html>