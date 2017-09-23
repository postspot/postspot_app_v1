<?php
$array_file = getcwd();

$detalhe_pagina = explode("/", $_SERVER['PHP_SELF']);

$detalhe_pagina = end($detalhe_pagina);
?>
<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="logo">
        <a href="dashboard.php" class="simple-text logo-mini">
            <img src="assets/img/cropped-postspot-agencia-de-marketing-de-conteúdo-favicon-32x32.png">
        </a>

        <a href="dashboard.php" class="simple-text logo-normal">
            <img src="assets/img/logo-postspo.png">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <!--Menu Lateral User-->
        <div class="user">
            <div class="info">
                <div class="photo">
                    <img src="assets/img/faces/face-2.jpg" />
                </div>

                <a href="perfil.php">
                    <span>
                        Andress Bento
                    </span>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--Menu Lateral Paginas-->
        <ul class="nav">
            <li class="<?= $detalhe_pagina == "dashboard.php" ? "active" : "" ?>">
                <a href="dashboard.php">
                    <i class="ti-home"></i>
                    <p>Dashboard
                    </p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "pautas.php" ? "active" : "" ?>">
                <a href="pautas.php">
                    <i class="ti-light-bulb"></i>
                    <p>Pautas</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "conteudos.php" ? "active" : "" ?>">
                <a href="conteudos.php">
                    <i class="ti-bookmark"></i>
                    <p>Conteúdos</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "calendario.php" ? "active" : "" ?>">
                <a href="calendario.php">
                    <i class="ti-calendar"></i>
                    <p>Calendário</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "documentos.php" ? "active" : "" ?>">
                <a href="documentos.php">
                    <i class="ti-files"></i>
                    <p>Documentos</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "estrategia.php" ? "active" : "" ?>">
                <a href="estrategia.php">
                    <i class="ti-direction-alt"></i>
                    <p>Estratégia</p>
                </a>
            </li>
            <li class="<?= $detalhe_pagina == "personas.php" ? "active" : "" ?>">
                <a href="personas.php">
                    <i class="ti-user"></i>
                    <p>Personas</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "equipe.php" ? "active" : "" ?>">
                <a href="equipe.php">
                    <i class="ti-world"></i>
                    <p>Equipe</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#gestao">
                    <i class="ti-panel"></i>
                    <p>
                        Gestão
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="gestao">
                    <ul class="nav">
                        <li class="<?= $detalhe_pagina == "time.php" ? "active" : "" ?>">
                            <a href="time.php">
                                <span class="sidebar-mini">PF</span>
                                <span class="sidebar-normal">Profissionais</span>
                            </a>
                        </li>
                        <li class="<?= $detalhe_pagina == "projetos.php" ? "active" : "" ?>">
                            <a href="projetos.php">
                                <span class="sidebar-mini">PJ</span>
                                <span class="sidebar-normal">Projetos</span>
                            </a>
                        </li>
                        <li class="<?= $detalhe_pagina == "habilidades.php" ? "active" : "" ?>">
                            <a href="habilidades.php">
                                <span class="sidebar-mini">HB</span>
                                <span class="sidebar-normal">Habilidades</span>
                            </a>
                        </li>
                        <li class="<?= $detalhe_pagina == "tipo_conteudo.php" ? "active" : "" ?>">
                            <a href="tipo_conteudo.php">
                                <span class="sidebar-mini">TC</span>
                                <span class="sidebar-normal">Tipo Conteúdo</span>
                            </a>
                        </li>
                        <li class="<?= $detalhe_pagina == "idiomas.php" ? "active" : "" ?>">
                            <a href="idiomas.php">
                                <span class="sidebar-mini">ID</span>
                                <span class="sidebar-normal">Idiomas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>


















