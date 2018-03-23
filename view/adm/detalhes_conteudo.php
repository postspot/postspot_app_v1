<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/comentarios.php';
require_once '../../model/membros_equipe.php';
require_once '../../model/tarefas.php';
require_once '../../model/anexos.php';
require_once '../../model/personas.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/publicacoes.php';
require_once 'includes/header_padrao.php';

if (!isset($_GET["t"])) {
    header('location: ../../view/adm/dashboard.php?erro=te');
} else {
    $id_tarefa = $_GET["t"];
}
$condicaoComentario = (($_SESSION['funcao_usuario'] == 0 || $_SESSION['funcao_usuario'] == 1) ? '' : (($_SESSION['funcao_usuario'] == 3) ? 'AND co.equipe = 0' : 'AND co.equipe = 1'));
$comentarios = comentarios::getAllComentariosByTarefa($id_tarefa, 1, $condicaoComentario);
$membros = membros_equipe::buscarPessoasDaEquipe($_SESSION['id_projeto'],'');
$tarefa = tarefas::getById($id_tarefa);
$persona = personas::getById($tarefa->id_persona);
$referencias_banco = explode("\n", $tarefa->referencias);
$referencias = '';
$conteudo = publicacoes::getUltimaPublicacao($id_tarefa);
$historicos = publicacoes::getHistoricoPublicacao($id_tarefa);
$fotos = anexos::getAllByProjeto($_SESSION['id_projeto'], $id_tarefa);
// pre_r($fotos);
// die();
foreach ($referencias_banco as $referencia) :
    $referencias .= '<li><a href="' . $referencia . '" target="_blank">' . $referencia . '</a></li>';
