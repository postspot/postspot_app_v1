<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/teste_candidato.php';
require_once '../../model/habilidades.php';
require_once 'includes/header.php';

$habilidades = habilidades::getAllSkills();
$usuario = usuarios::getPossiveisInscritos($_GET['u']);
$conteudo_teste = teste_candidato::getAll();

if (!isset($usuario)) {
    header('location: ' . SITE . 'view/freelancers/inscricao.php?erro=sessao');
} else if ($usuario->status_candidato != 0) {
    header('location: ' . SITE . 'view/freelancers/inscricao.php?retorno=cadInc');
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Inscrição Designer</title>

        <meta name="description" content="Agência PostSpot, criando marketing de conteúdo com coração">
        <meta name="author" content="App PostSpot">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Agência PostSpot, criando marketing de conteúdo com coração">
        <meta property="og:site_name" content="App PostSpot">
        <meta property="og:description" content="Agência PostSpot, criando marketing de conteúdo com coração">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Plugins -->
        <link rel="stylesheet" href="../assets/js/plugins/select2/css/select2.min.css">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->

        <link rel="icon" href="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-32x32.png" sizes=32x32 />
        <link rel="icon" href="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-192x192.png" sizes=192x192 />
        <link rel="apple-touch-icon-precomposed" href="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-180x180.png"/>
        <meta name="msapplication-TileImage" content="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-270x270.png"/>
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and Dashmix framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="../assets/css/dashmix.min.css">
        <link rel="stylesheet" id="css-main" href="../assets/css/custom/registra_redator.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="../assets/css/themes/xwork.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-dual">
                                <span class="d-none d-sm-inline-block">Salvar Rascunho</span>
                                <i class="fa fa-fw fa-save ml-1 d-none d-sm-inline-block"></i>
                            </button>
                    </div>
                    <!-- END Left Section -->

                </div>
                <!-- END Header Content -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">

                <!-- Hero -->
                <div class="bg-body-light">
                    <div class="content content-full">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Cadastro de Designer</h1>

                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Validation Wizard -->
                            <div class="js-wizard-validation block block block-rounded block-bordered">
                                <!-- Wizard Progress Bar -->
                                <div class="progress rounded-0" data-wizard="progress" style="height: 8px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <!-- END Wizard Progress Bar -->
                                <!-- Step Tabs -->
                                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#wizard-validation-step1" data-toggle="tab">Dados Pessoais</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step2" data-toggle="tab">Dados Profissionais</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step3" data-toggle="tab">Dados Bancários</a>
                                    </li>
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
	                            <form class="js-wizard-validation-form"  id="wizardForm" method="post" action="<?=SITE?>controller/candidatos/vincula_candidato.php" enctype="multipart/form-data">
                                    <input  type="hidden"
                                        name="id_usuario"
                                        value="<?=$usuario->id_usuario?>"
									/>
                                    <input  type="hidden"
                                        name="modalidade_candidatos"
                                        value="4"
									/>
                                    <!-- Steps Content -->
                                    <div class="block-content block-content-full tab-content">
                                        <!-- Step 1 -->
                                        <div class="tab-pane active" id="wizard-validation-step1" role="tabpanel">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Foto
                                                        </label>
                                                        <div class="foto_usuario">
                                                            <img id="previewFotoUsuario" src="<?=SITE?>view/adm/assets/img/faces/1-avatar-postspot.png" alt="">
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
                                                    <div class="form-group">
                                                        <label for="wizard-validation-firstname">Primeiro nome</label>
                                                        <input class="form-control" name="nome_usuario" readonly value="<?=$usuario->nome_usuario?>" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wizard-validation-lastname">Sobrenome</label>
                                                        <input class="form-control" name="sobrenome_usuario" readonly value="<?=$usuario->sobrenome_usuario?>" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="wizard-validation-email">Email *</label>
                                                        <input class="form-control" type="email" readonly name="email_usuario" value="<?=$usuario->email_usuario?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Skype ou Hangout
                                                        </label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="rede_social_candidato"
                                                                required="true"
                                                        />
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
                                                                    required="true"
															/>
		                                                </div>
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Telefone
															</label>
		                                                    <input class="form-control mask-telefone"
		                                                           type="tel"
		                                                           name="telefone_usuario"
		                                                           placeholder="ex: (XX) X XXXX - XXXX"
                                                                required="true"
															/>
		                                                </div>
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
																CNPJ
															</label>
		                                                    <input class="form-control mask-cnpj"
		                                                           type="tel"
		                                                           name="cnpj_candidato"
                                                                required="true"
															/>
		                                                </div>
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Data de Nascimento
															</label>
		                                                    <input class="form-control mask-nascimento"
		                                                           type="tel"
		                                                           name="nascimento_usuario"
		                                                           placeholder="dd/mm/aaaa"
                                                                required="true"
															/>
		                                                </div>
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
                                        <!-- END Step 1 -->

                                        <!-- Step 2 -->
                                        <div class="tab-pane" id="wizard-validation-step2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Perfil no linkedIn</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="linkedin_candidato"
                                                                required="true"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Link do portifólio</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="portifolio_candidato"
                                                                required="true"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Formação</label>
                                                        <select class="form-control" name="formacao_candidato" required="true">
                                                            <option selected disabled value="null">Escolha sua formação</option>
                                                            <option value="Ensino médio completo">Ensino médio completo</option>
                                                            <option value="Ensino superior incompleto">Ensino superior incompleto</option>
                                                            <option value="Ensino superior completo">Ensino superior completo</option>
                                                            <option value="Pós graduação">Pós graduação</option>
                                                            <option value="Mestrado">Mestrado</option>
                                                            <option value="Doutorado">Doutorado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Área de Estudo</label>
                                                        <select class="form-control" name="area_estudo_candidato" required="true">
                                                            <option selected disabled value="null">Escolha sua área de estudo</option>
                                                            <option value="Humanas">Humanas</option>
                                                            <option value="Exatas">Exatas</option>
                                                            <option value="Biológicas">Biológicas</option>
                                                            <option value="Gerenciais">Gerenciais</option>
                                                            <option value="Outros">Outros</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Curso</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="curso_candidato"
                                                                placeholder=""
                                                                required="true"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Profissão</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="profissao_candidato"
                                                                placeholder=""
                                                                required="true"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nivel de Inglês</label>
                                                        <select name="ingles_candidato" class="form-control" required="true">
                                                            <option value="Básico" >Básico</option>
                                                            <option value="Intermediário">Intermediário</option>
                                                            <option value="Avançado">Avançado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Nível de Espanhol
                                                        </label>
                                                        <select name="espanhol_candidato" class="form-control" required="true">
                                                            <option value="Básico" >Básico</option>
                                                            <option value="Intermediário">Intermediário</option>
                                                            <option value="Avançado">Avançado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Outro idioma</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="outro_idioma_candidato"
                                                                placeholder=""
                                                        />
                                                    </div>
                                                </div>
		                                    </div>
                                        </div>
                                        <!-- END Step 2 -->

                                        <!-- Step 3 -->
                                        <div class="tab-pane" id="wizard-validation-step3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Modalidade
                                                        </label>
                                                        <select id="selectModalidade" name="modalidade_conta_usuario" class="form-control">
                                                            <option selected value="Pessoa Física" >Pessoa Física</option>
                                                            <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" id="inputDocUsu">
                                                            CPF
                                                        </label>
                                                        <input  class="form-control mask-cnpj-cpf"
                                                                type="text"
                                                                name="doc_usuario"
                                                                required="true"
                                                        />
                                                    </div>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    Número de conta
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
                                                                    Dígito verificador
                                                                </label>
                                                                <input class="form-control"
                                                                        type="text"
                                                                        name="digito_verificador_usuario"
                                                                required="true"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Nome do Banco
                                                        </label>
                                                        <select class="js-select2 form-control"  id="example-select2" name="banco_usuario" style="width: 100%" >
                                                            <option selected disabled value="null" >Selecione o Banco</option>
                                                            <option value="5">5 - BANCO ALFA S/A</option>
                                                            <option value="8">8 - BANCO BBM S.A</option>
                                                            <option value="13">13 - BANCO BONSUCESSO S.A</option>
                                                            <option value="15">15 - BANCO BRADESCO S.A</option>
                                                            <option value="22">22 - BANCO CITIBANK S.A.</option>
                                                            <option value="23">23 - BANCO COOPERATIVO DO BRASIL S.A.</option>
                                                            <option value="24">24 - BANCO COOPERATIVO SICREDI S.A</option>
                                                            <option value="32">32 - BANCO DO BRASIL SA</option>
                                                            <option value="34">34 - BANCO DO ESTADO DE SERGIPE SA</option>
                                                            <option value="35">35 - BANCO DO ESTADO DO ESPIRITO SANTO SA</option>
                                                            <option value="36">36 - BANCO DO ESTADO DO PARA SA</option>
                                                            <option value="37">37 - BANCO DO ESTADO DO RIO GRANDE DO SUL SA</option>
                                                            <option value="38">38 - BANCO DO NORDESTE DO BRASIL SA</option>
                                                            <option value="48">48 - BANCO INTERMEDIUM S.A.</option>
                                                            <option value="49">49 - BANCO ITAU BBA S.A.</option>
                                                            <option value="50">50 - BANCO ITAU UNIBANCO S/A</option>
                                                            <option value="60">60 - BANCO MERCANTIL DO BRASIL SA</option>
                                                            <option value="120">120 - BANCO NEON</option>
                                                            <option value="122">122 - BANCO ORIGINAL SA</option>
                                                            <option value="78">78 - BANCO SANTANDER BANESPA S.A.</option>
                                                            <option value="99">99 - CAIXA ECONOMICA FEDERAL SA</option>
                                                            <option value="112">112 - GERADOR</option>
                                                            <option value="121">121 - NU PAGAMENTOS S.A</option>
                                                        </select>
                                                    </div>
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
                                        <!-- END Step 3 -->

                                    </div>
                                    <!-- END Steps Content -->

                                    <!-- Steps Navigation -->
                                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                                    <i class="fa fa-angle-left mr-1"></i> Voltar
                                                </button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                                    Próximo <i class="fa fa-angle-right ml-1"></i>
                                                </button>
                                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                                    <i class="fa fa-check mr-1"></i> Enviar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Steps Navigation -->
                                </form>
                                <!-- END Form -->
                            </div>
                            <!-- END Validation Wizard Classic -->
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-0">
                    <div class="row font-size-sm">
                        <div class="col-sm-12 text-center text-sm-right">
                            Time PostSpot &copy; <span data-toggle="year-copy">2018</span>
                        </div>
                    </div>


                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!--
            Dashmix JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out ../assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the ../assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            ../assets/js/core/jquery.min.js
            ../assets/js/core/bootstrap.bundle.min.js
            ../assets/js/core/simplebar.min.js
            ../assets/js/core/jquery-scrollLock.min.js
            ../assets/js/core/jquery.appear.min.js
            ../assets/js/core/js.cookie.min.js
        -->
        <script src="../assets/js/dashmix.core.min.js"></script>

        <!--
            Dashmix JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at ../assets/_es6/main/app.js
        -->
        <script src="../assets/js/dashmix.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js"></script>
        <script src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../assets/js/plugins/jquery-validation/additional-methods.js"></script>
        <script src="../assets/js/plugins/ckeditor/ckeditor.js"></script>
        <script src="../assets/js/plugins/ckeditor/sample.js"></script>
        <script src="../assets/js/plugins/select2/js/select2.full.min.js"></script>
        <script src="../assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/be_forms_wizard.min.js"></script>


        <!-- Custom -->
        <script src="../assets/js/mask.js"></script>
        <script src="../assets/js/mascaras.js"></script>
        <script src="../assets/js/registro.js"></script>

        <!-- Page JS Helpers (Summernote + SimpleMDE + CKEditor plugins) -->
        <script>
            jQuery(function(){ Dashmix.helpers(['select2']); iniciaCkeditor();} );

            $(document).ready(function(){

                $('#selectModalidade').change(function (e) {
                    e.preventDefault();
                    if(this.value == 'Pessoa Física'){
                        $('#inputDocUsu').text('CPF');
                        isCPF = true;
                    }else{
                        $('#inputDocUsu').text('CNPJ');
                        isCPF = false;
                    }
                });

                var isCPF = true;

                $(".mask-cnpj-cpf").keydown(function(){
                    try {
                        $(".mask-cnpj-cpf").unmask();
                    } catch (e) {}

                    var tamanho = $(".mask-cnpj-cpf").val().length;

                    if(isCPF){
                        $(".mask-cnpj-cpf").mask("999.999.999-99");
                    } else if(tamanho >= 11){
                        $(".mask-cnpj-cpf").mask("99.999.999/9999-99");
                    }

                    // ajustando foco
                    var elem = this;
                    setTimeout(function(){
                        // mudo a posição do seletor
                        elem.selectionStart = elem.selectionEnd = 10000;
                    }, 0);
                    // reaplico o valor para mudar o foco
                    var currentValue = $(this).val();
                    $(this).val('');
                    $(this).val(currentValue);
                });
            });

        </script>
    </body>
</html>