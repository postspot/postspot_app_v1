<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
require_once '../../model/tipo_tarefa.php';
require_once '../../model/tarefas.php';
require_once '../../model/comentarios.php';
require_once 'includes/header_padrao.php';

if(!isset($_GET["t"])){
    header('location: ../../view/adm/dashboard.php?erro=te');
}else{
    $id_tarefa = $_GET["t"];
}

$tiposTarefa = tipo_tarefa::getAllTiposTaredas();
$tarefa = tarefas::getById($id_tarefa);
$persona = personas::getByProjeto($_SESSION['id_projeto']);
$comentarios = comentarios::getAllComentariosByTarefa($id_tarefa);
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
                        
                        <h4 class="title"><i class="ti-light-bulb"></i> Criar Pauta</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <form class="form-horizontal" action="../../controller/pautas/edita_pauta.php" method="POST" id="formEditaPauta">
                                    <input type="hidden" name="aprovacao" id="controlaAprovacao">
                                    <input type="hidden" name="id_tarefa" value="<?= $id_tarefa ?>">
                                    <input type="hidden" name="etapa" value="<?= $tarefa->etapa ?>">
                                    <input type="hidden" name="motivo" id="inputMotivo">
                                        <div class="card-content">
                                            <div class="form-group column-sizing">
                                                <label class="col-md-2 control-label">Título</label>
                                                <div class="col-md-5">
                                                    <input required type="text" placeholder="Título da Pauta" name="nome_tarefa" class="form-control" value="<?= $tarefa->nome_tarefa ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Tipo</label>
                                                <div class="col-md-5">
                                                    <select class="form-control" name="tipo_tarefa">
                                                        <?php foreach ($tiposTarefa as $tipoTarefa) : ?>
                                                            <option value="<?= $tipoTarefa->id_tipo ?>" <?= ($tarefa->id_tipo == $tipoTarefa->id_tipo)? 'selected' : '' ?>><?= $tipoTarefa->nome_tarefa ?></option>
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
                                                        <input type="radio" name="estagio_compra" id="estagio1" value="Aprendizado e Descoberta" <?= ($tarefa->estagio_compra == 'Aprendizado e Descoberta')? 'checked' : '' ?>>
                                                        <label for="estagio1">
                                                            Aprendizado e Descoberta
                                                        </label>
                                                    </div>

                                                    <div class="radio">
                                                        <input type="radio" name="estagio_compra" id="estagio2" value="Reconhecimento do Problema" <?= ($tarefa->estagio_compra == 'Reconhecimento do Problema')? 'checked' : '' ?>>
                                                        <label for="estagio2">
                                                            Reconhecimento do Problema
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="estagio_compra" id="estagio3" value="Consideração da Solução" <?= ($tarefa->estagio_compra == 'Consideração da Solução')? 'checked' : '' ?>>
                                                        <label for="estagio3">
                                                            Consideração da Solução
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="estagio_compra" id="estagio4" value="Decisão de Compra" <?= ($tarefa->estagio_compra == 'Decisão de Compra')? 'checked' : '' ?>>
                                                        <label for="estagio4">
                                                            Decisão de Compra
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Persona</label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="id_persona" required>
                                                        <?php if(empty($persona)): ?>
                                                            <option value="" disabled selected>Nenhuma persona cadastrada!</option>
                                                        <?php else:
                                                        foreach ($persona as $pers) {
                                                        ?>
                                                        
                                                        <option value="<?= $pers->id_persona ?>" <?= ($tarefa->id_persona == $pers->id_persona)? 'selected' : '' ?>><?= $pers->nome ?></option>
                                                        
                                                        <?php
                                                        } endif;
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                                <?php if($tarefa->etapa != 2 && $tarefa->etapa < 5): ?>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Ação necessaria</h4>
                                            </div>
                                            <div class="card-content">
                                                <?php if($tarefa->etapa == 0 || $tarefa->etapa == 3 ): ?>
                                                    <button type="button" class="btn btn-wd btn-info btn-fill btn-magnify fill-up margem" id="salvaPauta">
                                                        <span class="btn-label">
                                                            <i class="ti-save"></i>
                                                        </span>
                                                        Salvar
                                                    </button>
                                                    <button type="button" class="btn btn-wd btn-success btn-fill btn-move-right fill-up margem" id="enviaAprovacaoPauta">
                                                        Enviar Aprovação
                                                        <span class="btn-label">
                                                            <i class="ti-control-forward"></i>
                                                        </span>
                                                    </button>
                                                <?php endif; ?>
                                                <?php if($tarefa->etapa == 1 || $tarefa->etapa == 4): ?>
                                                    <?php if($_SESSION['funcao_usuario'] != '2' && $_SESSION['funcao_usuario'] != '4'):?>
                                                        <button type="button" class="btn btn-wd btn-danger btn-fill btn-move-right fill-up margem" id="reprovaPauta">
                                                            Reprovar
                                                            <span class="btn-label">
                                                                <i class="ti-control-forward"></i>
                                                            </span>
                                                        </button>
                                                        <button type="button" class="btn btn-wd btn-success btn-fill btn-move-right fill-up margem" id="aprovaPauta">
                                                            Aprovar
                                                            <span class="btn-label">
                                                                <i class="ti-control-forward"></i>
                                                            </span>
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-4">
                                    <div class="card card-chat">
                                        <div class="card-header">
                                            <h4 class="card-title">Comentários Pauta</h4>
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

        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'nErro') { ?>
            funcoes.showNotification(0,4,'<b>Erro</b> - erro ao salvar pauta.');
        <?php } ?>

        $("#salvaPauta").click(function (e) { 
            e.preventDefault();
            $("#formEditaPauta").attr('action', '../../controller/pautas/edita_pauta.php');
            $("#controlaAprovacao").val('0');
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
            $("#formEditaPauta").attr('action', '../../controller/pautas/aprova_pauta.php');
            $("#formEditaPauta").submit();            
        });
        $("#reprovaPauta").click(function (e) { 
            e.preventDefault();
            
            swal({
                title: 'Informe o motivo?',
                html: '<div class="form-group">' +
                            '<textarea class="form-control" row="5" id="inputMotivoModal"></textarea>' +
                        '</div>',
                type: 'warning',
                showCancelButton: true,
                cancelButtonClass: 'btn btn-danger btn-fill',
                confirmButtonClass: 'btn btn-success btn-fill',
                confirmButtonText: 'Reprovar!',
                buttonsStyling: false
                }).then(function() {
                    $("#inputMotivo").val($("#inputMotivoModal").val());
                    $("#formEditaPauta").attr('action', '../../controller/pautas/reprova_pauta.php');
                    $("#formEditaPauta").submit();
                });          
        });
    });
    </script>
</html>