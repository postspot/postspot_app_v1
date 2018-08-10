<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/teste_candidato.php';
require_once '../../model/habilidades.php';

$habilidades = habilidades::getAllSkills();
$usuario = usuarios::getPossiveisInscritos($_GET['u']);
$conteudo_teste = teste_candidato::getAll();
if (!isset($usuario)) {
    header('location: ' . SITE . 'view/freelancers/inscricao.php?erro=sessao');
}else if($usuario->status_candidato != 0){
    header('location: ' . SITE . 'view/freelancers/inscricao.php?retorno=cadInc');
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Redator</title>

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
                            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Cadastro de Frellancers</h1>

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
                                    <li class="nav-item">
                                        <a class="nav-link" href="#wizard-validation-step4" data-toggle="tab">Candidatura</a>
                                    </li>
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
	                            <form class="js-wizard-validation-form"  id="wizardForm" method="post" action="<?=SITE?>controller/candidatos/vincula_candidato.php" enctype="multipart/form-data">
                                    <input  type="hidden"
                                        name="id_usuario"
                                        value="<?=$usuario->id_usuario?>"
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
                                                        <input class="form-control" name="nome_usuario" readonly value="<?=$usuario->sobrenome_usuario?>" type="text">
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
                                                                   
															/>
		                                                </div>
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Estado
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="estado_candidato"
                                                                   
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
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Data de Nascimento
															</label>
		                                                    <input class="form-control mask-nascimento"
		                                                           type="tel"
		                                                           name="nascimento_usuario"
		                                                           placeholder="dd/mm/aaaa"
                                                                   
															/>
		                                                </div>
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Cidade
															</label>
		                                                    <input class="form-control"
		                                                           type="text"
		                                                           name="cidade_candidato"
                                                                   
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
                                                        <label class="control-label">Link da sua Certificação para Produção de Conteúdo para Web<star>*</star></label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="certificacao_candidato"
                                                                url="true"
                                                                    

                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Perfil no linkedIn</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="linkedin_candidato"
                                                                    

                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Link do portifólio</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="portifolio_candidato"
                                                                    

                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Experiência</label>
                                                        <select class="form-control" name="experiencia_candidato" >
                                                            <option selected disabled value="null">Escolha sua experiência</option>
                                                            <option value="Não tenho experiência com produção de textos">Não tenho experiência com produção de textos</option>
                                                            <option value="Já escrevi mas não para textos de web">Já escrevi mas não para textos de web</option>
                                                            <option value="Já trabalho como freelancer">Já trabalho como freelancer</option>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Tenho experiência em produzir:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-1" name="producao_candidato[]" value="Posts para blog">
                                                                    <label class="custom-control-label" for="checkbox-1">Posts para blog</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-2" name="producao_candidato[]" value="Press Releases">
                                                                    <label class="custom-control-label" for="checkbox-2">Press Releases</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-3" name="producao_candidato[]" value="Podcasts">
                                                                    <label class="custom-control-label" for="checkbox-3">Podcasts</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-4" name="producao_candidato[]" value="Posts para mídias sociais">
                                                                    <label class="custom-control-label" for="checkbox-4">Posts para mídias sociais</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-5" name="producao_candidato[]" value="Roteiros para vídeo">
                                                                    <label class="custom-control-label" for="checkbox-5">Roteiros para vídeo</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-6" name="producao_candidato[]" value="Traduções">
                                                                    <label class="custom-control-label" for="checkbox-6">Traduções</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-7" name="producao_candidato[]" value="Ebooks">
                                                                    <label class="custom-control-label" for="checkbox-7">Ebooks</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-8" name="producao_candidato[]" value="Tutoriais">
                                                                    <label class="custom-control-label" for="checkbox-8">Tutoriais</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-9" name="producao_candidato[]" value="Outros">
                                                                    <label class="custom-control-label" for="checkbox-9">Outros</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Formação</label>
                                                        <select class="form-control" name="formacao_candidato" >
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
                                                        <select class="form-control" name="area_estudo_candidato" >
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
                                                                    

                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Profissão</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="profissao_candidato"
                                                                placeholder=""
                                                                    

                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nivel de Inglês</label>
                                                        <select name="ingles_candidato" class="form-control">
                                                            <option value="Básico" >Básico</option>
                                                            <option value="Intermediário">Intermediário</option>
                                                            <option value="Avançado">Avançado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Nível de Espanhol
                                                        </label>
                                                        <select name="espanhol_candidato" class="form-control">
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
                                                                
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Agência
                                                        </label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="agencia_usuario"
                                                                   
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

                                        <!-- Step 4 -->
                                        <div class="tab-pane" id="wizard-validation-step4" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Selecione a modalidade desejada
                                                        </label>
                                                        <select name="modalidade_candidatos" class="form-control" id="selectTipoCandidatura" >
                                                            <?php foreach ($conteudo_teste as $key => $conteudo): ?>
                                                                <option <?=($key == 0) ? 'selected' : ''?> value="<?=$conteudo->id_teste_candidato?>" ><?=$conteudo->nome_teste_candidato?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Por que você se considera bom(a) para participar dessa modalidade?
                                                        </label>
                                                        <textarea class="form-control" name="motivo_candidatos" id="" cols="30" rows="10" ></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Selecione até 5(cinco) especialidade(s) em que você deseja criar a candidatura:</label>
                                                        </div>
                                                        <?php foreach ($habilidades as $key => $habilidade): ?>
                                                        <div class="col-md-3 col-xs-12">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input check-especialidades" id="checkbox-especialidade-<?=$key?>" name="especialidade_candidatos[]" value="<?=$habilidade->nome_habilidade?>">
                                                                    <label class="custom-control-label" for="checkbox-especialidade-<?=$key?>"><?=$habilidade->nome_habilidade?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach;?>
                                                    </div>
                                                </div>
                                                <?php foreach ($conteudo_teste as $key => $conteudo): ?>
                                                    <div class="col-md-12 ctrl-candidatura <?=($key == 0) ? 'mostra-candidatura' : ''?>" id="identificador<?=$conteudo->id_teste_candidato?>">
                                                        <div id="accordion2" role="tablist" aria-multiselectable="true">
                                                            <div class="block block-rounded mb-1">
                                                                <div class="block-header block-header-default" role="tab" id="accordion1_h<?=$key?>">
                                                                    <a class="font-w600" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_q<?=$key?>" aria-expanded="true" aria-controls="accordion1_q<?=$key?>">Especificações</a>
                                                                </div>
                                                                <div id="accordion1_q<?=$key?>" class="collapse show" role="tabpanel" aria-labelledby="accordion1_h<?=$key?>">
                                                                    <div class="block-content">
                                                                        <?=$conteudo->especificacoes_teste_candidato?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="block block-rounded mb-1">
                                                                <div class="block-header block-header-default" role="tab" id="accordion2_h<?=$key?>">
                                                                    <a class="font-w600" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_q<?=$key?>" aria-expanded="true" aria-controls="accordion2_q<?=$key?>">Pauta</a>
                                                                </div>
                                                                <div id="accordion2_q<?=$key?>" class="collapse" role="tabpanel" aria-labelledby="accordion2_h<?=$key?>">
                                                                    <div class="block-content">
                                                                        <?=$conteudo->pauta_teste_candidato?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Desenvolva o conteúdo de acordo com a pauta e as especificações
                                                        </label>
                                                        <textarea id="editor" name="texto_candidatos" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Step 4 -->
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

            $.validator.addMethod('check-especialidades', function(value) {
                var iuncheck = $('.check-especialidades');
                var icheck = $('.check-especialidades:checked');
                console.log(iuncheck);  
                console.log(icheck);  
                var tam =  $('.check-especialidades:checked').length;   
                return tam > 0;
            }, 'Selecione pelo menos uma das opções.');

            $(document).ready(function(){
                var checkboxes = $('.check-especialidades');
                var checkbox_names = $.map(checkboxes, function(e, i) {
                    return $(e).attr("name")
                }).join(" ");

                $("#wizardForm").validate({
                    groups: {
                        checks: checkbox_names
                    },
                    rules: {
                        resp01: 'required',
                    },
                    messages: {
                        resp01:  { required: 'Selecione uma resposta!' },
                    }
                });

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
