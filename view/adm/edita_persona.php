<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
require_once 'includes/header_padrao.php';

if(isset($_GET["persona"])){
    $persona = personas::getById($_GET["persona"]);
}

//pre_r($persona);
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
                    <div class="container-fluid">
                        <h4 class="title"><i class="ti-user"></i> Edita Persona</h4>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                    <form action="../../controller/persona/edita_persona.php" method="POST">
                                    <input type="hidden" name="id_persona" value="<?= $persona->id_persona ?>">
                                <div class="card-content">
                                        <div class="row">

                                            <div class="col-md-2">
                                                
                                                <div class="form-group">
                                                    <input type="hidden" name="foto" value="<?= $persona->foto ?>" class="form-control border-input" id="hiddenFotoPersona">
                                                    <img id="fotoPersona" class="avatar border-white" src="assets/img/faces/<?= $persona->foto ?>" alt="Foto Persona">                                                    
                                                </div>
                                                <button  type="button" class="btn btn-fill btn-success" onclick="funcoes.showSwal('personas')">Escolher Foto</button>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" name="nome" class="form-control border-input" value="<?= $persona->nome ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Idade</label>
                                                    <input type="number" name="idade" class="form-control border-input" value="<?= $persona->idade ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Sexo</label>
                                                    <select class="form-control border-input" name="sexo">
                                                        <option value="m" <?= ($persona->sexo == 'm') ? 'selected' : ''?>>Masculino</option>
                                                        <option value="f" <?= ($persona->sexo == 'f') ? 'selected' : ''?>>Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Características</label>
                                                    <textarea rows="5" name="caracteristicas" class="form-control border-input"><?= $persona->caracteristicas ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Educação</label>
                                                    <input type="text" class="form-control border-input" name="educacao" value="<?= $persona->educacao ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Trabalho</label>
                                                    <input type="text" class="form-control border-input" name="trabalho" value="<?= $persona->trabalho ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Segmento</label>
                                                    <input type="text" class="form-control border-input" name="segmento" value="<?= $persona->segmento ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Seus objetivos são:</label>
                                                    <textarea rows="5" class="form-control border-input" name="objetivos"><?= $persona->objetivos ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Seus problemas são:</label>
                                                    <textarea rows="5" class="form-control border-input" name="descricao"><?= $persona->descricao ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Como vamos ajudar?</label>
                                                    <textarea rows="5" class="form-control border-input" name="resolucao"><?= $persona->resolucao ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Aprendizado e Descoberta</label>
                                                    <input type="text" class="form-control border-input" name="aprendizado" value="<?= $persona->aprendizado ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Reconhecimento do Problema</label>
                                                    <input type="text" class="form-control border-input" name="reconhecimento" value="<?= $persona->reconhecimento ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Consideração da Solução</label>
                                                    <input type="text" class="form-control border-input" name="consideracao" value="<?= $persona->consideracao ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Decisão de Compra</label>
                                                    <input type="text" class="form-control border-input" name="decisao" value="<?= $persona->decisao ?>">
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
                                    </form>
                            </div> <!-- end col-md-12 -->
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    
    <script>
    <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'falha') { ?>
        $(document).ready(function() {
            funcoes.showNotification(0,4,'<b>Erro</b> - Erro ao editar persona.');
        });
    <?php } ?>
    </script>
</html>