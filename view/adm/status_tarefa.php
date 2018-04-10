<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/log_tarefas.php';
require_once 'includes/header_padrao.php';

$logTarefa = log_tarefas::getAllById(1);

?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Log Tarefa - PostSpot</title>
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
							<h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Log Tarefa</h4>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="card">
	                            <div class="card-content">
	                                <div class="toolbar">
	                                    <!--Here you can write extra buttons/actions for the toolbar-->
	                                </div>
	                                <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<thead>
										<tr>
                                            <th class="disabled-sorting">Ação</th>
											<th>Responsável</th>
											<th>Status</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
                                            <th>Ação</th>
											<th>Responsável</th>
											<th>Status</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($logTarefa as $log) { 					
											?>
											<tr>
												<td><?= retornaTextoNotificacaoTarefa($log->etapa) ?></td>
												<td><?= $log->nome_usuario ?></td>
												<td><?= ($log->status == '1') ? 'Atual': 'Anterior'  ?></td>
											</tr>
										<?php } ?>
									   </tbody>
									</table>
	                            </div>
	                        </div><!--  end card  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
</html>