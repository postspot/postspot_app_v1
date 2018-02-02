<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
require_once '../../model/tipo_tarefa.php';
require_once '../../model/tarefas.php';
require_once '../../model/comentarios.php';
require_once 'includes/header_padrao.php';

if (!isset($_GET["t"])) {
    header('location: ../../view/adm/dashboard.php?erro=te');
} else {
    $id_tarefa = $_GET["t"];
}

$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
$tarefa = tarefas::getById($id_tarefa);
$persona = personas::getByProjeto($_SESSION['id_projeto']);
$comentarios = comentarios::getAllComentariosByTarefa($id_tarefa, 0, '');
// pre_r($tarefa);
// pre_r($persona);
// die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Detalhes da Pauta - PostSpot</title>
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

                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">list</i> Detalhes Pauta</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                                    <li class="active"><a href="#pauta" data-toggle="tab">Informações</a></li>
                                                    <?= ($_SESSION['funcao_usuario'] == 0 || $_SESSION['funcao_usuario'] == 1) ? '<li><a href="#editar" data-toggle="tab">Editar</a></li>' : '' ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="tab-pauta" class="tab-content">

                                            <div class="tab-pane pane-pauta active" id="pauta">
                                                <div class="form-group column-sizing">
                                                    <label class="col-md-4 control-label">Título:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->nome_tarefa ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Tipo:</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        foreach ($tiposTarefa as $tipoTarefa) :
                                                            if ($tarefa->id_tipo == $tipoTarefa->id_tipo) :
                                                        ?>
                                                                <p><?= $tipoTarefa->nome_tarefa ?></p>
                                                                <?php
                                                                endif;
                                                                endforeach;
                                                                ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Palavra-chave:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->palavra_chave ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Briefing:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->briefing_tarefa ?></p>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Estágio de Compra:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->estagio_compra ?></p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Persona:</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        foreach ($persona as $pers) :
                                                            if ($tarefa->id_persona == $pers->id_persona) :
                                                        ?>
                                                                <p><?= $pers->nome ?></p>
                                                                <?php
                                                                endif;
                                                                endforeach;
                                                                ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Tipo de CTA:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->tipo_cta ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Referências:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->referencias ?></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Considerações Gerais:</label>
                                                    <div class="col-md-8">
                                                        <p><?= $tarefa->consideracoes_gerais ?></p>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="tab-pane pane-pauta" id="editar">
                                                <form class="form-horizontal" action="../../controller/pautas/edita_pauta.php" method="POST" id="formEditaPauta">
                                                    <input type="hidden" name="aprovacao" id="controlaAprovacao">
                                                    <input type="hidden" name="id_tarefa" value="<?= $id_tarefa ?>">
                                                    <input type="hidden" name="etapa" value="<?= $tarefa->etapa ?>">
                                                    <input type="hidden" name="nome_tarefa" value="<?= $tarefa->nome_tarefa ?>">
                                                    <input type="hidden" name="motivo" id="inputMotivo">
                                                    <div class="form-group column-sizing">
                                                        <label class="col-md-2 control-label">Título</label>
                                                        <div class="col-md-9">
                                                            <input required type="text" placeholder="Título da Pauta" name="nome_tarefa" class="form-control" value="<?= $tarefa->nome_tarefa ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Tipo</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="tipo_tarefa">
                                                                <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                                    <option value="<?= $tipoTarefa->id_tipo ?>" <?= ($tarefa->id_tipo == $tipoTarefa->id_tipo) ? 'selected' : '' ?>><?= $tipoTarefa->nome_tarefa ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Palavra Chave</label>
                                                        <div class="col-md-9">
                                                            <input required type="text" class="form-control" name="palavra_chave" value="<?= $tarefa->palavra_chave ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Briefing</label>
                                                        <div class="col-md-9">
                                                            <textarea required rows="5" class="form-control border-input" placeholder="" name="briefing_tarefa"><?= $tarefa->briefing_tarefa ?></textarea>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Estágio de Compra</label>
                                                        <div class="col-md-10">

                                                            <div class="radio">
                                                                <input type="radio" name="estagio_compra" id="estagio1" value="Conhecimento" <?= ($tarefa->estagio_compra == 'Conhecimento') ? 'checked' : '' ?>>
                                                                <label for="estagio1">
                                                                    Conhecimento
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <input type="radio" name="estagio_compra" id="estagio3" value="Consideração" <?= ($tarefa->estagio_compra == 'Consideração') ? 'checked' : '' ?>>
                                                                <label for="estagio3">
                                                                    Consideração
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <input type="radio" name="estagio_compra" id="estagio4" value="Decisão" <?= ($tarefa->estagio_compra == 'Decisão') ? 'checked' : '' ?>>
                                                                <label for="estagio4">
                                                                    Decisão
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Persona</label>
                                                        <div class="col-md-4">
                                                            <select class="form-control" name="id_persona" required>
                                                                <?php if (empty($persona)) : ?>
                                                                    <option value="" disabled selected>Nenhuma persona cadastrada!</option>
                                                                    <?php
                                                                    else :
                                                                        foreach ($persona as $pers) {
                                                                        ?>

                                                                        <option value="<?= $pers->id_persona ?>" <?= ($tarefa->id_persona == $pers->id_persona) ? 'selected' : '' ?>><?= $pers->nome ?></option>

                                                                        <?php

                                                                    }
                                                                    endif;
                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Tipo de CTA</label>
                                                        <div class="col-md-9">
                                                            <textarea rows="5" class="form-control border-input" placeholder="" name="tipo_cta"><?= $tarefa->tipo_cta ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Referências</label>
                                                        <div class="col-md-9">
                                                            <textarea rows="5" class="form-control border-input" placeholder="" name="referencias"><?= $tarefa->referencias ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Considerações Gerais</label>
                                                        <div class="col-md-9">
                                                            <textarea rows="5" class="form-control border-input" placeholder="" name="consideracoes_gerais"><?= $tarefa->consideracoes_gerais ?></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php if ($tarefa->etapa < CONTEUDO_ESCREVENDO && $_SESSION['funcao_usuario'] != '2' && $_SESSION['funcao_usuario'] != '4') : ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Ação necessária</h4>
                                        </div>
                                        <div class="card-content">
                                            <?php if (($tarefa->etapa == PAUTA_ESCREVENDO || $tarefa->etapa == PAUTA_AJUSTANDO) && ($_SESSION['funcao_usuario'] == '0' || $_SESSION['funcao_usuario'] == '1')) : ?>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem fundo-roxo-escuro" id="salvaPauta">
                                                    <span class="btn-label">
                                                        <i class="material-icons">save</i>
                                                    </span>
                                                    Salvar Pauta
                                                </button>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem azul-cinco" id="enviaPautaModeracao">
                                                    <span class="btn-label">
                                                        <i class="material-icons">fast_forward</i>
                                                    </span>
                                                    Enviar PostSpot
                                                </button>
                                            <?php endif; ?>
                                            <?php if ($_SESSION['funcao_usuario'] == '0' && ($tarefa->etapa == PAUTA_APROVACAO_MODERADOR || $tarefa->etapa == PAUTA_REAPROVACAO_MODERADOR)) : ?>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem azul-cinco" id="enviaAprovacaoPauta">
                                                    <span class="btn-label">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                    Enviar para o cliente
                                                </button>
                                                <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem fundo-rosa-claro" id="reprovaPautaModeracao">
                                                    <span class="btn-label">
                                                        <i class="material-icons">close</i>
                                                    </span>
                                                    Reprovar Pauta
                                                </button>
                                            <?php endif; ?>
                                            <?php if ($tarefa->etapa == PAUTA_APROVACAO_CLIENTE || $tarefa->etapa == PAUTA_REAPROVACAO_CLIENTE) : ?>
                                                <?php if ($_SESSION['funcao_usuario'] == '0' || $_SESSION['funcao_usuario'] == '3') : ?>
                                                    <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem azul-cinco" id="aprovaPauta">
                                                        <span class="btn-label">
                                                            <i class="material-icons">check</i>
                                                        </span>
                                                        Aprovar Pauta
                                                    </button>
                                                    <button type="button" class="btn btn-lg fill-up  btn-wd btn-success margem fundo-rosa-claro" id="reprovaPauta">
                                                        <span class="btn-label">
                                                            <i class="material-icons">close</i>
                                                        </span>
                                                        Reprovar Pauta
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="card card-chat">
                                    <div class="card-header">
                                        <h4 class="card-title">Comentários Pauta</h4>
                                    </div>
                                    <div class="card-content">
                                        <ol class="chat" id="olChat">
                                            <?php if (empty($comentarios)) : ?>
                                                <li class="text-muted"><p class="text-center fill-up">Nenhum comentário</p></li>
                                                <?php
                                                else :
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
                                                                    <i class="ti-calendar"></i>
                                                                    <h6><?= date("d/m", strtotime($comentario->data_criacao)) ?> <?= date("h:i", strtotime($comentario->data_criacao)) ?></h6>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php else : ?>
                                                        <li class="self">
                                                            <div class="msg" title="Comentário de <?= $comentario->nome_usuario ?>" >
                                                                <p><?= $comentario->comentario ?></p>
                                                                <div class="card-footer">
                                                                    <i class="ti-calendar"></i>
                                                                    <h6><?= date("d/m", strtotime($comentario->data_criacao)) ?> <?= date("h:i", strtotime($comentario->data_criacao)) ?></h6>
                                                                </div>
                                                            </div>
                                                            <div class="avatar">
                                                                <img src="../../uploads/usuarios/<?= $comentario->foto_usuario ?>" alt="Foto <?= $comentario->nome_usuario ?>" title="Foto <?= $comentario->nome_usuario ?>"/>
                                                            </div>
                                                        </li>
                                                    <?php
                                                    endif;
                                                    endforeach;
                                                    endif;
                                                    ?>
                                        </ol>
                                    </div>
                                </div>
                                <div class="card card-prazo">
                                        <div class="card-header">
                                            <h4 class="card-title">Prazos</h4>
                                        </div>
                                        <div class="card-content">
                                            <ul>
                                                <li>Avaliação: <?= date("d/m/Y", strtotime(retornaDataPrevista(PAUTA_APROVACAO_MODERADOR, $id_tarefa))) ?></li>
                                                <li>Aprovação: <?= date("d/m/Y", strtotime(retornaDataPrevista(PAUTA_REAPROVACAO_CLIENTE, $id_tarefa))) ?></li>
                                            </ul>
                                            <hr>
                                            <p>Pauta criada em <?= date("d/m/Y", strtotime($tarefa->data_criacao)) ?> às <?= date("H:i", strtotime($tarefa->data_criacao)) ?></p>
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

