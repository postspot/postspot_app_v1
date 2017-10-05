<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/comentarios.php';
require_once '../../model/membros_equipe.php';
require_once '../../model/tarefas.php';
require_once '../../model/personas.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/publicacoes.php';
require_once 'includes/header_padrao.php';

if(!isset($_GET["t"])){
    header('location: ../../view/adm/dashboard.php?erro=te');
}else{
    $id_tarefa = $_GET["t"];
}
$comentarios = comentarios::getAllComentariosByTarefa($id_tarefa);
$membros = membros_equipe::buscarPessoasDaEquipe($_SESSION['id_projeto']);
$tarefa = tarefas::getById($id_tarefa);
$persona = personas::getById($tarefa->id_persona);
$referencias_banco = explode("\n", $tarefa->referencias);
$referencias = '';
$conteudo = publicacoes::getUltimaPublicacao($id_tarefa);
/*pre_r($conteudo);
die();*/
foreach ($referencias_banco as $referencia):
    $referencias .= '<li><a href="' . $referencia . '" target="_blank">' . $referencia . '</a></li>';
endforeach;
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
                                                    <?php if($_SESSION['funcao_usuario'] != 3):?>
                                                        <li><a href="#ajuste" data-toggle="tab">Ajuste</a></li>
                                                    <?php endif;?>
                                                    <li><a href="#pauta" data-toggle="tab">Pauta</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="my-tab-content" class="tab-content text-center">
                                            <div class="tab-pane pane-pauta min-height active" id="conteudo">
                                                <?= (empty($conteudo)) ? '' : $conteudo?>
                                            </div>
                                            <?php if($_SESSION['funcao_usuario'] != 3):?>
                                                <div class="tab-pane pane-pauta min-height" id="ajuste">
                                                    <form action="../../controller/conteudo/envia_aprovacao.php" method="post" enctype="multipart/form-data" id="formConteudo">
                                                        <input type="hidden" value="<?=$id_tarefa?>" name="id_tarefa">
                                                        <input type="hidden" name="aprovacao" id="controleCriacao">
                                                        <textarea name="texto_publicacao" id="summernote"><?= (empty($conteudo)) ? '' : $conteudo ?></textarea>
                                                        <button class="btn btn-success btn-fill" type="button" id="salvaConteudo">Salvar Conteúdo</button>
                                                        <button class="btn btn-success btn-fill" type="button" id="enviarAprovacao">Enviar Aprovação</button>
                                                    </form>
                                                </div>
                                            <?php endif;?>
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
                                                <!--<hr>
                                                <span>Criado por: por Arthur Guedes. Última atualização: 08/11/2016 por Arthur Guedes.</span>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Menu Lateral-->
                            <div class="col-md-4">

                                <?php if(($_SESSION['funcao_usuario'] == 0 || $_SESSION['funcao_usuario'] == 1 || $_SESSION['funcao_usuario'] == 3)
                                        && ($tarefa->etapa == 5 || $tarefa->etapa == 6) ):?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ação necessaria <?= $tarefa->etapa?></h4>
                                    </div>
                                    <div class="card-content">
                                        <?php if($tarefa->etapa == 4 || $tarefa->etapa == 5):?>
                                            <form id="formAprovaConteudo" action="" method="post">
                                                <input type="hidden" value="<?=$id_tarefa?>" name="id_tarefa">
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem" id="btnAprovaConteudo">
                                                    <span class="btn-label">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    Aprovar conteúdo
                                                </button>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-danger margem" id="btnReprovaConteudo">
                                                    <span class="btn-label">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    Reprovar conteúdo
                                                </button>
                                            </form>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <?php endif;?>
                                <div class="card card-chat">
                                    <div class="card-header">
                                        <h4 class="card-title">Cometários</h4>
                                    </div>
                                    <div class="card-content">
                                        <ol class="chat" id="olChat">
                                        <?php if(empty($comentarios)):?>
                                            <li class="text-muted"><p class="text-center fill-up">Nenhum comentário</p></li>
                                        <?php else:
                                        foreach($comentarios as $comentario):
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
                                                endforeach;endif;?>
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
                height: 400,
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
            
            $("#enviarAprovacao").click(function (e) { 
                e.preventDefault();
                $('textarea[name="texto_publicacao"]').html($('#summernote').summernote('code'));
                $("#controleCriacao").val(1);
                $("#formConteudo").submit();
            });
            $("#salvaConteudo").click(function (e) { 
                e.preventDefault();
                $('textarea[name="texto_publicacao"]').html($('#summernote').summernote('code'));
                $("#controleCriacao").val(0);
                $("#formConteudo").submit();
            });
            
            $("#btnAprovaConteudo").click(function (e) { 
                e.preventDefault();
                $("#formAprovaConteudo").attr('action', '../../controller/conteudo/aprova_conteudo.php');
                $("#formAprovaConteudo").submit();
            });
            $("#salvaConteudo").click(function (e) { 
                e.preventDefault();
                $("#formAprovaConteudo").attr('action', '../../controller/conteudo/reprova_conteudo.php');
                $("#formAprovaConteudo").submit();
            });
        });
    </script>
</html>