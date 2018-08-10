<?php
require_once '../../config/config.php';
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

        <title>Freelancers - PostSpot</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!--  Paper Dashboard core CSS    -->
        <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>
        <link href="assets/css/custom.css" rel="stylesheet"/>


        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
    </head>

    <body>

        <div class="wrapper wrapper-full-page">
            <div class="register-page login-page" data-color="" data-image="assets/img/background/background-5.jpg">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header-text">
                                    <h2>Obrigado!</h2>
                                    <h4>Recebemos o seu cadastro de teste. Em até <b>10 dias úteis</b> entraremos em contato para lhe dar um feedback. Enquanto isso, que tal aprender mais sobre produção de conteúdo? Acesse nosso <a href="https://postspot.com.br/blog-para-freelancers/">blog de freelas</a></h4>
                                    <hr>
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

    <script type="text/javascript">
                                $().ready(function () {

                                    $page = $('.full-page');
                                    image_src = $page.data('image');

                                    if (image_src !== undefined) {
                                        image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
                                        $page.append(image_container);
                                    }

                                    setTimeout(function () {
                                        // after 1000 ms we add the class animated to the login/register card
                                        $('.card').removeClass('card-hidden');
                                    }, 7000)

                                    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'sessao1') { ?>
                                        $(document).ready(function() {
                                            funcoes.showNotification(0,4,'<b>Sessão expirada</b> - faça login novamente.');
                                        });
                                    <?php }else if (isset($_GET['erro']) && $_GET['erro'] == 'sessao2') { ?>
                                        $(document).ready(function() {
                                            funcoes.showNotification(0,4,'<b>Sessão expirada</b> - faça login novamente.');
                                        });
                                    <?php }else if (isset($_GET['erro']) && $_GET['erro'] == 'sessao3') { ?>
                                        $(document).ready(function() {
                                            funcoes.showNotification(0,4,'<b>Dados Incorretos</b> - tente novamente.');
                                        });
                                    <?php }else if (isset($_GET['erro']) && $_GET['erro'] == 'sessao4') { ?>
                                        $(document).ready(function() {
                                            funcoes.showNotification(0,4,'<b>Projeto Inexistente</b> - fale com o administrador.');
                                        });
                                    <?php }else if (isset($_GET['erro']) && $_GET['erro'] == 'rsOk') { ?>
                                        $(document).ready(function() {
                                            funcoes.showNotification(0,1,'Verifique seu email para obter o acesso');
                                        });
                                    <?php }else if (isset($_GET['erro']) && $_GET['erro'] == 'rsErro') { ?>
                                        $(document).ready(function() {
                                            funcoes.showNotification(0,4,'Não foi possível validar o e-mail. Tente novamente');
                                        });
                                    <?php } ?>
                                });
    </script>

</html>
