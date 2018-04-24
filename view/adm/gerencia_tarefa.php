<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once 'includes/header_padrao.php';

$tarefas = tarefas::getAll();

?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Gerenciar Tarefa - PostSpot</title>
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
							<h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Gerenciar Tarefa</h4>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="card">
	                            <div class="card-content">
	                                <div class="toolbar">
	                                    <!--Here you can write extra buttons/actions for the toolbar-->
	                                </div>
	                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
									<thead>
										<tr>
                                            <th class="disabled-sorting">ID</th>
											<th>Titulo</th>
											<th>Tipo</th>
											<th class="disabled-sorting">Excluir</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>ID</th>
											<th>Titulo</th>
											<th>Tipo</th>
											<th>Excluir</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($tarefas as $tarefa) { 					
											?>
											<tr>
												<td><?= $tarefa->id_tarefa ?></td>
												<td><?= $tarefa->nome_tarefa ?></td>
												<td><?= $tarefa->nome_tipo ?></td>
												<td>
													<a href="status_tarefa.php?t=<?=$tarefa->id_tarefa?>" target="_blank" class="btn btn-simple btn-info btn-icon"><i class="ti-eye"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove-tarefa"><i class="ti-close"></i></a>
												</td>
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

    <script type="text/javascript">
	    $(document).ready(function() {

	        $('#datatables').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
				language: {
					"sEmptyTable": "Nenhuma tarefa encontrada",
					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ tarefas",
					"sInfoEmpty": "Mostrando 0 até 0 de 0 tarefas",
					"sInfoFiltered": "(Filtrados de _MAX_ tarefas)",
					"sInfoPostFix": "",
					"sInfoThousands": ".",
					"sLengthMenu": "_MENU_ resultados por página",
					"sLoadingRecords": "Carregando...",
					"sProcessing": "Processando...",
					"sZeroRecords": "Nenhuma tarefa disponível",
					"search": "Pesquisar",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					},
					"oAria": {
						"sSortAscending": ": Ordenar colunas de forma ascendente",
						"sSortDescending": ": Ordenar colunas de forma descendente"
					}
				}
	        });


	        var table = $('#datatables').DataTable();
	         // Edit record
	         table.on( 'click', '.remove-tarefa', function () {
	            $tr = $(this).closest('tr');

	            var data = table.row($tr).data();
				
				var dados = {id_tarefa: data[0]}
				$.ajax({
					url: "../../controller/tarefas/exclui_tarefa.php",
					type: "POST",
					dataType: "json",
					async: true,
					data: dados,
					timeout: 15000,
					success: function (data) {
						if(data == 'true'){
							table.row($tr).remove().draw();
							swal({
								title: 'Sucesso!',
								text: 'A tarefa foi removida.',
								type: 'success',
								confirmButtonClass: "btn btn-success btn-fill",
								buttonsStyling: false
								})
						}else{
							swal({
								title: 'Erro!',
								text: 'A tarefa não foi removida.',
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
	         } );

	    });
	</script>
</html>