<?php
$array_file = getcwd();

$detalhe_pagina = explode("/", $_SERVER['PHP_SELF']);

$detalhe_pagina = end($detalhe_pagina);

$array_gestao = array('time.php', 'projetos.php', 'habilidades.php', 'tipo_conteudo.php', 'idiomas.php', 'categorias.php');
?>
<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="logo">
        <a href="dashboard.php" class="simple-text logo-mini">
            <!-- <img src="assets/img/favicon-32x32.png"> -->
        </a>

        <a href="dashboard.php" class="simple-text logo-normal">
        <img src="assets/img/logo-branco.png">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <!--Menu Lateral User-->
        <div class="user">
            <div class="info">
                <div class="photo">
                    <img src="../../uploads/usuarios/<?= $_SESSION['foto_usuario'] ?>" />
                </div>

                <a href="perfil.php">
                    <span>
                        <?= $_SESSION['nome_usuario'] ?>
                    </span>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--Menu Lateral Paginas-->
        <ul class="nav">
            <li class="<?= $detalhe_pagina == "dashboard.php" ? "active" : "" ?>">
                <a href="dashboard.php">
                <i class="material-icons">dashboard</i>
                    <p>Dashboard
                    </p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "pautas.php" ? "active" : "" ?>">
                <a href="pautas.php">
                <i class="material-icons">list</i>
                    <p>Pautas</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "conteudos.php" ? "active" : "" ?>">
                <a href="conteudos.php">
                <i class="material-icons">description</i>
                    <p>Conteúdos</p>
                </a>
            </li>

            <li class="<?= $detalhe_pagina == "calendario.php" ? "active" : "" ?>">
                <a href="calendario.php">
                <i class="material-icons">event</i>
                    <p>Calendário</p>
                </a>
            </li> 

            <?php if ($_SESSION['funcao_usuario'] != '2' && $_SESSION['funcao_usuario'] != '4') : ?>
                <li class="<?= $detalhe_pagina == "documentos.php" ? "active" : "" ?>">
                    <a href="documentos.php">
                    <i class="material-icons">folder</i>
                        <p>Documentos</p>
                    </a>
                </li>
            <?php endif; ?>

            <li class="<?= $detalhe_pagina == "estrategia.php" ? "active" : "" ?>">
                <a href="estrategia.php">
                <i class="material-icons">store</i>
                    <p>Estratégia</p>
                </a>
            </li>
            <li class="<?= $detalhe_pagina == "personas.php" ? "active" : "" ?>">
                <a href="personas.php">
                <i class="material-icons md-18">person</i>
                    <p>Personas</p>
                </a>
            </li>

            <?php if ($_SESSION['funcao_usuario'] != '2') : ?>
                <li class="<?= $detalhe_pagina == "equipe.php" ? "active" : "" ?>">
                    <a href="equipe.php">
                    <i class="material-icons">group</i>
                        <p>Equipe</p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($_SESSION['funcao_usuario'] == '0') : ?>
                <li class="<?= in_array($detalhe_pagina, $array_gestao) ? "active" : "" ?>">
                    <a data-toggle="collapse" href="#gestao" <?= in_array($detalhe_pagina, $array_gestao) ? 'aria-expanded="true"' : '' ?>>
                    <i class="material-icons">settings</i>
                        <p>
                            Configurações
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?= in_array($detalhe_pagina, $array_gestao) ? 'in' : '' ?>" id="gestao" <?= in_array($detalhe_pagina, $array_gestao) ? 'aria-expanded="true"' : '' ?>>
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
                            <!-- <li class="<?= $detalhe_pagina == "categorias.php" ? "active" : "" ?>">
                                <a href="categorias.php">
                                    <span class="sidebar-mini">CT</span>
                                    <span class="sidebar-normal">Categorias</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li class="<?= in_array($detalhe_pagina, $array_gestao) ? "active" : "" ?>">
                    <a data-toggle="collapse" href="#relatorio" <?= in_array($detalhe_pagina, $array_gestao) ? 'aria-expanded="true"' : '' ?>>
                    <i class="material-icons">assessment</i>
                        <p>
                            Relatórios
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse <?= in_array($detalhe_pagina, $array_gestao) ? 'in' : '' ?>" id="relatorio" <?= in_array($detalhe_pagina, $array_gestao) ? 'aria-expanded="true"' : '' ?>>
                        <ul class="nav">
                            <li class="<?= $detalhe_pagina == "relatorio_conteudo.php" ? "active" : "" ?>">
                                <a href="relatorio_conteudo.php">
                                    <span class="sidebar-mini">PC</span>
                                    <span class="sidebar-normal">Produção de Conteúdo</span>
                                </a>
                            </li>
                            <li class="<?= $detalhe_pagina == "relatorio_avaliacao.php" ? "active" : "" ?>">
                                <a href="relatorio_avaliacao.php">
                                    <span class="sidebar-mini">AC</span>
                                    <span class="sidebar-normal">Avaliação de Conteúdo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>


















