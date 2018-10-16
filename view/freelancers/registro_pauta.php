<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/teste_candidato.php';
require_once '../../model/habilidades.php';
require_once '../../model/conteudo_teste_candidato.php';

$habilidades = habilidades::getAllSkills();
$usuario = usuarios::getPossiveisInscritos($_GET['u']);
$conteudo_teste = conteudo_teste_candidato::getAllByCategoria($usuario->modalidade_candidatos);

$opcoes_producao_candidato = explode(', ', $usuario->producao_candidato);

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

        <title>Inscrição Analista de Planejamento</title>

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
                            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Cadastro de Analista de Planejamento</h1>
                            <button id="salvarRascunho">Salvar</button>
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
                                    <input  type="hidden"
                                        name="modalidade_candidatos"
                                        value="1"
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
                                                            <img id="previewFotoUsuario" src="<?=($usuario->foto_usuario) ? SITE . 'uploads/usuarios/' . $usuario->foto_usuario : SITE . 'view/adm/assets/img/faces/1-avatar-postspot.png'?>" alt="">
                                                        </div>
                                                        <input
                                                            type="file"
                                                            name="foto_usuario"
                                                            id="inputFotoUsuario"
                                                            value="<?=$usuario->foto_usuario?>"
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
                                                                value="<?=$usuario->rede_social_candidato?>"
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
                                                                    value="<?=$usuario->razao_social_candidato?>"
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
                                                                value="<?=$usuario->telefone_usuario?>"
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
                                                                value="<?=$usuario->estado_candidato?>"
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
                                                                value="<?=$usuario->cnpj_candidato?>"
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
                                                                value="<?=dataBr($usuario->nascimento_usuario)?>"
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
                                                                value="<?=$usuario->cidade_candidato?>"
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
                                                        <label class="control-label">Certificação de inbound marketing da hubspot</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="certificacao_candidato"
                                                                url="true"
                                                                required="true"
                                                                value="<?=$usuario->certificacao_candidato?>"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Perfil no linkedIn</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="linkedin_candidato"
                                                                required="true"
                                                                value="<?=$usuario->linkedin_candidato?>"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Link do portifólio</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="portifolio_candidato"
                                                                required="true"
                                                                value="<?=$usuario->portifolio_candidato?>"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Experiência</label>
                                                        <select class="form-control" name="experiencia_candidato" required="true">
                                                            <option disabled value="null" <?=("" == $usuario->experiencia_candidato) ? 'selected' : ''?>>Escolha sua experiência</option>
                                                            <option value="Não tenho experiência com produção de textos"  <?=("Não tenho experiência com produção de textos" == $usuario->experiencia_candidato) ? 'selected' : ''?>>Não tenho experiência com produção de textos</option>
                                                            <option value="Já escrevi mas não para textos de web" <?=("Já escrevi mas não para textos de web" == $usuario->experiencia_candidato) ? 'selected' : ''?>>Já escrevi mas não para textos de web</option>
                                                            <option value="Já trabalho como freelancer" <?=("Já trabalho como freelancer" == $usuario->experiencia_candidato) ? 'selected' : ''?>>Já trabalho como freelancer</option>
                                                        </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Tenho experiência em produzir:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-1" name="producao_candidato[]" value="Posts para blog" <?=(in_array("Posts para blog", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-1">Posts para blog</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-2" name="producao_candidato[]" value="Press Releases" <?=(in_array("Press Releases", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-2">Press Releases</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-3" name="producao_candidato[]" value="Podcasts" <?=(in_array("Podcasts", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-3">Podcasts</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-4" name="producao_candidato[]" value="Posts para mídias sociais" <?=(in_array("Posts para mídias sociais", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-4">Posts para mídias sociais</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-5" name="producao_candidato[]" value="Roteiros para vídeo" <?=(in_array("Roteiros para vídeo", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-5">Roteiros para vídeo</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-6" name="producao_candidato[]" value="Traduções" <?=(in_array("Traduções", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-6">Traduções</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-7" name="producao_candidato[]" value="Ebooks" <?=(in_array("Ebooks", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-7">Ebooks</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-8" name="producao_candidato[]" value="Tutoriais" <?=(in_array("Tutoriais", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-8">Tutoriais</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                                                    <input type="checkbox" class="custom-control-input" id="checkbox-9" name="producao_candidato[]" value="Outros" <?=(in_array("Outros", $opcoes_producao_candidato)) ? 'checked' : ''?>>
                                                                    <label class="custom-control-label" for="checkbox-9">Outros</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Formação</label>
                                                        <select class="form-control" name="formacao_candidato" required="true">
                                                            <option selected disabled value="null" <?=("" == $usuario->formacao_candidato) ? 'selected' : ''?>>Escolha sua formação</option>
                                                            <option value="Ensino médio completo" <?=("Ensino médio completo" == $usuario->formacao_candidato) ? 'selected' : ''?>>Ensino médio completo</option>
                                                            <option value="Ensino superior incompleto" <?=("Ensino superior incompleto" == $usuario->formacao_candidato) ? 'selected' : ''?>>Ensino superior incompleto</option>
                                                            <option value="Ensino superior completo" <?=("Ensino superior completo" == $usuario->formacao_candidato) ? 'selected' : ''?>>Ensino superior completo</option>
                                                            <option value="Pós graduação" <?=("Pós graduação" == $usuario->formacao_candidato) ? 'selected' : ''?>>Pós graduação</option>
                                                            <option value="Mestrado" <?=("Mestrado" == $usuario->formacao_candidato) ? 'selected' : ''?>>Mestrado</option>
                                                            <option value="Doutorado" <?=("Doutorado" == $usuario->formacao_candidato) ? 'selected' : ''?>>Doutorado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Área de Estudo</label>
                                                        <select class="form-control" name="area_estudo_candidato" required="true">
                                                            <option disabled value="null"  <?=("" == $usuario->area_estudo_candidato) ? 'selected' : ''?>>Escolha sua área de estudo</option>
                                                            <option value="Humanas" <?=("Humanas" == $usuario->area_estudo_candidato) ? 'selected' : ''?>>Humanas</option>
                                                            <option value="Exatas" <?=("Exatas" == $usuario->area_estudo_candidato) ? 'selected' : ''?>>Exatas</option>
                                                            <option value="Biológicas" <?=("Biológicas" == $usuario->area_estudo_candidato) ? 'selected' : ''?>>Biológicas</option>
                                                            <option value="Gerenciais" <?=("Gerenciais" == $usuario->area_estudo_candidato) ? 'selected' : ''?>>Gerenciais</option>
                                                            <option value="Outros" <?=("Outros" == $usuario->area_estudo_candidato) ? 'selected' : ''?>>Outros</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Curso</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="curso_candidato"
                                                                placeholder=""
                                                                required="true"
                                                                value="<?=$usuario->curso_candidato?>"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Profissão</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="profissao_candidato"
                                                                placeholder=""
                                                                required="true"
                                                                value="<?=$usuario->profissao_candidato?>"
                                                        />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Nivel de Inglês</label>
                                                        <select name="ingles_candidato" class="form-control">
                                                            <option value="Básico"  <?=("Básico" == $usuario->ingles_candidato) ? 'selected' : ''?>>Básico</option>
                                                            <option value="Intermediário" <?=("Intermediário" == $usuario->ingles_candidato) ? 'selected' : ''?>>Intermediário</option>
                                                            <option value="Avançado" <?=("Avançado" == $usuario->ingles_candidato) ? 'selected' : ''?>>Avançado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Nível de Espanhol
                                                        </label>
                                                        <select name="espanhol_candidato" class="form-control">
                                                            <option value="Básico"  <?=("Básico" == $usuario->espanhol_candidato) ? 'selected' : ''?>>Básico</option>
                                                            <option value="Intermediário" <?=("Intermediário" == $usuario->espanhol_candidato) ? 'selected' : ''?>>Intermediário</option>
                                                            <option value="Avançado" <?=("Avançado" == $usuario->espanhol_candidato) ? 'selected' : ''?>>Avançado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Outro idioma</label>
                                                        <input class="form-control"
                                                                type="text"
                                                                name="outro_idioma_candidato"
                                                                placeholder=""
                                                                value="<?=$usuario->outro_idioma_candidato?>"
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
                                                            <option value="Pessoa Física"  <?=("Pessoa Física" == $usuario->modalidade_conta_usuario) ? 'selected' : ''?> >Pessoa Física</option>
                                                            <option value="Pessoa Jurídica" <?=("Pessoa Jurídica" == $usuario->modalidade_conta_usuario) ? 'selected' : ''?>>Pessoa Jurídica</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" id="inputDocUsu">
                                                        <?=("Pessoa Física" == $usuario->modalidade_conta_usuario) ? 'CPF' : 'CNPJ'?>
                                                        </label>
                                                        <input  class="form-control mask-cnpj-cpf"
                                                                type="text"
                                                                name="doc_usuario"
                                                                required="true"
                                                                value="<?=$usuario->doc_usuario?>"
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
                                                                value="<?=$usuario->agencia_usuario?>"
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
                                                                value="<?=$usuario->conta_usuario?>"
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
                                                                value="<?=$usuario->digito_verificador_usuario?>"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Nome do Banco
                                                        </label>
                                                        <select class="js-select2 form-control"  id="example-select2" name="banco_usuario" style="width: 100%" >
                                                            <option disabled value="null"  <?=("" == $usuario->banco_usuario) ? 'selected' : ''?> >Selecione o Banco</option>
                                                            <option value="5" <?=("5" == $usuario->banco_usuario) ? 'selected' : ''?>>5 - BANCO ALFA S/A</option>
                                                            <option value="8" <?=("8" == $usuario->banco_usuario) ? 'selected' : ''?>>8 - BANCO BBM S.A</option>
                                                            <option value="13" <?=("13" == $usuario->banco_usuario) ? 'selected' : ''?>>13 - BANCO BONSUCESSO S.A</option>
                                                            <option value="15" <?=("15" == $usuario->banco_usuario) ? 'selected' : ''?>>15 - BANCO BRADESCO S.A</option>
                                                            <option value="22" <?=("22" == $usuario->banco_usuario) ? 'selected' : ''?>>22 - BANCO CITIBANK S.A.</option>
                                                            <option value="23" <?=("23" == $usuario->banco_usuario) ? 'selected' : ''?>>23 - BANCO COOPERATIVO DO BRASIL S.A.</option>
                                                            <option value="24" <?=("24" == $usuario->banco_usuario) ? 'selected' : ''?>>24 - BANCO COOPERATIVO SICREDI S.A</option>
                                                            <option value="32" <?=("32" == $usuario->banco_usuario) ? 'selected' : ''?>>32 - BANCO DO BRASIL SA</option>
                                                            <option value="34" <?=("34" == $usuario->banco_usuario) ? 'selected' : ''?>>34 - BANCO DO ESTADO DE SERGIPE SA</option>
                                                            <option value="35" <?=("35" == $usuario->banco_usuario) ? 'selected' : ''?>>35 - BANCO DO ESTADO DO ESPIRITO SANTO SA</option>
                                                            <option value="36" <?=("36" == $usuario->banco_usuario) ? 'selected' : ''?>>36 - BANCO DO ESTADO DO PARA SA</option>
                                                            <option value="37" <?=("37" == $usuario->banco_usuario) ? 'selected' : ''?>>37 - BANCO DO ESTADO DO RIO GRANDE DO SUL SA</option>
                                                            <option value="38" <?=("38" == $usuario->banco_usuario) ? 'selected' : ''?>>38 - BANCO DO NORDESTE DO BRASIL SA</option>
                                                            <option value="48" <?=("48" == $usuario->banco_usuario) ? 'selected' : ''?>>48 - BANCO INTERMEDIUM S.A.</option>
                                                            <option value="49" <?=("49" == $usuario->banco_usuario) ? 'selected' : ''?>>49 - BANCO ITAU BBA S.A.</option>
                                                            <option value="50" <?=("50" == $usuario->banco_usuario) ? 'selected' : ''?>>50 - BANCO ITAU UNIBANCO S/A</option>
                                                            <option value="60" <?=("60" == $usuario->banco_usuario) ? 'selected' : ''?>>60 - BANCO MERCANTIL DO BRASIL SA</option>
                                                            <option value="120" <?=("120" == $usuario->banco_usuario) ? 'selected' : ''?>>120 - BANCO NEON</option>
                                                            <option value="122" <?=("122" == $usuario->banco_usuario) ? 'selected' : ''?>>122 - BANCO ORIGINAL SA</option>
                                                            <option value="78" <?=("78" == $usuario->banco_usuario) ? 'selected' : ''?>>78 - BANCO SANTANDER BANESPA S.A.</option>
                                                            <option value="99" <?=("99" == $usuario->banco_usuario) ? 'selected' : ''?>>99 - CAIXA ECONOMICA FEDERAL SA</option>
                                                            <option value="112" <?=("112" == $usuario->banco_usuario) ? 'selected' : ''?>>112 - GERADOR</option>
                                                            <option value="121" <?=("121" == $usuario->banco_usuario) ? 'selected' : ''?>>121 - NU PAGAMENTOS S.A</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            Tipo da Conta
                                                        </label>
                                                        <select name="tipo_conta_usuario" class="form-control">
                                                            <option value="Conta Corrente" <?=("Conta Corrente" == $usuario->tipo_conta_usuario) ? 'selected' : ''?>>Conta Corrente</option>
                                                            <option value="Conta Poupança" <?=("Conta Poupança" == $usuario->tipo_conta_usuario) ? 'selected' : ''?>>Conta Poupança</option>
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
                                                        Por que você se considera bom(a) para trabalhar nessa área?
                                                        </label>
                                                        <textarea class="form-control" name="motivo_candidatos" id="" cols="30" rows="10" ><?=$usuario->motivo_candidatos?></textarea>
                                                    </div>
                                                </div>
                                                <?php foreach ($conteudo_teste as $key => $conteudo): ?>
                                                    <div class="col-md-12 ctrl-candidatura mostra-candidatura" id="identificador0">
                                                        <div id="accordion2" role="tablist" aria-multiselectable="true">
                                                            <div class="block block-rounded mb-1">
                                                                <div class="block-header block-header-default" role="tab" id="accordion1_h0">
                                                                    <a class="font-w600" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_q0" aria-expanded="true" aria-controls="accordion1_q0">Especificações</a>
                                                                </div>
                                                                <div id="accordion1_q0" class="collapse show" role="tabpanel" aria-labelledby="accordion1_h0">
                                                                    <div class="block-content">
                                                                        <?=$conteudo->especificacoes_conteudo_teste_candidato?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="block block-rounded mb-1">
                                                                <div class="block-header block-header-default" role="tab" id="accordion2_h1">
                                                                    <a class="font-w600" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_q1" aria-expanded="true" aria-controls="accordion2_q1">Pauta</a>
                                                                </div>
                                                                <div id="accordion2_q1" class="collapse" role="tabpanel" aria-labelledby="accordion2_h1">
                                                                    <div class="block-content">
                                                                        <?=$conteudo->pauta_conteudo_teste_candidato?>
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
                                                        <textarea id="editor" name="texto_candidatos" ><?=$usuario->texto_candidatos?></textarea>
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

$("#salvarRascunho").click(function (e) {
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
    var $form = jQuery('#wizardForm'),
    data = $form.serialize();

    $.ajax({
        type: "POST",
        url: "../../controller/candidatos/salva_candidato.php",
        data: data,
        dataType: "json",
        success: function(data) {
            if(data == 'true'){
                alert('Dados salvos com sucesso!')
            }
        },
        error: function() {
            alert('error handling here');
        }
    });
});

$(document).on('change', '#inputFotoUsuario', function(){
    var name = document.getElementById("inputFotoUsuario").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
        alert("Tipo de arquivo inválido!");
    }else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("inputFotoUsuario").files[0]);
        var f = document.getElementById("inputFotoUsuario").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000){
            alert("A foto enviada é muito grande!");
        }else{
            form_data.append("foto_usuario", document.getElementById('inputFotoUsuario').files[0]);
            form_data.append("iuser", <?=$usuario->id_usuario?>);
            $.ajax({
                url: "../../controller/candidatos/salva_foto.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success:function(data)
                {
                    if(data != 'true'){
                        alert('Erro ao atualizar foto');
                    }
                }
            });
        }
    }
    });
});

        </script>
    </body>
</html>
