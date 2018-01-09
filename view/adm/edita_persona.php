<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
require_once 'includes/header_padrao.php';

if (isset($_GET["persona"])) {
    $persona = personas::getById($_GET["persona"]);
}

$disabled = ($_SESSION['funcao_usuario'] != 0) ? 'disabled="disabled"' : '';
//pre_r($persona);
//die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>PostSpot</title>
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
                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">person</i> Detalhes da Persona</h4>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-content">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                    <li class="active"><a href="#estrategia" data-toggle="tab">Informações</a></li>
                                                    <?= ($_SESSION['funcao_usuario'] == 0) ? '<li><a href="#editar" data-toggle="tab">Editar</a></li>' : '' ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="tab-persona" class="tab-content">
                                            <div class="tab-pane pane-pauta active" id="estrategia">
                                                <div class="row">

                                                    <div class="col-md-2">

                                                        <div class="form-group">
                                                            <img id="fotoPersona" class="avatar border-white" src="assets/img/faces/<?= $persona->foto ?>" alt="Foto Persona">                                                    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label>Nome</label>
                                                            <p><?= $persona->nome ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Idade</label>
                                                            <p><?= $persona->idade ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label>Sexo</label>
                                                            <p><?= ($persona->sexo == 'm') ? 'Masculino' : 'Feminino' ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Características</label>
                                                            <p><?= $persona->caracteristicas ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Educação</label>
                                                            <p><?= $persona->educacao ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Trabalho</label>
                                                            <p><?= $persona->trabalho ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Segmento</label>
                                                            <p><?= $persona->segmento ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Seus objetivos são:</label>
                                                            <p><?= $persona->objetivos ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Seus problemas são:</label>
                                                            <p><?= $persona->descricao ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Como vamos ajudar?</label>
                                                            <p><?= $persona->resolucao ?></p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5>ESTÁGIO DO CICLO DE VIDA DA PERSONA</h5>
                                                        <div class="form-group">
                                                            <label>Conhecimento</label>
                                                            <p class="text-muted">Realizou ou expressou sintomas de um potencial problema ou oportunidade.</p>
                                                            <p><?= $persona->aprendizado ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Consideração</label>
                                                            <p class="text-muted">Tem com clareza a definição e sabe qual é o seu problema ou oportunidade.</p>
                                                            <p><?= $persona->reconhecimento ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Decisão</label>
                                                            <p class="text-muted">Já tem definido a estratégia, método ou abordagem para solucionar o seu problema.</p>
                                                            <p><?= $persona->consideracao ?></p>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Decisão de Compra</label>
                                                            <input type="text" class="form-control border-input" name="decisao" value="<?= $persona->decisao ?>" <?= $disabled ?>>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="tab-pane pane-pauta" id="editar">

                                                <form action="../../controller/persona/edita_persona.php" method="POST">
                                                    <input type="hidden" name="id_persona" value="<?= $persona->id_persona ?>">
                                                    <div class="row">

                                                        <div class="col-md-2">

                                                            <div class="form-group">
                                                                <input type="hidden" name="foto" value="<?= $persona->foto ?>" class="form-control border-input" id="hiddenFotoPersona">
                                                                <img id="fotoPersona" class="avatar border-white" src="assets/img/faces/<?= $persona->foto ?>" alt="Foto Persona">                                                    
                                                            </div>
                                                            <button  type="button" class="btn btn-fill btn-success" onclick="funcoes.showSwal('personas')" <?= $disabled ?>>Escolher Foto</button>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label>Nome</label>
                                                                <input type="text" name="nome" class="form-control border-input" value="<?= $persona->nome ?>" <?= $disabled ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Idade</label>
                                                                <input type="number" name="idade" class="form-control border-input" value="<?= $persona->idade ?>" <?= $disabled ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label>Sexo</label>
                                                                <select class="form-control border-input" name="sexo" <?= $disabled ?>>
                                                                    <option value="m" <?= ($persona->sexo == 'm') ? 'selected' : '' ?>>Masculino</option>
                                                                    <option value="f" <?= ($persona->sexo == 'f') ? 'selected' : '' ?>>Feminino</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Características</label>
                                                                <textarea rows="5" name="caracteristicas" class="form-control border-input" <?= $disabled ?>><?= $persona->caracteristicas ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Educação</label>
                                                                <input type="text" class="form-control border-input" name="educacao" value="<?= $persona->educacao ?>" <?= $disabled ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Trabalho</label>
                                                                <input type="text" class="form-control border-input" name="trabalho" value="<?= $persona->trabalho ?>" <?= $disabled ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Segmento</label>
                                                                <input type="text" class="form-control border-input" name="segmento" value="<?= $persona->segmento ?>" <?= $disabled ?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Seus objetivos são:</label>
                                                                <textarea rows="5" class="form-control border-input" name="objetivos" <?= $disabled ?>><?= $persona->objetivos ?></textarea>
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
                                                        <div class="col-md-12">
                                                            <h5>ESTÁGIO DO CICLO DE VIDA DA PERSONA</h5>
                                                            <div class="form-group">
                                                                <label>Conhecimento</label>
                                                                <p class="text-muted">Realizou ou expressou sintomas de um potencial problema ou oportunidade.</p>
                                                                <textarea rows="5" name="aprendizado" class="form-control border-input" <?= $disabled ?> placeholder=""><?= $persona->aprendizado ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Consideração</label>
                                                                <p class="text-muted">Tem com clareza a definição e sabe qual é o seu problema ou oportunidade.</p>
                                                                <textarea rows="5" name="reconhecimento" class="form-control border-input" <?= $disabled ?> placeholder=""><?= $persona->reconhecimento ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Decisão</label>
                                                                <p class="text-muted">Já tem definido a estratégia, método ou abordagem para solucionar o seu problema.</p>
                                                                <textarea rows="5" name="consideracao" class="form-control border-input" <?= $disabled ?> placeholder=""><?= $persona->consideracao ?></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Decisão de Compra</label>
                                                                <input type="text" class="form-control border-input" name="decisao" value="<?= $persona->decisao ?>" <?= $disabled ?>>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill btn-info pull-right" <?= $disabled ?>>Salvar</button>                                               
                                                        </div>
                                                    </div>
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
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

    <script>
<?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'falha') { ?>
            $(document).ready(function () {
                funcoes.showNotification(0, 4, '<b>Erro</b> - Erro ao editar persona.');
            });
    <?php 
}
?>
    </script>
</html>