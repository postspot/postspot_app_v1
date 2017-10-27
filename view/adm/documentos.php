<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/anexos.php';
require_once 'includes/header_padrao.php';

$anexos = anexos::getAllByProjeto($_SESSION['id_projeto']);
/*pre_r($anexos);
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
                        <h4 class="title"><i class="ti-files"></i> Documentos</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <table id="datatables" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="disabled-sorting"></th>
                                                    <th>Nome Documento</th>
                                                    <th>Referência</th>
                                                    <th>Responsável</th>
                                                    <th class="disabled-sorting"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($anexos as $anexo): ?>
                                                    <tr>
                                                        <td><?= $anexo->id_anexo ?></td>
                                                        <td><?= $anexo->nome_anexo ?></td>
                                                        <td><strong><?= mesEscrito($anexo->data_criacao) ?> de <?= date("Y", strtotime($anexo->data_criacao)) ?></strong><br>Criado <?= date("d/m/Y", strtotime($anexo->data_criacao)) ?> às <?= date("H:i", strtotime($anexo->data_criacao)) ?></td>
                                                        <td><?= $anexo->nome_usuario ?></td>
                                                        <td class="td-actions">
                                                            <a href="#" rel="tooltip" title="Abrir" class="btn btn-info btn-simple btn-xs abrir-doc">
                                                                <i class="ti-eye"></i>
                                                            </a>
                                                            <a href="#" rel="tooltip" title="Deletar" class="btn btn-danger btn-simple btn-xs del-doc">
                                                                <i class="ti-close"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!--  end card  -->
                            </div> <!-- end col-md-12 -->
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-icon btn-fixed" onclick="funcoes.showSwal('anexo')">
                    <i class="ti-plus"></i>
                </a>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
    <script type="text/javascript">
	    $(document).ready(function() {
        
            <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
                    funcoes.showNotification(0,1,'<b>Sucesso</b> - documento(s) enviado(s) corretamente.');
            <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
                   funcoes.showNotification(0,4,'<b>Erro</b> - documento(s) não enviado(s).');
            <?php } ?>

	        $('#datatables').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
				language: {
					"sEmptyTable": "Nenhum documentos encontrado",
					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ documentos",
					"sInfoEmpty": "Mostrando 0 até 0 de 0 documentos",
					"sInfoFiltered": "(Filtrados de _MAX_ documentos)",
					"sInfoPostFix": "",
					"sInfoThousands": ".",
					"sLengthMenu": "_MENU_ documentos por página",
					"sLoadingRecords": "Carregando...",
					"sProcessing": "Processando...",
					"sZeroRecords": "Nenhum documento disponível",
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
	         table.on( 'click', '.abrir-doc', function () {
	            $tr = $(this).closest('tr');

	            var data = table.row($tr).data();
				
                var urlFile = "http://localhost/postspot/uploads/projetos/<?=$_SESSION['id_projeto']?>-arquivos/" + data[1];
                var win = window.open(urlFile, '_blank');
                win.focus();
	         } );

	         table.on( 'click', '.del-doc', function () {
	            $tr = $(this).closest('tr');

	            var data = table.row($tr).data();
                
                
				var dados = {id_anexo: data[0], nome_anexo: data[1]}
				$.ajax({
					url: "../../controller/anexos/remove_anexo.php",
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
								text: 'O anexo foi removido.',
								type: 'success',
								confirmButtonClass: "btn btn-success btn-fill",
								buttonsStyling: false
								})
						}else{
							swal({
								title: 'Erro!',
								text: 'O anexo não foi removido.',
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
	         } );

	    });
	</script>
</html>