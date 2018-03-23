<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';

$inicio = (empty($_GET['i']) ? null : $_GET['i']);
$fim = (empty($_GET['f']) ? null : $_GET['f']);
 
if (isset($_GET["r"])) {
    $redatorEscolhido = $_GET["r"];
    $conteudos = tarefas::getTarefasByRedator($redatorEscolhido, dataBRparaPHP($inicio), dataBRparaPHP($fim));
    $inf_redator = usuarios::getById($redatorEscolhido);
    $msgErro = 'Nenhuma pauta encontrada';
}else{
    $redatorEscolhido = 0;
    $conteudos = '';
    $msgErro = 'Nenhum analista selecionado';
}
$redatores = usuarios::getAllTipo(1);
$total = 0;
//pre_r($redatores);
//die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Relatório - Postspot</title>
        <?php require_once './includes/header_imports.php'; ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>

    <body>
        <div class="wrapper">

            <!--Side Bar-->
            <?php require_once './includes/side_bar.php'; ?>

            <div class="main-panel">

                <!--Menu Topo-->
                <?php require_once './includes/menu_topo.php'; ?>

                <div class="content relative">
                    
                    <div class="container-fluid relative">
                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">assessment</i> Relatório de produção de Pauta</h4>

                        <div class="row">
                            <div class="col-lg-12 fundo-campos-busca">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <div class="form-group">
                                                <select class="form-control select-customizado" id="listaRedatores">
                                                    <option selected disabled>Escolha o analista</option>
                                                    <?php foreach ($redatores as $redator):?>
                                                        <option value="<?= $redator->id_usuario ?>" <?= ($redatorEscolhido == $redator->id_usuario) ? 'selected' : ''?>><?= $redator->nome_usuario ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <!--<div class="col-lg-2">
                                        <fieldset>
                                            <div class="form-group">
                                                <select class="form-control select-customizado" id="listaTipo">
                                                    <option selected disabled>Escolha o tipo</option>
                                                        <option value="1">Pauta</option>
                                                        <option value="2">Conteúdo</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>-->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Início relatório"  id="dataInicio" value="<?=$inicio?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Fim relatório" id="dataFim" value="<?=$fim?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn fill-up fundo-roxo-padrao" id="buscarResultados">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (empty($conteudos)): ?>
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="typo-line text-center">
                                            <h2 class="cor-roxo-escuro empty-title"><?=$msgErro?></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p><strong>Nome:</strong> <?= $inf_redator->nome_usuario ?></p>
                                            <p><strong>CPF/CNPJ:</strong> <?= $inf_redator->doc_usuario ?></p>
                                            <p><strong>Banco:</strong> <?= $inf_redator->banco_usuario ?></p>
                                            <p><strong>Agência:</strong> <?= $inf_redator->agencia_usuario ?></p>
                                            <p><strong>Conta:</strong> <?= $inf_redator->conta_usuario ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <p><strong>Data</strong></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p><strong>Tipo de conteúdo</strong></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <p><strong>Título</strong></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p><strong>Empresa</strong></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p><strong>Valor</strong></p>
                                        </div>
                                    </div>
                                        <div class="card-tarefa">
                                <?php foreach ($conteudos as $conteudo):
                                        $total = $total + $conteudo->valor_tipo_tarefa
                                        ?>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p><?= date('d/m/Y', strtotime($conteudo->data_criacao)) ?></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p><?= $conteudo->nome_tipo_tarefa ?></p>
                                                </div>
                                                <div class="col-lg-3">
                                                    <p><?= $conteudo->nome_tarefa ?></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p><?= $conteudo->nome_projeto ?></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p> R$ <?= str_replace(".", ",", $conteudo->valor_tipo_tarefa); ?></p>
                                                </div>  
                                                <div class="col-lg-1">
                                                    <a target="_blank" href="detalhes_conteudo.php?t=<?= $conteudo->id_tarefa ?>" class="btn btn-success fill-up fundo-roxo-escuro"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                    <?php endforeach; ?>
                                        <hr>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <p class="title"><strong>Valor total: R$ <?=str_replace(".", ",", number_format($total,2))?></strong></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a target="_blank" class="btn btn-success fill-up fundo-roxo-escuro" href="impressao.php?r=<?=$redatorEscolhido?>&i=<?=$inicio?>&f=<?=$fim?>"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                                                </div>
                                            </div>
                                        </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<?php require_once './includes/footer_imports.php'; ?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $(".select-customizado").select2();

        $('#buscarResultados').on("click", function(e) {
         var siteBase = '<?= SITE ?>';
         window.location.href = siteBase + 'view/adm/relatorio_conteudo.php?r='+$('#listaRedatores').val()+'&i='+$("#dataInicio").val()+'&f='+$("#dataFim").val();
        });
        $(function () {
            var dateFormat = "dd/mm/yy",
                    from = $("#dataInicio")
                    .datepicker({
                        dateFormat: 'dd/mm/yy'
                    })
                    .on("change", function () {
                        to.datepicker("option", "minDate", getDate(this));
                    }),
                    to = $("#dataFim").datepicker({
                dateFormat: 'dd/mm/yy'
            })
                    .on("change", function () {
                        from.datepicker("option", "maxDate", getDate(this));
                    });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }
        });
    </script>
</html>