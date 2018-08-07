<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/teste_candidato.php';
require_once '../../model/habilidades.php';

$habilidades = habilidades::getAllSkills();
$usuario = usuarios::getById($_GET['u']);
$conteudo_teste = teste_candidato::getAll();
if(!isset($usuario)){
	header('location: '. SITE .'view/adm/registro.php?erro=sessao');
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-32x32.png" sizes="32x32" />
        <link rel="icon" href="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-180x180.png" />
        <meta name="msapplication-TileImage" content="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-270x270.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Registro - PostSpot</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!--  Paper Dashboard core CSS    -->
        <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


        <link href="assets/css/registro.css" rel="stylesheet" />


        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <script src="ckeditor/ckeditor.js"></script>
        <script src="ckeditor/sample.js"></script>
    </head>

    <body>

        <div class="wrapper wrapper-full-page">
            <div class="register-page full-page login-page" data-image="assets/img/background/background-5.jpg">
            <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-8 col-md-offset-2">
	                        <div class="card card-wizard" id="wizardCard">
	                            <form id="wizardForm" method="post" action="<?=SITE?>controller/candidatos/vincula_candidato.php" enctype="multipart/form-data">
									<input  type="hidden"
											name="id_usuario"
											value="<?=$usuario->id_usuario?>"
									/>
									<div class="card-header text-center">
		                                <h4 class="card-title">Complete seu Cadastro</h4>
		                                <p class="category">Finalize o cadastro para poder fazer parte da nossa equipe</p>
		                            </div>
	            					<div class="card-content">
		            				    <ul class="nav">
		            						<li><a href="#tab1" data-toggle="tab">Dados Pessoais</a></li>
		            						<li><a href="#tab2" data-toggle="tab">Dados Profissionais</a></li>
		            						<li><a href="#tab3" data-toggle="tab">Dados Bancários</a></li>
		            						<li><a href="#tab4" data-toggle="tab">Candidatura</a></li>
		            					</ul>
		            					<div class="tab-content">
		            					    <div class="tab-pane" id="tab1">
		                                        <h5 class="text-center">Preencha abaixo com seus dados pessoais. Estes dados são de uso interno da PostSpot</h5>
		                                        <div class="row">
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Foto
															</label>
															<div class="foto_usuario">
																<img id="previewFotoUsuario" src="<?= SITE ?>view/adm/assets/img/faces/1-avatar-postspot.png" alt="">
															</div>
															<input
																type="file"
																name="foto_usuario"
																id="inputFotoUsuario"
																value="1-avatar-postspot.png"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label class="control-label">
																		Nome
																	</label>
																	<input class="form-control"
																		type="text"
																		required="true"
																		name="nome_usuario"
																		readonly
																		value="<?=$usuario->nome_usuario?>"
																	/>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label class="control-label">
																		E-mail<star>*</star>
																	</label>
																	<input class="form-control"
																		type="text"
																		email="true"
																		name="email_usuario"
																		readonly
																		value="<?=$usuario->email_usuario?>"
																	/>
																</div>
															</div>
														</div>
		                                            </div>
		                                        </div>
		                                        <div class="row">
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Razão Social
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="razao_social_candidato"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																CNPJ
															</label>
		                                                    <input class="form-control mask-cnpj"
		                                                           type="tel"
		                                                           name="cnpj_candidato"
															/>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="row">
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Telefone
															</label>
		                                                    <input class="form-control mask-telefone"
		                                                           type="tel"
		                                                           name="telefone_usuario"
		                                                           required="true"
		                                                           placeholder="ex: (XX) X XXXX - XXXX"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Data de Nascimento
															</label>
		                                                    <input class="form-control mask-nascimento"
		                                                           type="tel"
		                                                           name="nascimento_usuario"
		                                                           required="true"
		                                                           placeholder="dd/mm/aaaa"
															/>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="row">
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Estado
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="estado_candidato"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Cidade
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="cidade_candidato"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                        </div>
		            					    </div>
		            					    <div class="tab-pane" id="tab2">
		                                        <h5 class="text-center">Preencha os dados profissionais. Queremos saber mais sobre as suas experiências e conhecimentos!</h5>
		                                        <div class="row">
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Link da sua Certificação para Produção de Conteúdo para Web<star>*</star></label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="certificacao_candidato"
		                                                           url="true"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Perfil no linkedIn</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="linkedin_candidato"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Link de referência para o portifólio</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="portifolio_candidato"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Experiência</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="experiencia_candidato"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Tenho experiência em produzir:</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="producao_candidato"
		                                                           placeholder=""
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Formação</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="formacao_candidato"
		                                                           placeholder=""
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Área de Estudo</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="area_estudo_candidato"
		                                                           placeholder=""
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Curso</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="curso_candidato"
		                                                           placeholder=""
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Profissão</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="profissao_candidato"
		                                                           placeholder=""
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">Nivel de Inglês</label>
		                                                    <select name="ingles_candidato" class="form-control">
		                                                        <option selected="" value="Básico" >Básico</option>
		                                                        <option value="Intermediário">Intermediário</option>
		                                                        <option value="Avançado">Avançado</option>
		                                                    </select>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Nível de Espanhol
															</label>
		                                                    <select name="espanhol_candidato" class="form-control">
		                                                        <option selected="" value="Básico" >Básico</option>
		                                                        <option value="Intermediário">Intermediário</option>
		                                                        <option value="Avançado">Avançado</option>
		                                                    </select>
		                                                </div>
		                                            </div>
		                                        </div>
		            					    </div>
		            						<div class="tab-pane" id="tab3">
		                                        <h5 class="text-center">Preencha seus dados bancários! Com eles podemos efetuar seus pagamentos referente ao seus trabalhos de freelancer</h5>
		                                        <div class="row">
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Modalidade
															</label>
		                                                    <select name="modalidade_conta_usuario" class="form-control">
		                                                        <option selected="" value="Pessoa Física" >Pessoa Física</option>
		                                                        <option value="Pessoa Jurídica">Pessoa Jurídica</option>
		                                                    </select>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																CPF ou CNPJ
															</label>
		                                                    <input class="form-control mask-cpf-cnpj"
		                                                           type="text"
		                                                           name="doc_usuario"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Agência
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="agencia_usuario"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Número de conta e dígito verificador
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="conta_usuario"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Nome do Banco
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="banco_usuario"
		                                                           required="true"
															/>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-6">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Tipo da Conta
															</label>
		                                                    <select name="tipo_conta_usuario" class="form-control">
		                                                        <option selected="" value="Conta Corrente" >Conta Corrente</option>
		                                                        <option value="Conta Poupança">Conta Poupança</option>
		                                                    </select>
		                                                </div>
		                                            </div>
		                                        </div>
		            					    </div>
		            						<div class="tab-pane" id="tab4">
		                                        <h5 class="text-center">Agora escolha a especialidade na qual você deseja a sua primeira candidatura e preencha de acordo com as especificações e a pauta! Aqui vamos avaliar a sua experiência e conhecimento de produção de conteúdo para web. Para conhecer
 													Mais sobre o assunto acesse nosso blog</h5>
		                                        <div class="row">
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Selecione a modalidade desejada
															</label>
		                                                    <select name="modalidade_candidatos" class="form-control" id="selectTipoCandidatura">
																<?php foreach ($conteudo_teste  as $key => $conteudo) : ?>
		                                                        	<option <?= ($key == 0) ? 'selected=""' : ''?> value="<?=$conteudo->id_teste_candidato?>" ><?=$conteudo->nome_teste_candidato?></option>
																<?php endforeach;?>
															</select>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Selecione a especialidade em que você deseja criar a candidatura
															</label>
		                                                    <select name="especialidade_candidatos" class="form-control">
                                            					<?php foreach ($habilidades as $key => $habilidade) : ?>
																	<option <?= ($key == 0) ? 'selected=""' : ''?>  value="<?= $habilidade->nome_habilidade ?>" ><?= $habilidade->nome_habilidade ?></option>
																<?php endforeach;?>
		                                                    </select>
		                                                </div>
		                                            </div>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Por que você se considera bom(a) para participar dessa modalidade?
															</label>
		                                                    <textarea class="form-control" name="motivo_candidatos" id="" cols="30" rows="10"></textarea>
		                                                </div>
		                                            </div>
													<?php foreach ($conteudo_teste  as $key => $conteudo) : ?>
														<div class="col-md-12 ctrl-candidatura <?= ($key == 0) ? 'mostra-candidatura' : ''?>" id="identificador<?=$conteudo->id_teste_candidato?>">
															<div class="panel-group">
																<div class="panel panel-border panel-default">
																	<a data-toggle="collapse" href="#collapseEspedificacoes<?=$key?>" aria-expanded="true">
																		<div class="panel-heading">
																			<h4 class="panel-title">
																				Especificações
																				<i class="ti-angle-down"></i>
																			</h4>
																		</div>
																	</>
																	<div id="collapseEspedificacoes<?=$key?>" class="panel-collapse collapse in">
																		<div class="panel-body">
																			<?=$conteudo->especificacoes_teste_candidato?>
																		</div>
																	</div>
																</div>
																<div class="panel panel-border panel-default">
																	<a data-toggle="collapse" href="#collapsePauta<?=$key?>" aria-expanded="true">
																		<div class="panel-heading">
																			<h4 class="panel-title">
																				Pauta
																				<i class="ti-angle-down"></i>
																			</h4>
																		</div>
																	</a>
																	<div id="collapsePauta<?=$key?>" class="panel-collapse collapse in">
																		<div class="panel-body">
																			<?=$conteudo->pauta_teste_candidato?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?php endforeach;?>
		                                            <div class="col-md-12">
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Desenvolva o conteúdo de acordo com a pauta e as especificações
															</label>
		                                                    <textarea id="editor" name="texto_candidatos"></textarea>
		                                                </div>
		                                            </div>
		                                        </div>
		            					    </div>
		            					</div>
	            					</div>
		            				<div class="card-footer">
		                                <button type="button" class="btn btn-default btn-fill btn-wd btn-back pull-left">Voltar</button>
		                                <button type="button" class="btn btn-info btn-fill btn-wd btn-next pull-right">Próximo</button>
		                                <button type="button" class="btn btn-info btn-fill btn-wd btn-finish pull-right" onclick="onFinishWizard()">Finalizar</button>
		                                <div class="clearfix"></div>
		            				</div>
	                        	</form>
	                    	</div>
	                	</div>
	            	</div>
	        	</div>
	    	</div>
            </div>
        </div>
    </body>

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Forms Validations Plugin -->
    <script src="assets/js/jquery.validate.min.js"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="assets/js/es6-promise-auto.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="assets/js/sweetalert2.js"></script>

    <!-- Wizard Plugin    -->	
    <script src="assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

    <script src="assets/js/custom.js"></script>
    <script src="assets/js/mask.js"></script>
    <script src="assets/js/mascaras.js"></script>
    <script src="assets/js/registro.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
			funcoes.initWizard();
			iniciaCkeditor();
		});
	</script>

</html>
