<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once 'includes/header_padrao.php';
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Calendário - PostSpot</title>
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
                        <h4 class="title"><i class="ti-calendar"></i> Calendário</h4>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="card card-calendar">
                                    <div class="card-content">
                                        <div id="fullCalendar"></div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            funcoes.initFullCalendar();
        });
    </script>

</html>