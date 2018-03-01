<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';

$inicio = (empty($_GET['i']) ? null : $_GET['i']);
$fim = (empty($_GET['f']) ? null : $_GET['f']);
$projetoEscolhido = $_GET["proj"];
$conteudos = tarefas::getTarefasAvaliacao($projetoEscolhido, dataBRparaPHP($inicio), dataBRparaPHP($fim));
$media = 0;
$nomeProjeto = '';

$projeto = projetos::getById($projetoEscolhido);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Relatório Avaliação</title>
        <link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print" />
    </head>
    <body>

        <p><strong>Projeto: </strong> <?= $projeto->nome_projeto?></p>
        <p><strong>Site projeto: </strong> <?= $projeto->site_projeto?></p>
            <table id="" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nome conteúdo</th>
                        <th>Redator(es)</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($conteudos as $conteudo):
                        $media = $media + $conteudo->nota_tarefa;
                        $redatores = tarefas::getRedatoresTarefa($conteudo->id_tarefa);
                        ?>
                        <tr>
                            <td><?= $conteudo->nome_tarefa ?></td>
                            <td>
                                <?php if (!empty($redatores)): ?>
                                    <ul>
                                        <?php foreach ($redatores as $redator): ?>
                                            <li><?=$redator->nome_redator?></li>
                                        <?php endforeach;?>
                                </ul>
                                <?php else: ?>
                                    -/-
                                <?php endif;?>
                            </td>
                            <td><?= ((empty($conteudo->nota_tarefa)) ? '-/-' : $conteudo->nota_tarefa) ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p><b>Media do projeto: </b> R$ <?= str_replace(".", ",", number_format($media / count($conteudos), 2)) ?></p>
              
        <!--Includes menu-->
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                window.print();
            });
        </script>

    </body>
</html>
