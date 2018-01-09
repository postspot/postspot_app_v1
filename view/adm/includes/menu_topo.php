<?php
require_once '../../model/log_tarefas.php';
$notificacoes = log_tarefas::getNotificacoes($_SESSION['id_projeto']);
// pre_r($notificacoes);
// die();
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
        </div> -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="#icons"><?= $_SESSION['nome_projeto'] ?></a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                        <i class="ti-bell"></i>
                        <span class="notification"><?= count($notificacoes) ?></span>
                        <p class="hidden-md hidden-lg">
                            Notificações
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul class="dropdown-menu">
                    <?php 
                        if (empty($notificacoes)) : ?>
                            <li><a href="#">Nenhuma notificação</a></li>
                    <?php else: foreach ($notificacoes as $notificacao) : ?>
                            <li><a href="<?= ($notificacao->etapa > 4) ? 'detalhes_conteudo' : 'detalhes_pauta' ?>.php?t=<?= $notificacao->id_tarefa ?>"><strong><?= retornaStatusTarefa($notificacao->etapa) ?></strong> -  <?= $notificacao->nome_tarefa ?></a></li>
                    <?php endforeach; endif; ?>
                    </ul>
                </li>
                <li class="menu-engrenagem">
                    <a href="#settings" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                        <i class="ti-settings"></i>
                        <p class="hidden-md hidden-lg">
                            Opções
                        </p>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="lista_projetos.php" >Trocar Projeto</a></li>
                        <li><a href="../../controller/usuario/logout.php">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>