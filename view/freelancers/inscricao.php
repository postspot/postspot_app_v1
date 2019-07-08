<?php
require_once '../../config/config.php';
require_once '../../model/teste_candidato.php';
$conteudo_teste = teste_candidato::getAll();
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Registro - PostSpot</title>

        <meta name=description content="A PostSpot oferece produção de conteúdo para educar seu público, ganhar autoridade no seu mercado e gerar novas oportunidades de negócios."/>
        <meta name="author" content="MazeApps">

        <!-- Open Graph Meta -->
        <meta property=og:locale content=pt_BR />
        <meta property=og:type content=website />
        <meta property=og:title content="Produção de Conteúdo para Marketing Digital"/>
        <meta property=og:description content="A PostSpot oferece produção de conteúdo para educar seu público, ganhar autoridade no seu mercado e gerar novas oportunidades de negócios."/>
        <meta property=og:url content="https://postspot.com.br/"/>
        <meta property=og:site_name content=PostSpot />

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel=icon href="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-32x32.png" sizes=32x32 />
        <link rel=icon href="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-192x192.png" sizes=192x192 />
        <link rel=apple-touch-icon-precomposed href="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-180x180.png"/>
        <meta name=msapplication-TileImage content="https://postspot.com.br/wp-content/uploads/2018/08/cropped-postspot-270x270.png"/>
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and Dashmix framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="../assets/css/dashmix.min.css">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="../assets/css/themes/xwork.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('../assets/media/photos/photo12@2x.jpg');">
                    <div class="row no-gutters justify-content-center bg-black-75">
                        <!-- Main Section -->
                        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                            <div class="p-3 w-100">
                                <!-- Header -->
                                <div class="mb-3 text-center">

                                    <?php require_once '../includes/erro.php'?>
                                    
                                    <img src="../assets/img/postspot-logo-novo.png" alt="" style="width: 270px;">
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">Seja um Freelancer</p>
                                </div>
                                <!-- END Header -->
                                
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-sm-8 col-xl-6">
                                        <form id="formInscricao" class="js-validation-signup" method="post" action="<?= SITE ?>controller/candidatos/cria_candidato.php" autocomplete="off">
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg form-control-alt" name="nome_usuario" placeholder="Primeiro nome">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg form-control-alt" name="sobrenome_usuario" placeholder="Segundo nome">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control form-control-lg form-control-alt" name="email_usuario" placeholder="Seu E-mail">
                                                </div>
                                                <div class="form-group">
                                                    <select name="modalidade_candidatos" id="" class="form-control form-control-lg form-control-alt">
                                                        <option value="0" selected disabled>Modalidade Desejada</option>
                                                        <?php foreach ($conteudo_teste as $key => $conteudo): ?>
                                                            <option value="<?=$conteudo->id_teste_candidato?>" ><?=$conteudo->nome_teste_candidato?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-lg form-control-alt" name="senha_usuario" placeholder="Digite uma senha">
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox custom-control-primary">
                                                        <input type="checkbox" class="custom-control-input" id="signup-terms" name="signup-terms">
                                                        <label class="custom-control-label" for="signup-terms">Concordo com o Termos &amp; Condições</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-success">
                                                    <i class="fa fa-fw fa-plus mr-1"></i> Inscrever
                                                </button>
                                                <p class="mt-3 mb-0 text-center">
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="#" data-toggle="modal" data-target="#modal-terms">
                                                        <i class="fa fa-book text-muted mr-1"></i> Ler o Termos e Condições
                                                    </a>
                                                </p>
                                                <p class="mt-3 mb-0 text-center">
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="<?=SITE?>/view/adm/index.php">
                                                         Ja fiz inscrição <i class="si si-login"></i>
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Sign Up Form -->
                            </div>
                        </div>
                        <!-- END Main Section -->
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Terms Modal -->
        <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Termos &amp; Condições</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <?php require_once '../includes/termos.php'; ?>
                        </div>
                        <div class="block-content block-content-full text-right bg-light">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Lido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Terms Modal -->

        <script src="../assets/js/dashmix.core.min.js"></script>

        <script src="../assets/js/dashmix.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="../assets/js/pages/op_auth_signup.min.js"></script>

        <script src="../assets/js/custom/login.js"></script>
    </body>
</html>