<?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'nErro') { ?>
                funcoes.showNotification(0, 4, '<b>Erro</b> ao salvar pauta.');
    <?php

}
?>

            $("#salvaPauta").click(function (e) {
                e.preventDefault();
                $("#formEditaPauta").attr('action', '../../controller/pautas/edita_pauta.php');
                $("#controlaAprovacao").val('0');
                $("#formEditaPauta").submit();
            });
            $("#enviaPautaModeracao").click(function (e) {
                e.preventDefault();
                $("#formEditaPauta").attr('action', '../../controller/pautas/edita_pauta.php');
                $("#controlaAprovacao").val('2');
                $("#formEditaPauta").submit();
            });
            $("#enviaAprovacaoPauta").click(function (e) {
                e.preventDefault();
                $("#formEditaPauta").attr('action', '../../controller/pautas/edita_pauta.php');
                $("#controlaAprovacao").val('1');
                $("#formEditaPauta").submit();
            });
            $("#aprovaPauta").click(function (e) {
                e.preventDefault();
                swal({
                    title: 'Alguma observação sobre a pauta?',
                    html: '<div class="form-group">' +
                            '<textarea class="form-control" row="5" id="inputMotivoModal"></textarea>' +
                            '</div>',
                    type: 'info',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Aprovar',
                    buttonsStyling: false
                }).then(function () {
                    $("#inputMotivo").val($("#inputMotivoModal").val());
                    $("#formEditaPauta").attr('action', '../../controller/pautas/aprova_pauta.php');
                    $("#formEditaPauta").submit();
                });
            });
            $("#reprovaPauta").click(function (e) {
                e.preventDefault();

                swal({
                    title: 'Informe, de forma clara, o motivo da reprovação do conteúdo',
                    html: '<div class="form-group">' +
                            '<textarea class="form-control" row="5" id="inputMotivoModal"></textarea>' +
                            '</div>',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Reprovar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    $("#inputMotivo").val($("#inputMotivoModal").val());
                    $("#formEditaPauta").attr('action', '../../controller/pautas/reprova_pauta.php');
                    $("#formEditaPauta").submit();
                });
            });

            $("#reprovaPautaModeracao").click(function (e) {
                e.preventDefault();

                swal({
                    title: 'Informe, de forma clara, o motivo da reprovação do conteúdo',
                    html: '<div class="form-group">' +
                            '<textarea class="form-control" row="5" id="inputMotivoModal"></textarea>' +
                            '</div>',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Reprovar',
                    cancelButtonText: 'Cancelar',
                    buttonsStyling: false
                }).then(function () {
                    $("#inputMotivo").val($("#inputMotivoModal").val());
                    $("#formEditaPauta").attr('action', '../../controller/pautas/reprova_pauta_moderador.php');
                    $("#formEditaPauta").submit();
                });
            });
        });
    </script>
</html>