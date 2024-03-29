<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_padrao.php';
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Cria Persona - PostSpot</title>
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
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">person</i> Personas</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                        <form action="../../controller/persona/criar_persona.php" method="POST">
                                    <div class="card-content">
                                            <div class="row">

                                                <div class="col-md-2">
                                                    
                                                    <div class="form-group">
                                                        <input type="hidden" name="foto" value="1-avatar-postspot.png" class="form-control border-input" id="hiddenFotoPersona">
                                                        <img id="fotoPersona" class="avatar border-white" src="assets/img/faces/1-avatar-postspot.png" alt="Foto Persona">                                                    
                                                    </div>
                                                    <button  type="button" class="btn btn-fill btn-success" onclick="funcoes.showSwal('personas')">Escolher Foto</button>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input type="text" name="nome" class="form-control border-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Idade</label>
                                                        <input type="number" name="idade" class="form-control border-input">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Sexo</label>
                                                        <select class="form-control border-input" name="sexo">
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
                                                        <textarea rows="5" name="caracteristicas" class="form-control border-input" placeholder=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Educação</label>
                                                        <input type="text" class="form-control border-input" name="educacao">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Trabalho</label>
                                                        <input type="text" class="form-control border-input" name="trabalho">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Segmento</label>
                                                        <input type="text" class="form-control border-input" name="segmento">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Seus objetivos são:</label>
                                                        <textarea rows="5" class="form-control border-input" placeholder="" name="objetivos"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Seus problemas são:</label>
                                                        <textarea rows="5" class="form-control border-input" placeholder="" name="descricao"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Como vamos ajudar?</label>
                                                        <textarea rows="5" class="form-control border-input" placeholder="" name="resolucao"></textarea>
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
                                                        <textarea rows="5" name="aprendizado" class="form-control border-input" placeholder=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Consideração</label>
                                                        <p class="text-muted">Tem com clareza a definição e sabe qual é o seu problema ou oportunidade.</p>
                                                        <textarea rows="5" name="reconhecimento" class="form-control border-input" placeholder=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Decisão</label>
                                                        <p class="text-muted">Já tem definido a estratégia, método ou abordagem para solucionar o seu problema.</p>
                                                        <textarea rows="5" name="consideracao" class="form-control border-input" placeholder=""></textarea>
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Decisão de Compra</label>
                                                        <textarea rows="5" name="decisao" class="form-control border-input" placeholder=""></textarea>
                                                    </div>
                                                </div>-->
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
            funcoes.showNotification(0,4,'<b>Erro</b> ao criar persona.');
        });
    <?php } ?>
    </script>
</html>