endforeach;
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Detalhes do Conteúdo - PostSpot</title>
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
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <div class="progress-stage">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default active">Pauta</button>
                                        <button type="button" class="btn btn-default <?= ($tarefa->etapa > PAUTA_REAPROVACAO_CLIENTE) ? 'active' : '' ?>">Produção</button>
                                        <button type="button" class="btn btn-default <?= ($tarefa->etapa > CONTEUDO_APROVACAO_MODERADOR) ? 'active' : '' ?>">Aprovação</button>
                                        <button type="button" class="btn btn-default <?= ($tarefa->etapa > CONTEUDO_REPROVADO) ? 'active' : '' ?>">Correção/Adequação</button>
                                        <button type="button" class="btn btn-default <?= ($tarefa->etapa > CONTEUDO_REAPROVACAO_MODERADOR) ? 'active' : '' ?>">Aprovação Final</button>
                                        <button type="button" class="btn btn-default <?= ($tarefa->etapa > CONTEUDO_PARA_PUBLICAR) ? 'active' : '' ?>">Publicado</button>
                                    </div>
                                </div> -->
                                <?php
                                $dataAvaliacao = log_tarefas::gatDataLogAvaliacao($id_tarefa);
                                $dataAprovacao = log_tarefas::gatDataLogAprovacao($id_tarefa);
                                // pre_r($dataAvaliacao);
                                // pre_r($dataAprovacao);
                                // die();
                                ?>
                                <ul class="textosProgressBar">
                                    <li>Produção</li>
                                    <li>Avaliação</li>
                                    <li class="data"><?= ($dataAvaliacao == '') ? '' : 'Entregue em ' . date("d/m/Y", strtotime($dataAvaliacao)) ?></li>
                                    <li>Aprovação</li>
                                    <li>Adequação</li>
                                    <li class="data"><?= ($dataAprovacao == '') ? '' : 'Aprovado em ' . date("d/m/Y", strtotime($dataAprovacao)) ?></li>
                                    <li>Publicação</li>
                                    <li>Publicado</li>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar azul-um" style="width: <?= ($tarefa->etapa > PAUTA_REAPROVACAO_CLIENTE) ? '10' : '0' ?>%">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                    <div class="progress-bar azul-dois" style="width: <?= ($tarefa->etapa > CONTEUDO_ESCREVENDO) ? '10' : '0' ?>%">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                    <div class="progress-bar azul-tres" style="width: <?= ($tarefa->etapa == CONTEUDO_APROVACAO_CLIENTE || $tarefa->etapa > CONTEUDO_APROVACAO_MODERADOR) ? '23' : '0' ?>%">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                    <div class="progress-bar azul-quatro" style="width: <?= ($tarefa->etapa > CONTEUDO_REPROVADO) ? '12' : '0' ?>%">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                    <div class="progress-bar azul-cinco" style="width: <?= ($tarefa->etapa > CONTEUDO_REAPROVACAO_CLIENTE) ? '23' : '0' ?>%">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                    <div class="progress-bar azul-seis" style="width: <?= ($tarefa->etapa >= CONTEUDO_PUBLICADO) ? '22' : '0' ?>%">
                                        <span class="sr-only">35% Complete (success)</span>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <!--Conteudo Central-->
                            <div class="col-md-8">
                                <div class="card card-conteudo">
                                    <div class="card-content">
                                        <div class="nav-tabs-navigation">
                                            <!-- <div class="nav-tabs-wrapper"> -->
                                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                    <li class="active"><a href="#conteudo" data-toggle="tab"><i class="material-icons">description</i> Conteúdo</a></li>
                                                    <?php if ($_SESSION['funcao_usuario'] != 3) : ?>
                                                        <li><a href="#ajuste" data-toggle="tab"><i class="material-icons">border_color</i> Editar</a></li>
                                                    <?php endif; ?>
                                                    <li><a href="#pauta" data-toggle="tab"><i class="material-icons">list</i> Pauta</a></li>
                                                    <li><a href="#historico" data-toggle="tab"><i class="material-icons">history</i> Histórico</a></li>
                                                </ul>
                                            <!-- </div> -->
                                        </div>
                                        <div id="my-tab-content" class="tab-content text-center">
                                            <div class="tab-pane pane-pauta active" id="conteudo">
                                            <!-- <input type="text" class="form-control" value="<?= $tarefa->nome_tarefa ?>">    -->
                                            <h1 class="titulo-pauta"><?= $tarefa->nome_tarefa ?></h1>   
                                            <img class="img-capa" src="<?= SITE ?>uploads/projetos/<?= $fotos[0]->id_projeto ?>-arquivos/<?= $fotos[0]->nome_anexo ?>" alt=""> 
                                                <div class="sem-estilo min-height"><?= (empty($conteudo)) ? '<p>Não há nenhum conteúdo escrito até o momento</p>' : $conteudo ?> </div>
                                                <?php if ($_SESSION['funcao_usuario'] != 3) : ?>
                                                    <hr>
                                                    <div class="card">
                                                        <div class="card-content no-padding">
                                                            
                                                            <h4 class="title cor-roxo-escuro"><i class="material-icons">insert_photo</i> Imagem Destaque</h4>
                                                            <div class="row" id="espacoFotos">
                                                                <?php if (empty($fotos)) : ?>
                                                                <div class="col-md-12"><p>Nenhuma imagem</p></div>
                                                                <?php else : foreach ($fotos as $foto) : ?>
                                                                    <div class="col-md-3 contador-img">
                                                                        <a href="<?= SITE ?>uploads/projetos/<?= $foto->id_projeto ?>-arquivos/<?= $foto->nome_anexo ?>" download><img src="<?= SITE ?>uploads/projetos/<?= $foto->id_projeto ?>-arquivos/<?= $foto->nome_anexo ?>" alt=""></a>
                                                                        <p class="cor-rosa-claro text-center" onclick="rmfile(<?= $foto->id_anexo ?>,'<?= $foto->nome_anexo ?>',this)"><i class="material-icons">delete_forever</i> Excluir</p>
                                                                    </div>
                                                                <?php endforeach;
                                                                endif ?>
                                                            </div>
                                                            <form action="../../controller/anexos/cria_fotos.php" method="post" enctype="multipart/form-data">                        
                                                            <input type="hidden" value="<?= $id_tarefa ?>" name="id_tarefa">
                                                                    <div class="form-group">
                                                                        <label>Arquivo</label>
                                                                        <input type="file" class="form-control border-input" name="anexos[]" multiple>
                                                                    </div>
                                                                    <input type="submit" value="Enviar Imagem" class="btn btn-info btn-fill fill-up fundo-roxo-escuro">
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                                <div class="tab-pane pane-pauta min-height" id="ajuste">
                                                    <form action="../../controller/conteudo/envia_aprovacao.php" method="post" enctype="multipart/form-data" id="formConteudo">
                                                        <input type="hidden" value="<?= $id_tarefa ?>" name="id_tarefa">
                                                        <input type="hidden" name="aprovacao" id="controleCriacao">
                                                        <input type="hidden" name="etapa" value="<?= $tarefa->etapa ?>">
                                                        <input type="text" class="form-control" value="<?= $tarefa->nome_tarefa ?>" name="novo_titulo_tarefa">
                                                        <textarea name="texto_publicacao" id="editor"><?= (empty($conteudo)) ? '' : $conteudo ?></textarea>
                                                    </form>
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
                                                <p><?= $tarefa->nome_tipo ?></p>
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
                                            <div class="tab-pane pane-pauta min-height" id="historico">
                                            <?php if (empty($historicos)) : ?>
                                                <h1>Histórico inexistente :(</h1>
                                            <?php else : ?>
                                                
                                                <table class="table">
                                                    <tbody>
                                                    <?php foreach ($historicos as $historico) : ?>
	                                                    <tr>
	                                                        <td><?= date("d/m/Y H:i", strtotime($historico->data_criacao)) ?></td>
	                                                        <td class="text-right">
                                                                <button type="button" class="btn btn-wd btn-warning btn-fill btn-magnify fundo-roxo-escuro" onclick="mostraHistorico(<?= $historico->id_publicacao ?>)">
                                                                    <span class="btn-label">
                                                                        <i class="ti-search"></i>
                                                                    </span>
                                                                    Ver Publicação
                                                                </button>
	                                                        </td>
	                                                    </tr>
                                                    <?php endforeach; ?> 
                                                    </tbody>
	                                            </table>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Menu Lateral-->
                            <div class="col-md-4">

                                <?php if (($_SESSION['funcao_usuario'] == 0 || $_SESSION['funcao_usuario'] == 3)
                                    && ($tarefa->etapa == CONTEUDO_APROVACAO_CLIENTE || $tarefa->etapa == CONTEUDO_REAPROVACAO_CLIENTE)) : ?>
                                <div class="card card-acoes">
                                    <!-- <div class="card-header">
                                        <h4 class="card-title">Ação necessária</h4>
                                    </div> -->
                                    <div class="card-content">
                                        <?php //if($tarefa->etapa == 6 || $tarefa->etapa == 9):?>
                                            <form id="formAprovaConteudo" action="" method="post">
                                                <input type="hidden" name="motivo" id="inputMotivo">
                                                <input type="hidden" name="nota_tarefa" id="inputNota">
                                                <input type="hidden" name="nome_tarefa" value="<?= $tarefa->nome_tarefa ?>">
                                                <input type="hidden" name="id_tarefa" value="<?= $id_tarefa ?>">
                                                <input type="hidden" name="etapa" value="<?= $tarefa->etapa ?>">
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem azul-cinco" id="btnAprovaConteudo">
                                                    <span class="btn-label">
                                                    <i class="material-icons">check</i>
                                                    </span>
                                                    Aprovar conteúdo
                                                </button>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-danger margem fundo-rosa-claro" id="btnReprovaConteudo">
                                                    <span class="btn-label">
                                                    <i class="material-icons">close</i>
                                                    </span>
                                                    Solicitar ajuste
                                                </button>
                                            </form>
                                        <?php //endif;?>
                                    </div>
                                </div>
                                <?php elseif (($_SESSION['funcao_usuario'] == 0 || $_SESSION['funcao_usuario'] == 2)
                                    && ($tarefa->etapa == CONTEUDO_ESCREVENDO || $tarefa->etapa == CONTEUDO_AJUSTANDO)) : ?>
                                    <div class="card card-acoes">
                                        <!-- <div class="card-header">
                                            <h4 class="card-title">Ação necessária</h4>
                                        </div> -->
                                        <div class="card-content">
                                            <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem fundo-roxo-escuro" id="btnLatSalvaConteudo">
                                                <span class="btn-label">
                                                <i class="material-icons">save</i>
                                                </span>
                                                Salvar Conteúdo
                                            </button>
                                            <?php if ($_SESSION['funcao_usuario'] == 0 || $_SESSION['funcao_usuario'] == 1 || $_SESSION['funcao_usuario'] == 2) : ?>
                                                <button type="button" class="btn btn-lg fill-up btn-wd btn-danger margem azul-cinco" id="btnLatEnviaModeradorConteudo">
                                                    <span class="btn-label">
                                                    <i class="material-icons">fast_forward</i>
                                                    </span>
                                                    Enviar PostSpot
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php elseif (($tarefa->etapa == CONTEUDO_APROVACAO_MODERADOR || $tarefa->etapa == CONTEUDO_REAPROVACAO_MODERADOR) && $_SESSION['funcao_usuario'] == 0) : ?>
                                    <div class="card card-acoes">
                                        <!-- <div class="card-header">
                                            <h4 class="card-title">Ação necessária</h4>
                                        </div> -->
                                        <div class="card-content">
                                            <form id="formAprovaConteudo" action="" method="post">
                                                <input type="hidden" name="texto_publicacao" id="refacoes">
                                                <input type="hidden" name="motivo" id="inputMotivo">
                                                <input type="hidden" name="nota_tarefa" id="inputNota">
                                                <input type="hidden" name="nome_tarefa" value="<?= $tarefa->nome_tarefa ?>">
                                                <input type="hidden" value="<?= $id_tarefa ?>" name="id_tarefa">
                                                <input type="hidden" name="etapa" value="<?= $tarefa->etapa ?>">
                                                
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-info margem azul-cinco" id="btnLatEnviaAprovacaoConteudo">
                                                    <span class="btn-label">
                                                    <i class="material-icons">check</i>
                                                    </span>
                                                    Enviar para o cliente
                                                </button>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-danger margem fundo-rosa-claro" id="btnLatReprovaModerador">
                                                    <span class="btn-label">
                                                    <i class="material-icons">close</i>
                                                    </span>
                                                    Solicitar ajuste
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php elseif ($tarefa->etapa == CONTEUDO_PARA_PUBLICAR && $_SESSION['funcao_usuario'] == 0) : ?>
                                    <div class="card card-acoes">
                                        <div class="card-header">
                                            <h4 class="card-title">Link da Publicação <a href="<?= $tarefa->link_publicado ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></h4>
                                        </div>
                                        <div class="card-content">
                                            <form action="../../controller/conteudo/atualiza_link.php" method="post">
                                                <input type="hidden" name="id_tarefa" value="<?= $id_tarefa ?>">
                                                <fieldset>
                                                    <?php if ($_SESSION['funcao_usuario'] == 0) : ?>
                                                    <div class="form-group">
                                                        <input type="text" name="link_publicado" class="form-control" value="<?= $tarefa->link_publicado ?>" placeholder="Informe o link">
                                                    </div>
                                                    <button type="submit" class="btn btn-lg fill-up  btn-wd btn-success margem azul-cinco">
                                                        <span class="btn-label">
                                                        <i class="material-icons">check</i>
                                                        </span>
                                                        Publicar Conteúdo
                                                    </button>
                                                    <?php else : ?>
                                                    <div class="form-group">
                                                        <input type="text" disabled="disabled" class="form-control" value="<?= $tarefa->link_publicado ?>" placeholder="Informe o link">
                                                    </div>
                                                    <?php endif; ?>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                    <?php elseif ($tarefa->etapa == CONTEUDO_PUBLICADO) : ?>
                                    <div class="card card-acoes">
                                        <div class="card-header">
                                            <h4 class="card-title">Link Publicação <a href="<?= $tarefa->link_publicado ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="form-group">
                                                <input type="text" name="link_publicado" class="form-control" disabled value="<?= $tarefa->link_publicado ?>" placeholder="Informe o link">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="card card-chat">
                                    <div class="card-header">
                                        <h4 class="card-title">Comentários</h4>
                                    </div>
                                    <div class="card-content">
                                        <ol class="chat" id="olChat">
                                        <?php if (empty($comentarios)) : ?>
                                            <li class="text-muted"><p class="text-center fill-up">Nenhum comentário</p></li>
                                        <?php else :
                                            foreach ($comentarios as $comentario) :
                                            if ($comentario->id_usuario != $_SESSION['id_usuario']) :
                                        ?>
                                                <li class="other">
                                                    <div class="avatar">
                                                        <img src="../../uploads/usuarios/<?= $comentario->foto_usuario ?>" alt="Foto <?= $comentario->nome_usuario ?>" title="Foto <?= $comentario->nome_usuario ?>"/>
                                                    </div>
                                                    <div class="msg" title="Comentário de <?= $comentario->nome_usuario ?>" >
                                                        <p><?= $comentario->comentario ?></p>
                                                        <div class="card-footer">
                                                            <h6><?= date("d/m", strtotime($comentario->data_criacao)) ?> <?= date("H:i", strtotime($comentario->data_criacao)) ?></h6>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php else : ?>
                                                <li class="self">
                                                    <div class="msg" title="Comentário de <?= $comentario->nome_usuario ?>" >
                                                        <p><?= $comentario->comentario ?></p>
                                                        <div class="card-footer">
                                                            <h6><?= date("d/m", strtotime($comentario->data_criacao)) ?> <?= date("H:i", strtotime($comentario->data_criacao)) ?></h6>
                                                        </div>
                                                            <i class="ti-trash" onclick="excluiComentario(<?= $comentario->id_comentario ?>, this)"></i>
                                                    </div>
                                                    <div class="avatar">
                                                    <img src="../../uploads/usuarios/<?= $comentario->foto_usuario ?>" alt="Foto <?= $comentario->nome_usuario ?>" title="Foto <?= $comentario->nome_usuario ?>"/>
                                                    </div>
                                                </li>
                                                <?php endif;
                                                endforeach;
                                                endif; ?>
                                        </ol>
                                        <hr>
                                        <div class="send-message">
                                            <form id="formComentario" action="#" method="post">
                                                <input type="hidden" name="id_tarefa" value="<?= $id_tarefa ?>">
                                                <input class="form-control textarea" type="text" placeholder="Comente aqui!" name="comentario"/>
                                                <div class="send-button">
                                                    <button class="btn btn-primary btn-fill fundo-roxo-padrao" type="submit"><i class="material-icons">send</i></button>
                                                </div>
                                                <?php if (($_SESSION['funcao_usuario'] == '0' || $_SESSION['funcao_usuario'] == '1')) { ?>
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="radio radio-inline">
                                                                <input id="checkbox50" type="radio" value="0" name="equipe" checked>
                                                                <label for="checkbox50">
                                                                    Cliente
                                                                </label>
                                                            </div>
                                                        <div class="radio radio-inline">
                                                            <input id="checkbox51" type="radio" value="1" name="equipe">
                                                            <label for="checkbox51">
                                                                Equipe
                                                            </label>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <?php 
                                            } else if ($_SESSION['funcao_usuario'] == '3') { ?>
                                                    <input type="hidden" name="equipe" value="0">
                                            <?php 
                                        } else { ?>
                                                    <input type="hidden" name="equipe" value="1">
                                            <?php 
                                        } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-prazo">
                                        <div class="card-header">
                                            <h4 class="card-title">Prazos</h4>
                                        </div>
                                        <div class="card-content">
                                            <ul>
                                                <li>Produção: <?= date("d/m/Y", strtotime(retornaDataPrevista(CONTEUDO_ESCREVENDO, $id_tarefa))) ?></li>
                                                <li>Avaliação: <?= date("d/m/Y", strtotime(retornaDataPrevista(CONTEUDO_APROVACAO_MODERADOR, $id_tarefa))) ?></li>
                                                <li>Aprovação: <?= date("d/m/Y", strtotime(retornaDataPrevista(CONTEUDO_APROVACAO_CLIENTE, $id_tarefa))) ?></li>
                                                <li>Publicação: <?= date("d/m/Y", strtotime(retornaDataPrevista(CONTEUDO_PARA_PUBLICAR, $id_tarefa))) ?></li>
                                            </ul>
                                            <hr>
                                            <p>Conteúdo criado em <?= date("d/m/Y", strtotime($tarefa->data_criacao)) ?> às <?= date("H:i", strtotime($tarefa->data_criacao)) ?></p>
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
            function mostraHistorico(codHistorico){
                var dados = {id_publicacao: codHistorico};

                $.ajax({
                    url: "../../controller/publicacoes/consulta_publicacao.php",
                    type: "POST",
                    dataType: "json",
                    async: true,
                    data: dados,
                    timeout: 15000,
                    success: function (data) {
                        console.log(JSON.stringify(data));
                        var html = '<textarea name="texto_publicacao" id="editorHistorico">' + data+ '</textarea>';
                        swal({
                            html: html,
                            width: 900,
                            showCancelButton: false,
                            confirmButtonClass: 'btn btn-success btn-fill',
                            confirmButtonText: 'Fechar',
                            buttonsStyling: false
                        }).then(function() {});  
                            CKEDITOR.replace( 'editorHistorico', {
                                toolbarGroups : [
		                            { "name": "clipboard", "groups": [ "Copy"] }
                                ]                            
                            });
                    },
                    error: function (x, t, m) {
                        alert('Tempo esgotado');
                        console.log(JSON.stringify(x));
                    }
                });
            }

            function excluiComentario(codComentario, elem){
                var dados = {id_comentario: codComentario};
                swal({
                    title: 'Tem certeza?',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Excluir',
                    buttonsStyling: false
                }).then(function() {
                    $.ajax({
                        url: "../../controller/comentarios/exclui_comentario.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            $(elem).parents('li').remove();
                            swal('Comentário Excluido!');  
                        },
                        error: function (x, t, m) {
                            alert('Tempo esgotado');
                            console.log(JSON.stringify(x));
                        }
                    });
                });  
            }

            
            var elemDel;
            function rmfile(id,nomeArquivo,elem){
                elemDel = $(elem).parent();
                var dados = {id_anexo: id, nome_anexo: nomeArquivo}

            swal({
                    title: 'Tem certeza?',
                    text: "Esta imagem não poderá mais ser visualizada.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success btn-fill',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não',
                    buttonsStyling: false
                }).then(function() {
                    $.ajax({
                        url: "../../controller/anexos/remove_anexo.php",
                        type: "POST",
                        dataType: "json",
                        async: true,
                        data: dados,
                        timeout: 15000,
                        success: function (data) {
                            if(data == 'true'){
                                elemDel.fadeOut(300, function(){ 
                                $(this).remove();
                                var count = $('.contador-img').length;
                                if(count == 0){
                                    $('#espacoFotos').append('<div class="col-md-12"><p>Nenhuma imagem</p></div>');
                                    $(".img-capa").attr('src', '');
                                }else{
                                    var src = $('#espacoFotos').find('.col-md-3').eq(0).find('img').attr('src');
                                    $(".img-capa").attr('src', src);
                                }
                            });
                                swal({
                                    title: 'Sucesso!',
                                    text: 'A imagem foi removida.',
                                    type: 'success',
                                    confirmButtonClass: "btn btn-success btn-fill",
                                    buttonsStyling: false
                                    })
                            }else{
                                swal({
                                    title: 'Erro!',
                                    text: 'A imagem não foi removida.',
                                    type: 'error',
                                    confirmButtonClass: "btn btn-info btn-fill",
                                    buttonsStyling: false
                                    })
                            }
                        },
                        error: function (x, t, m) {
                            console.log(JSON.stringify(x));
                        }
                    });
                });
            }
        $(document).ready(function () {
           
            <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'apOk') { ?>
                funcoes.showNotification(0,1,'Conteúdo aprovado.');
            <?php 
        } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'nOk') { ?>
                funcoes.showNotification(0,1,'Conteúdo salvo.');
            <?php 
        } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'lOk') { ?>
                funcoes.showNotification(0,1,'Conteúdo publicado.');
            <?php 
        } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'naOk') { ?>
                funcoes.showNotification(0,1,'Conteúdo enviado para aprovação.');
            <?php 
        } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'reOk') { ?>
                funcoes.showNotification(0,1,'Conteúdo reprovado.');
            <?php 
        } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'imgOk') { ?>
                funcoes.showNotification(0,1,'Imagem adicionada.');
            <?php 
        } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'cErro') { ?>
                funcoes.showNotification(0,4,'<b>Erro</b> - entre em contato com o gerente.');
            <?php 
        } ?>
        var totalCaracteres = 0;

        iniciaCkeditor();
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
                            var d = new Date();
                            $('#formComentario input[type=text]').val('');
                            var msg = '<div class="msg"><p>'+dados['comentario']+'</p><div class="card-footer"><i class="ti-calendar"></i><h6>'+d.getDate()+'/'+(d.getMonth() + 1)+' '+d.getHours()+':'+d.getMinutes()+'</h6></div></div>';
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

            function enviaAprovacao(){
                $('textarea[name="texto_publicacao"]').html(CKEDITOR.instances.editor.getData());
                $("#controleCriacao").val(1);
                $("#formConteudo").submit();
            }
            
            function salvaConteudo(){
                $('textarea[name="texto_publicacao"]').html(CKEDITOR.instances.editor.getData());
                $("#controleCriacao").val(0);
                $("#formConteudo").submit();
            }
            
            $("#btnAprovaConteudo").click(function (e) { 
                e.preventDefault();
                swal({
                    html: '<div class="form-group">' +
                                '<label>Ajude  nos a aperfeiçoar as entregas de conteúdo. De 1 a 5 como você avalia o conteúdo que acabou de aprovar?</label>'+
                                '<div class="radio"><input type="radio" name="radioNota" id="radio1" value="1"><label for="radio1">1</label></div>'+
                                '<div class="radio"><input type="radio" name="radioNota" id="radio2" value="2"><label for="radio2">2</label></div>'+
                                '<div class="radio"><input type="radio" name="radioNota" id="radio3" value="3"><label for="radio3">3</label></div>'+
                                '<div class="radio"><input type="radio" name="radioNota" id="radio4" value="4"><label for="radio4">4</label></div>'+
                                '<div class="radio"><input type="radio" name="radioNota" id="radio5" value="5"><label for="radio5">5</label></div>'+
                            '</div>',
                    type: 'info',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Aprovar',
                    buttonsStyling: false
                }).then(function() {
                    // $("#inputNota").val($("#inputNotaModal").val());
                    $("#inputNota").val($('input[name=radioNota]:checked').val());
                    $("#formAprovaConteudo").attr('action', '../../controller/conteudo/aprova_conteudo.php');
                    $("#formAprovaConteudo").submit();
                });
            });
            $("#btnReprovaConteudo").click(function (e) {
                e.preventDefault();
                swal({
                    title: 'Informe o motivo?',
                    html: '<div class="form-group">' +
                                '<textarea class="form-control" row="5" id="inputMotivoModal"></textarea>' +
                            '</div>',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Solicitar ajuste',
                    buttonsStyling: false
                }).then(function() {
                    $("#inputMotivo").val($("#inputMotivoModal").val());
                    $("#formAprovaConteudo").attr('action', '../../controller/conteudo/reprova_conteudo.php');
                    $("#formAprovaConteudo").submit();
                });          
            });
            $("#btnLatSalvaConteudo").click(function (e) { 
                salvaConteudo();
            });
            $("#btnLatEnviaAprovacaoConteudo").click(function (e) { 
                enviaAprovacao();
            });
            $("#btnLatReprovaModerador").click(function (e) { 
                e.preventDefault();
                swal({
                    title: 'Informe o motivo?',
                    html: '<div class="form-group">' +
                                '<textarea class="form-control" row="5" id="inputMotivoModal"></textarea>' +
                            '</div>',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Solicitar ajuste',
                    buttonsStyling: false
                }).then(function() {
                    $("#inputMotivo").val($("#inputMotivoModal").val());
                    var content = CKEDITOR.instances.editor.getData();
                    console.log(content);
                    $("#refacoes").val(content);
                    $("#formAprovaConteudo").attr('action', '../../controller/conteudo/reprova_conteudo_moderador.php');
                    $("#formAprovaConteudo").submit();
                });  
            });
            $("#btnLatEnviaModeradorConteudo").click(function (e) { 
                $('textarea[name="texto_publicacao"]').html(CKEDITOR.instances.editor.getData());
                $("#controleCriacao").val(2);
                $("#formConteudo").submit();
            });

            function contaCaracteres() { 
                totalCaracteres = $('#summernote').text().replace(/(<([^>]+)>)/ig, "").replace(/( )/, " ").length;
                //Update Count value
	            $("#total-caracteres").text(totalCaracteres);
             }
        });
    </script>
</html>