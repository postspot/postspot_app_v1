<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/tarefas.php';
require_once '../../model/tipo_tarefa.php';
require_once 'includes/header_padrao.php';
/*pre_r($projeto);
die();*/

$filtroStatus = '0';
$filtroTipo = '0';
if (isset($_GET["t"]) || isset($_GET["s"])) {
    $filtroTipo = (($_GET["t"] != '0') ? ' AND t.id_tipo = ' . $_GET["t"] : '');
    $filtroStatus = $_GET["s"];

    switch ($filtroStatus) {
        case '0':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, $filtroTipo);
            break;
        case '1':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = ' . CONTEUDO_ESCREVENDO . ' OR l.etapa = ' . CONTEUDO_AJUSTANDO . ')' . $filtroTipo);
            break;
        case '2':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = ' . PAUTA_APROVACAO_CLIENTE . ' OR l.etapa = ' . PAUTA_REAPROVACAO_CLIENTE . ')' . $filtroTipo);
            break;
        case '3':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . PAUTA_AJUSTANDO . $filtroTipo);
            break;
        case '4':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = ' . CONTEUDO_APROVACAO_MODERADOR . ' OR l.etapa = ' . CONTEUDO_REAPROVACAO_MODERADOR . ')' . $filtroTipo);
            break;
        case '5':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . PAUTA_ESCREVENDO . $filtroTipo);
            break;
        case '6':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = ' . PAUTA_APROVACAO_MODERADOR . ' OR l.etapa = ' . PAUTA_REAPROVACAO_MODERADOR . ')' . $filtroTipo);
            break;
        case '7':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND (l.etapa = ' . CONTEUDO_APROVACAO_CLIENTE . ' OR l.etapa = ' . CONTEUDO_REAPROVACAO_CLIENTE . ')' . $filtroTipo);
            break;
        case '8':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . CONTEUDO_AJUSTANDO . $filtroTipo);
            break;
        case '9':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . CONTEUDO_PARA_PUBLICAR . $filtroTipo);
            break;
        case '10':
            $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . CONTEUDO_PUBLICADO . $filtroTipo);
            break;
    }
    $textoTitulo = 'Materiais encontrados';
    $param = true;
} else if (isset($_GET["a"])) {
    $tarefas = tarefas::tarefasProjetoAtrasadas($_SESSION['id_projeto']);
    $textoTitulo = 'Conteúdos atrasados';
    $param = true;
    // pre_r($tarefas);
    // die();
} else {
    $tarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 10, 'AND l.etapa = ' . CONTEUDO_PARA_PUBLICAR);
    $textoTitulo = 'Conteúdos para Publicar';
    $param = false;
}
$totasTarefas = tarefas::getPautasDez($_SESSION['id_projeto'], 1000, 'AND l.etapa >= 0');
$tiposTarefa = tipo_tarefa::getAllTiposTaredas();

// pre_r($tarefas);
// die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Dashboard - PostSpot</title>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Tarefas</h4>
                                        <p class="category">Histórico de Tarefas</p>
                                    </div>
                                    <div class="card-content">
                                        <div class="table-full-width table-tasks">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="" data-toggle="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                        <td class="td-actions text-right">
                                                            <div class="table-icons">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                                            </label>
                                                        </td>
                                                        <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                        <td class="td-actions text-right">
                                                            <div class="table-icons">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                                            </label>
                                                        </td>
                                                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit</td>
                                                        <td class="td-actions text-right">
                                                            <div class="table-icons">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="" data-toggle="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                                        <td class="td-actions text-right">
                                                            <div class="table-icons">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="" data-toggle="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>Read "Following makes Medium better"</td>
                                                        <td class="td-actions text-right">
                                                            <div class="icons-table">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkbox">
                                                                <input type="checkbox" value="" data-toggle="checkbox">
                                                            </label>
                                                        </td>
                                                        <td>Unfollow 5 enemies from twitter</td>
                                                        <td class="td-actions text-right">
                                                            <div class="table-icons">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                                    <i class="ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-history"></i> Atualizar
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
							<div class="card card-chat">
								<div class="card-header">
									<h4 class="card-title">Chat</h4>
									<p class="category">With Tania Andrew</p>
								</div>
								<div class="card-content">
									<ol class="chat">
										<li class="other">
											<div class="avatar">
  											  <img src="../../assets/img/faces/face-2.jpg" alt="crash">
  										  </div>
									        <div class="msg">
										        <p>
												    Hola!
										            How are you?
											    </p>
												<div class="card-footer">
													<i class="ti-check"></i>
													<h6>11:20</h6>
												</div>
										  </div>
									    </li>
										<li class="self">
									        <div class="msg">
										        <p>
													Puff...
										        	I'm alright. How are you?
												</p>
												<div class="card-footer">
													<i class="ti-check"></i>
													<h6>11:22</h6>
												</div>
									        </div>
											<div class="avatar">
												<img src="../../assets/img/default-avatar.png" alt="crash">
											</div>
									    </li>
										<li class="other">
											<div class="avatar">
												<img src="../../assets/img/faces/face-2.jpg" alt="crash">
											</div>
									        <div class="msg">
									        	<p>
													I'm ok too!
												</p>
												<div class="card-footer">
													<i class="ti-check"></i>
													<h6>11:24</h6>
												</div>
										    </div>
									    </li>
										<li class="self">
									        <div class="msg">
									        	<p>
													Well, it was nice hearing from you.
												</p>
												<div class="card-footer">
													<i class="ti-check"></i>
													<h6>11:25</h6>
												</div>
									        </div>
											<div class="no-avatar"></div>
									    </li>
										<li class="self">
									        <div class="msg">
									        	<p>
													OK, bye-bye
									        		See you!
												</p>
												<div class="card-footer">
													<i class="ti-check"></i>
													<h6>11:25</h6>
												</div>
									        </div>
											<div class="avatar">
												<img src="../../assets/img/default-avatar.png" alt="crash">
											</div>
									    </li>
									</ol>
									<hr>
									<div class="send-message">
										<div class="avatar">
											<img src="../../assets/img/default-avatar.png" alt="crash">
										</div>
										<input class="form-control textarea" type="text" placeholder="Type here!">
										<div class="send-button">
											<button class="btn btn-primary btn-fill">Send</button>
										</div>
									</div>
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
        var siteBase = '<?= SITE ?>';
        $(".select-customizado").select2();

        $("#btnBuscarFiltro").click(function (e) { 
            var tipo = $("#filtroTipoTarefa").val();
            var status = $("#filtroStatusTarefa").val();
            window.location.href = siteBase + 'view/adm/dashboard.php?t='+tipo+'&s=' + status;
        });

        
        $('.select-customizado').on("change", function(e) {
            window.location.href = siteBase + 'view/adm/'+$(this).val();
        });
    });
    </script>
    
</html>