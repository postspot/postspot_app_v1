<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" href="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-32x32.png" sizes="32x32" />
        <link rel="icon" href="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-180x180.png" />
        <meta name="msapplication-TileImage" content="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-270x270.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Login - PostSpot</title>

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
            <div class="full-page login-page">
                <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <img src="assets/img/logo-branco.png" alt="">
                                <form class="l" action="../../controller/usuario/recupera_senha.php" method="POST">
                                    <div class="card card-hidden" data-background="color" data-color="blue">
                                        <div class="card-content">
                                            <div class="form-group">
                                                <label>Informe o e-mail de cadastro</label>
                                                <input type="text" name="email_usuario" placeholder="Informe o e-mail" class="form-control input-no-border">
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-success btn-fill btn-wd fill-up fundo-roxo-padrao">Recuperar Senha</button>
                                            <div class="forgot" style="margin-top: 15px;">
                                                <a href="index.php">voltar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

<!--                <footer class="footer footer-transparent">
                    <div class="container">
                        <div class="copyright">
                            &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                        </div>
                    </div>
                </footer>-->
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
                                    <?php } ?>
                                });
    </script>

</html>
