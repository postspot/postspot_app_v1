<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/comentarios.php';
require_once '../../model/membros_equipe.php';
require_once '../../model/tarefas.php';
require_once '../../model/personas.php';
require_once 'includes/header_padrao.php';

if(!isset($_GET["t"])){
    header('location: ../../view/adm/dashboard.php?erro=te');
}else{
    $id_tarefa = $_GET["t"];
}
$comentarios = comentarios::getAllComentariosByTarefa($id_tarefa);
$membros = membros_equipe::buscarPessoasDaEquipe($_SESSION['id_projeto']);
$tarefa = tarefas::getById($id_tarefa);
$persona = personas::getById(2);
$referencias_banco = explode("\n", $tarefa->referencias);
$referencias = '';
foreach ($referencias_banco as $referencia):
    $referencias .= '<li><a href="' . $referencia . '" target="_blank">' . $referencia . '</a></li>';
endforeach;
/*pre_r($referencias);
die();*/
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
                            <div class="col-md-12">
                                <div class="progress-stage">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default active">Pauta</button>
                                        <button type="button" class="btn btn-default active">Produção</button>
                                        <button type="button" class="btn btn-default">Revisão/Otimização</button>
                                        <button type="button" class="btn btn-default">Correção/Adequação</button>
                                        <button type="button" class="btn btn-default">Publicado</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <!--Conteudo Central-->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                    <li class="active"><a href="#conteudo" data-toggle="tab">Conteúdo</a></li>
                                                    <li><a href="#ajuste" data-toggle="tab">Ajuste</a></li>
                                                    <li><a href="#pauta" data-toggle="tab">Pauta</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="my-tab-content" class="tab-content text-center">
                                            <div class="tab-pane pane-pauta active" id="conteudo">
                                                <div style="text-align: left;"><div class="content-title mb15 bold" style="color: rgb(121, 121, 121); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 13px; margin-bottom: 15px !important; font-weight: 600 !important;"><h1 class="edit_task_show_idea pb5" style="margin-top: 20px; margin-bottom: 10px; font-family: &quot;Open Sans&quot;, sans-serif; line-height: 35px; color: rgb(94, 94, 94); font-size: 28px !important; font-weight: 600 !important; padding-bottom: 5px !important;">[ESTENDER + 500] Quais as diferenças entre o marketing tradicional e o marketing digital?</h1></div><div class="content-article" style="color: rgb(121, 121, 121); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 13px;"><div id="read-only-article" style="transition-duration: 0.2s; transition-timing-function: linear; padding: 0px !important;"><img src="https://s3.amazonaws.com/rockcontent-bucket/images/production/54391-estender-500-quais-as-diferencas-entre-o-marketing-tradicional-e-o-marketing-digital.jpg?1480942885" alt="[ESTENDER + 500] Quais as diferenças entre o marketing tradicional e o marketing digital?" class="col-md-12 img-responsive" style="padding: 0px; float: none; width: 637.328px; border-width: 1px !important; border-style: solid !important; border-color: rgb(221, 228, 230) !important; border-radius: 3px !important;"><br><div><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Você sabe qual é o modelo de marketing mais indicado para aumentar as vendas de um negócio? De fato, essa é uma pergunta de difícil resposta, afinal, escolher a melhor opção para cada empresa depende de uma série de fatores.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Alguns dirão que é o marketing tradicional, aquele voltado para meios de comunicação clássicos como a TV e os jornais. Outros já dirão que é&nbsp;<a href="http://ubound.co/afinal-o-que-e-marketing-digital-e-por-que-ele-e-fundamental-para-meu-negocio/" target="_blank" style="color: rgb(66, 102, 174);">o marketing digital</a>, com foco total na web e fazendo uso das novas ferramentas de comunicação.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Contudo, para responder essa pergunta com exatidão é importante entender de fato quais são as&nbsp;diferenças entre o marketing tradicional e o marketing digital, indo além dos&nbsp;meios que cada um deles utiliza.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Quer saber quais são essas diferenças e identificar qual dos dois estilos é mais adequado ao seu negócio? Então&nbsp;continue lendo este post!!</p><h2 style="font-family: &quot;Open Sans&quot;, sans-serif; line-height: 31.5px; margin-bottom: 10px; text-align: justify; font-weight: 600 !important; color: rgb(94, 94, 94) !important; margin-top: 25px !important; font-size: 18px !important;">Como funciona o marketing tradicional?</h2><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Como dissemos, o marketing tradicional é aquele que utiliza os meios clássicos de comunicação para divulgar uma mensagem e promover um produto ou serviço, como anúncios em&nbsp;rádios, TV e mídia impressa.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Logo, a abordagem do marketing tradicional é bem direta, interrompendo o cliente com mensagens sobre uma marca ou produto enquanto ele assiste TV, ouve rádio ou lê algum material impresso.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Por envolver a produção de peças publicitárias e os custos de exibição nas mídias de comunicação de massa, os investimentos necessários para a promoção de uma empresa por meio do marketing tradicional sempre foram bastante elevados.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Além disso, vale lembrar que medir os resultados de uma estratégia de promoção pelo marketing tradicional&nbsp;é difícil de ser realizada, exigindo que se pergunte ao cliente se a compra foi motivada por um anúncio no momento da compra para ter certeza de sua eficiência.</p><p style="color: rgb(94, 94, 94); font-size: 13px; letter-spacing: -0.01em; padding-bottom: 3px; text-align: justify; line-height: 19.5px;">Entre as ações de marketing tradicional ainda podemos destacar os anúncios em&nbsp;outdoor,&nbsp;as ações de panfletagem, o merchandising em lojas físicas e o telemarketing, que ainda recebem grandes investimentos nos dias atuais.</p></div></div></div></div>
                                            </div>
                                            <div class="tab-pane pane-pauta" id="ajuste">
                                                <div id="summernote">Hello Summernote</div>
                                                <button class="btn btn-success btn-fill">Salvar Conteúdo</button>
                                            </div>
                                            <div class="tab-pane pane-pauta" id="pauta">
                                                <h1><?= $tarefa->nome_tarefa ?></h1>
                                                <hr>
                                                <h5>Descrição Geral</h5>
                                                <p><?= $tarefa->briefing_tarefa ?></p>
                                                <hr>
                                                <h5>Palavras-chave</h5>
                                                <p><?= $tarefa->palavra_chave ?></p>
                                                <hr>
                                                <h5>Tipo de Conteúdo</h5>
                                                <p><?= $tarefa->tipo_cta ?></p>
                                                <hr>
                                                <h5>Projeto</h5>
                                                <p><?= $_SESSION['nome_projeto'] ?></p>
                                                <hr>
                                                <h5>Persona</h5>
                                                <div class="persona-pauta">
                                                    <div class="col-md-3">
                                                        <div class="avatar">
                                                            <img src="assets/img/faces/<?= $persona->foto ?>" alt="foto persona <?= $persona->nome ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h4><?= $persona->nome ?>, <strong><?= $persona->idade ?> anos</strong></h4>
                                                        <p>Educação: <?= $persona->educacao ?></p>
                                                        <p>Trabalho: <?= $persona->trabalho ?></p>
                                                        <p>Segmento: <?= $persona->segmento ?></p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                        <p><?= $persona->caracteristicas ?></p>
                                                        <hr>
                                                        <h5>Seus objetivos são:</h5>
                                                        <p><?= $persona->objetivos ?></p>
                                                        <h5>Seus problemas são: </h5>
                                                        <p><?= $persona->descricao ?></p>
                                                        <h5>Como vamos ajudar? </h5>
                                                        <p><?= $persona->resolucao ?></p>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <hr>
                                                <h5>Tipo de CTA</h5>
                                                <p><?= $tarefa->tipo_cta ?></p>
                                                <hr>
                                                <h5>Estágio do funil</h5>
                                                <p><?= $tarefa->estagio_compra ?></p>
                                                <hr>
                                                <h5>Referências</h5>
                                                <ol>
                                                    <?= $referencias ?>
                                                </ol>
                                                <hr>
                                                <h5>Considerações gerais:</h5>
                                                <p><?= $tarefa->consideracoes_gerais ?></p>
                                                <hr>
                                                <span>Criado por: por Arthur Guedes. Última atualização: 08/11/2016 por Arthur Guedes.</span>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Menu Lateral-->
                            <div class="col-md-4">

                                <div class="card card-chat">
                                    <div class="card-header">
                                        <h4 class="card-title">Cometários</h4>
                                    </div>
                                    <div class="card-content">
                                        <ol class="chat" id="olChat">
                                        <?php foreach($comentarios as $comentario):
                                                if($comentario->id_usuario != $_SESSION['id_usuario']):
                                            ?>
                                                <li class="other">
                                                    <div class="avatar">
                                                        <img src="../../uploads/usuarios/<?= $comentario->foto_usuario?>" alt="Foto <?= $comentario->nome_usuario?>" title="Foto <?= $comentario->nome_usuario?>"/>
                                                    </div>
                                                    <div class="msg" title="Comentário de <?= $comentario->nome_usuario?>" >
                                                        <p><?= $comentario->comentario?></p>
                                                        <div class="card-footer">
                                                            <i class="ti-calendar"></i>
                                                            <h6><?= date("d/m", strtotime($comentario->data_criacao)) ?> <?= date("h:i", strtotime($comentario->data_criacao)) ?></h6>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php else:?>
                                                <li class="self">
                                                    <div class="msg" title="Comentário de <?= $comentario->nome_usuario?>" >
                                                        <p><?= $comentario->comentario?></p>
                                                        <div class="card-footer">
                                                            <i class="ti-calendar"></i>
                                                            <h6><?= date("d/m", strtotime($comentario->data_criacao)) ?> <?= date("h:i", strtotime($comentario->data_criacao)) ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="avatar">
                                                    <img src="../../uploads/usuarios/<?= $comentario->foto_usuario?>" alt="Foto <?= $comentario->nome_usuario?>" title="Foto <?= $comentario->nome_usuario?>"/>
                                                    </div>
                                                </li>
                                                <?php endif;
                                                endforeach;?>
                                        </ol>
                                        <hr>
                                        <div class="send-message">
                                            <form id="formComentario" action="#" method="post">
                                                <input type="hidden" name="id_tarefa" value="<?=$id_tarefa?>">
                                                <input class="form-control textarea" type="text" placeholder="Comente aqui!" name="comentario"/>
                                                <div class="send-button">
                                                    <button class="btn btn-primary btn-fill" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Integrantes</h4>
                                    </div>
                                    <div class="card-content">
                                        <ul class="list-unstyled team-members">
                                        <?php foreach ($membros as $membro): ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="avatar">
                                                            <img src="../../uploads/usuarios/<?= $membro->foto_usuario ?>" alt="foto <?= $membro->nome_usuario ?>" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-xs-offset-1">
                                                        <?= $membro->nome_usuario ?>
                                                        <br>
                                                        <span class="text-muted"><small><?= funcaoCliente($membro->funcao_usuario) ?></small></span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach;?>
                                        </ul>
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

    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize', 'fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['Misc', ['fullscreen']],
                    ['Insert', ['table']]
                ]
            });

            // Evento de click no botao fullscreen
            $('body').on('click', '.btn-fullscreen', function (event) {

                // Modal que esta sendo exibido
                var btn = $('.btn-fullscreen');
                var sideBar = $('.sidebar');
//
//                // Verifica se modal possui a classe bodyFullscreen, se possuir a remove, caso contrario insere
                if (!btn.hasClass('active')) {
                    sideBar.removeClass('menu-fechado');
                } else {
                    sideBar.addClass('menu-fechado');
                }
            });

            $("#formComentario").submit(function (e) { 
                e.preventDefault();
                var dados = $("#formComentario").formatFormToJson();

                $.ajax({
                    url: "../../controller/comentarios/insere_comentario.php",
                    type: "POST",
                    dataType: "json",
                    async: true,
                    data: dados,
                    timeout: 15000,
                    success: function (data) {
                        console.log(JSON.stringify(data));
                        if(data == 'true'){
                            var msg = '<div class="msg"><p>'+dados['comentario']+'</p><div class="card-footer"><i class="ti-check"></i><h6>11:22</h6></div></div>';
                            var img = '<div class="avatar"><img src="../../uploads/usuarios/<?= $_SESSION['foto_usuario'] ?>" alt="Foto de <?= $_SESSION['nome_usuario'] ?>"/></div>';
                            var content = '<li class="self">'+msg+ img+'</li>';
                            $("#olChat").append(content);
                        }else{
                            swal({
                              title: 'Erro!',
                              text: 'Comentário não enviado.',
                              type: 'error',
                              confirmButtonClass: "btn btn-info btn-fill",
                              buttonsStyling: false
                              })
                        }
                    },
                    error: function (x, t, m) {
                        alert('Tempo esgotado');
                        console.log(JSON.stringify(x));
                    }
                });
            });
        });
    </script>
</html>