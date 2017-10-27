<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';
require_once 'includes/header_padrao.php';

$redatores = usuarios::getAllEscritores($_SESSION['id_projeto']);
/*pre_r($redatores);
die();*/
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>PostSpot</title>
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
                            <h4 class="title"><i class="ti-ruler-pencil"></i> Vincular Redator</h4>
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
											<th class="disabled-sorting"></th>
											<th>Nome</th>
											<th>Habilidades</th>
											<th>Idiomas</th>
											<th class="disabled-sorting">Adicionar</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th></th>
											<th>Nome</th>
											<th>Habilidades</th>
											<th>Idiomas</th>
											<th>Adicionar</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($redatores as $redator) { 
											$habilidades_user = habilidades_usuario::getHabilidadesUsuario($redator->id_usuario);
											$idiomas_user = idiomas_usuario::getIdiomasUsuario($redator->id_usuario);
											$habilidades = ''; $idiomas = '';$tempHabilidades = ''; $tempIdiomas = '';
											foreach($habilidades_user as $habi){
												$tempHabilidades .= $habi->nome_habilidade . ', ';
											}	
											foreach($idiomas_user as $idioma){
												$tempIdiomas .= $idioma->nome_idioma . ', ';
											}						
											$habilidades=rtrim($tempHabilidades,", ");	
											$idiomas=rtrim($tempIdiomas,", ");						
											?>
											<tr>
												<td><?= $redator->id_usuario ?></td>
												<td><?= $redator->nome_usuario ?></td>
												<td><?= $habilidades ?></td>
												<td><?= $idiomas ?></td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon add-redator"><i class="ti-plus"></i></a>
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
					"sEmptyTable": "Nenhum registro encontrado",
					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
					"sInfoFiltered": "(Filtrados de _MAX_ registros)",
					"sInfoPostFix": "",
					"sInfoThousands": ".",
					"sLengthMenu": "_MENU_ resultados por página",
					"sLoadingRecords": "Carregando...",
					"sProcessing": "Processando...",
					"sZeroRecords": "Nenhum redator disponível",
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
	         table.on( 'click', '.add-redator', function () {
	            $tr = $(this).closest('tr');

	            var data = table.row($tr).data();
				
				var dados = {id_membro: data[0]}
				$.ajax({
					url: "../../controller/membros_equipe/inclui_membro_json.php",
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
								text: 'O redator foi adicionado.',
								type: 'success',
								confirmButtonClass: "btn btn-success btn-fill",
								buttonsStyling: false
								})
						}else{
							swal({
								title: 'Erro!',
								text: 'O redator não foi adicionado.',
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

	         // Delete a record
	         table.on( 'click', '.remove', function (e) {
	            $tr = $(this).closest('tr');
	            table.row($tr).remove().draw();
	            e.preventDefault();
	         } );

	        //Like record
	        table.on( 'click', '.like', function () {
	            alert('You clicked on Like button');
	         });

	    });
	</script>
</html>