<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';

$inicio = (empty($_GET['i']) ? null : $_GET['i']);
$fim = (empty($_GET['f']) ? null : $_GET['f']);
if (isset($_GET["proj"])) {
    //echo 'P: ' . $_GET["proj"];
    $projetoEscolhido = $_GET["proj"];
    $conteudos = tarefas::getTarefasAvaliacao($projetoEscolhido, dataBRparaPHP($inicio), dataBRparaPHP($fim));
} else {
    $projetoEscolhido = 0;
    $conteudos = '';
}   
$projetos = projetos::getAll();
$media = 0;
// pre_r($conteudos);
// die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php';?>
        <title>Pautas - Postspot</title>
        <?php require_once './includes/header_imports.php';?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>

    <body>
        <div class="wrapper">

            <!--Side Bar-->
            <?php require_once './includes/side_bar.php';?>

            <div class="main-panel">

                <!--Menu Topo-->
                <?php require_once './includes/menu_topo.php';?>

                <div class="content relative">

                    <div class="container-fluid relative">
                        <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">assessment</i> Relatório de Avaliação de Conteúdo</h4>

                        <div class="row">
                            <div class="col-lg-12 fundo-campos-busca">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <div class="form-group">
                                                <select class="form-control select-customizado" name="titulo_noticia">
                                                    <option selected disabled>Escolha o projeto aqui</option>
                                                    <?php foreach ($projetos as $projeto): ?>
                                                        <option value="<?=$projeto->id_projeto?>" <?= ($projetoEscolhido == $projeto->id_projeto) ? 'selected' : ''?>><?=$projeto->nome_projeto?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Início relatório"  id="dataInicio" value="<?=$inicio?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
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
                                            <h2 class="cor-roxo-escuro empty-title">Nenhum projeto selecionado</h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="title"><strong>Nome conteúdo</strong></p>
                                        </div>
                                        <div class="col-lg-3">
                                            <p>Redator(es)</p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p>Nota</p>
                                        </div>
                                    </div>
	                                        <div class="card-tarefa">
                                <?php foreach ($conteudos as $conteudo):
    $media = $media + $conteudo->nota_tarefa;
    $redatores = tarefas::getRedatoresTarefa($conteudo->id_tarefa);
    ?>
	                                            <div class="row">
	                                                <div class="col-lg-6">
	                                                    <p><?=$conteudo->nome_tarefa?></p>
	                                                </div>
	                                                <div class="col-lg-3">
	                                                    <?php if (!empty($redatores)): ?>
	                                                        <ul>
	                                                            <?php foreach ($redatores as $redator): ?>
	                                                                <li><?=$redator->nome_redator?></li>
	                                                            <?php endforeach;?>
                                                        </ul>
                                                        <?php else: ?>
                                                            -/-
                                                        <?php endif;?>
                                                </div>
                                                <div class="col-lg-1 text-center">
                                                    <p><?=((empty($conteudo->nota_tarefa)) ? '-/-' : $conteudo->nota_tarefa)?></p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a target="_blank" href="detalhes_conteudo.php?t=<?=$conteudo->id_tarefa?>" class="btn btn-success fill-up fundo-roxo-escuro"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                    <?php endforeach;?>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p class="title"><strong>Média do Projeto: <?=str_replace(".", ",", number_format($media / count($conteudos), 2))?></strong></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <a target="_blank" class="btn btn-success fill-up fundo-roxo-escuro" href="impressao2.php?proj=<?=$projetoEscolhido?>&i=<?=$inicio?>&f=<?=$fim?>"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
                                        </div>
                                    </div>
                                        </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<?php require_once './includes/footer_imports.php';?>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $(".select-customizado").select2();

        $('#buscarResultados').on("click", function(e) {
         var siteBase = '<?=SITE?>';
         window.location.href = siteBase + 'view/adm/relatorio_avaliacao.php?proj='+$(".select-customizado").val()+'&i='+$("#dataInicio").val()+'&f='+$("#dataFim").val();
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