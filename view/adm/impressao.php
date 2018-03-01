<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';

$inicio = (empty($_GET['i']) ? null : $_GET['i']);
$fim = (empty($_GET['f']) ? null : $_GET['f']);
$redatorEscolhido = $_GET["r"];
$conteudos = tarefas::getTarefasByRedator($redatorEscolhido, dataBRparaPHP($inicio), dataBRparaPHP($fim));
$inf_redator = usuarios::getById($redatorEscolhido);
$total = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Relatório conteúdos - <?= $inf_redator->nome_usuario ?></title>
        <link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print" />
    </head>
    <body>

        <p><strong>Nome:</strong> <?= $inf_redator->nome_usuario ?></p>
        <p><strong>CPF/CNPJ:</strong> <?= $inf_redator->doc_usuario ?></p>
        <p><strong>Banco:</strong> <?= $inf_redator->banco_usuario ?></p>
        <p><strong>Agência:</strong> <?= $inf_redator->agencia_usuario ?></p>
        <p><strong>Conta:</strong> <?= $inf_redator->conta_usuario ?></p>  
            <table id="" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo de conteúdo</th>
                        <th>Título</th>
                        <th>Empresa</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($conteudos as $conteudo):
                        $total = $total + $conteudo->valor_tipo_tarefa
                        ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($conteudo->data_criacao)) ?></td>
                            <td><?= $conteudo->nome_tipo_tarefa ?></td>
                            <td><?= $conteudo->nome_tarefa ?></td>
                            <td><?= $conteudo->nome_projeto ?></td>
                            <td >R$ <?= number_format($conteudo->valor_tipo_tarefa, 2, ',', ' ') ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p><b>TOTAL: </b> R$ <?= str_replace(".", ",", number_format($total,2)) ?></p>
              
        <!--Includes menu-->
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                window.print();
            });
        </script>

    </body>
</html>
