<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/habilidades_usuario.php';
require_once 'includes/header_adm.php';
$users = usuarios::getAll();
// pre_r($users);
// die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Membros - PostSpot</title>
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
                    <div class="container-fluid relative">
                        <a href="cria_usuario.php" class="btn btn-fixed fundo-rosa">
                            <i class="material-icons">add</i> Novo membro
                        </a>
                    <h4 class="title cor-roxo-escuro"><i class="material-icons md-48">settings</i> Gestão - Usuários</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Usuários</h4>
                                    </div>
                                    <div class="card-content">
                                    
	                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="disabled-sorting"></th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Função</th>
                                                <th>Habilidade</th>
                                                <th class="disabled-sorting"></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Nome</th>
                                                <th>E-mail</th>
                                                <th>Função</th>
                                                <th>Habilidade</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($users as $user) {
                                                if ($user->funcao_usuario == 2) :
                                                    $habilidades_user = habilidades_usuario::getHabilidadesUsuario($user->id_usuario);
                                                $habilidades = '';
                                                $tempHabilidades = '';
                                                foreach ($habilidades_user as $habi) {
                                                    $tempHabilidades .= $habi->nome_habilidade . ', ';
                                                }
                                                $habilidades = rtrim($tempHabilidades, ", ");
                                                else :
                                                    $habilidades = '';
                                                endif;
                                                ?>
                                                <tr>
                                                    <td><?= $user->id_usuario ?></td>
                                                    <td><?= $user->nome_usuario ?></td>
                                                    <td><?= $user->email_usuario ?></td>
                                                    <td><?= funcaoCliente($user->funcao_usuario) ?></td>
                                                    <td><?= $habilidades ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-icon fundo-rosa-claro del-usuario"><i class="ti-trash"></i></a>
                                                        <a href="edita_usuario.php?u=<?= $user->id_usuario ?>" class="btn btn-sm btn-icon fundo-roxo-padrao"><i class="ti-search"></i></a>
                                                    </td>
                                                </tr>
                                            <?php 
                                        } ?>
                                        </tbody>
									</table>
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
	         table.on( 'click', '.del-usuario', function () {
	            $tr = $(this).closest('tr');
	            var data = table.row($tr).data();
                swal({
                    title: 'Deseja deletar este usuário?',
                    text: "Depois de confirmar esse usuário não poderá ser recuperado!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonClass: 'btn btn-success btn-fill',
                    confirmButtonText: 'Sim, deletar!',
                    buttonsStyling: false
                }).then(function() {

				
				var dados = {id_usuario: data[0]}
				$.ajax({
					url: "../../controller/usuario/deleta_usuario.php",
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
								text: 'O usuário foi deletado.',
								type: 'success',
								confirmButtonClass: "btn btn-success btn-fill",
								buttonsStyling: false
								})
						}else{
							swal({
								title: 'Erro!',
								text: 'O usuário não foi deletado.',
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
                });
	         } );
        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
                funcoes.showNotification(0,1,'Usuário criado corretamente.');
        <?php 
    } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'eok') { ?>
                funcoes.showNotification(0,1,'Usuário editado.');
        <?php 
    } else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
                funcoes.showNotification(0,4,'Usuário não criado.');
        <?php 
    } ?>

	    });
    </script>
</html>