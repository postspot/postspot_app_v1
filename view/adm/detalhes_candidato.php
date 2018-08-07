<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/candidatos.php';
require_once '../../model/usuarios.php';
require_once 'includes/header_padrao.php';

if(isset($_GET["u"])){
    $usuario = candidatos::getById($_GET["u"]);
}

//pre_r($usuario);
//die();
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Detalhes Candidato - PostSpot</title>
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
                        <form action="../../controller/candidato/edita_candidato.php" enctype="multipart/form-data" method="POST">
                            <input type="hidden" value="<?= $usuario->id_candidato ?>" name="id_candidato">
                            <h4 class="title"><i class="ti-user"></i>Detalhes Candidato</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Informações pessoais
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->nome_usuario ?>" name="nome_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->email_usuario ?>" name="email_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Razão Social</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->razao_social_candidato ?>" name="razao_social_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>CNPJ</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->cnpj_candidato ?>" name="cnpj_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Telefone</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->telefone_usuario ?>" name="telefone_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Data de Nascimento</label>
                                                        <input type="text" class="form-control border-input" value="<?= dataBr($usuario->nascimento_usuario) ?>" name="nascimento_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->estado_candidato ?>" name="estado_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->cidade_candidato ?>" name="cidade_candidato">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-md-12 -->
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Informações Bancárias
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Modalidade</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->modalidade_conta_usuario ?>" name="modalidade_conta_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>CPF ou CNPJ</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->doc_usuario ?>" name="doc_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Agência</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->agencia_usuario ?>" name="agencia_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Número de conta</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->conta_usuario ?>" name="conta_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nome do Banco</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->banco_usuario ?>" name="banco_usuario">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tipo da Conta</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->tipo_conta_usuario ?>" name="tipo_conta_usuario">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-md-12 -->
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Informações Profissionais
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Link da Certificação para Produção de Conteúdo para Web</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->certificacao_candidato ?>" name="certificacao_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Perfil no linkedIn</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->linkedin_candidato ?>" name="linkedin_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Link de referência para o portifólio</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->portifolio_candidato ?>" name="portifolio_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Experiência</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->experiencia_candidato ?>" name="experiencia_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tenho experiência em produzir</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->producao_candidato ?>" name="producao_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Formação</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->formacao_candidato ?>" name="formacao_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Área de Estudo</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->area_estudo_candidato ?>" name="area_estudo_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Curso</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->curso_candidato ?>" name="curso_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Profissão</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->profissao_candidato ?>" name="profissao_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nivel de Inglês</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->ingles_candidato ?>" name="ingles_candidato">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nível de Espanhol</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->espanhol_candidato ?>" name="espanhol_candidato">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-md-12 -->
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Informações da Candidatura
                                            </h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Modalidade desejada</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->modalidade_candidatos ?>" name="modalidade_candidatos">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Especialidade</label>
                                                        <input type="text" class="form-control border-input" value="<?= $usuario->especialidade_candidatos ?>" name="especialidade_candidatos">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Motivo para inscrição</label>
                                                        <textarea name="especialidade_candidatos" class="form-control border-input" cols="30" rows="10"><?= $usuario->especialidade_candidatos ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Conteúdo do Teste</label>
                                                        <textarea name="texto_candidatos" class="form-control border-input" cols="30" rows="10"><?= $usuario->texto_candidatos   ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">                                          
                                                    <button type="submit" class="btn btn-fill btn-info">Aprovar</button>                                               
                                                    <button type="submit" class="btn btn-fill btn-info pull-right">Recusar</button>                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-md-12 -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>
</html>