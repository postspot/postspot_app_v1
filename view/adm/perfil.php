<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/habilidades.php';
require_once '../../model/idiomas.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';
require_once 'includes/header_padrao.php';

$usuario = usuarios::getById($_SESSION['id_usuario']);
$habilidades = habilidades::getAllSkills();
$idiomas = idiomas::getAllIdiomas();
$habilidades_user = habilidades_usuario::getHabilidadesUsuario($usuario->id_usuario);
$idiomas_user = idiomas_usuario::getIdiomasUsuario($usuario->id_usuario);
/*pre_r($usuario);
die();*/
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Perfil - PostSpot</title>
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
                        <form id="formEditaUsuario" action="../../controller/usuario/edita_perfil.php" enctype="multipart/form-data" method="POST">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="card card-user">
                                        <div class="image">
                                            <img src="assets/img/background.jpg" alt="..."/>
                                        </div>
                                        <div class="card-content">
                                            <div class="author">
                                                <img class="avatar border-white" src="../../uploads/usuarios/<?=$usuario->foto_usuario?>" alt="Foto de perfil <?=$usuario->nome_usuario?>"/>
                                                <h4 class="card-title"><?=$usuario->nome_usuario?><br />
                                                    <a href="#"><small><?=funcaoCliente($usuario->funcao_usuario)?></small></a>
                                                </h4>
                                            </div>
                                            <p class="description text-center">
                                                <?=$usuario->email_usuario?> <br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Editar Perfil</h4>
                                        </div>
                                        <div class="card-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Nome</label>
                                                            <input type="text" class="form-control border-input" placeholder="Nome" value="<?=$usuario->nome_usuario?>" name="nome_usuario" require="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Sexo</label>
                                                            <select class="form-control border-input" name="sexo_usuario">
                                                                <option value="m" <?= ($usuario->sexo_usuario == 'm') ? 'selected="selected"' : '' ?>>Masculino</option>
                                                                <option value="f" <?= ($usuario->sexo_usuario == 'f') ? 'selected="selected"' : '' ?>>Feminino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Foto</label>
                                                            <input type="file" class="form-control" name="foto_usuario">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if($_SESSION['funcao_usuario'] == 2):?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Habilidade</label>
                                                                <select multiple title="Escolha as Habilidades" class="selectpicker" data-style="no-border" data-size="7" name="habilidade[]">
                                                                    <?php foreach($habilidades as $habilidade):
                                                                        $selected = '';
                                                                        foreach ($habilidades_user as $hab_user) {
                                                                            if($habilidade->id_habilidade == $hab_user->habilidades_id_habilidade){
                                                                                $selected = 'selected="selected"';
                                                                            }
                                                                        }
                                                                    ?>
                                                                        <option value="<?= $habilidade->id_habilidade ?>" <?= $selected ?>><?= $habilidade->nome_habilidade ?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="block">Idiomas</label>
                                                                <?php foreach ($idiomas as $idioma):
                                                                    $selected = '';
                                                                    foreach ($idiomas_user as $id_user) {
                                                                        if($idioma->id_idioma == $id_user->idiomas_id_idioma){
                                                                            $selected = 'checked="checked"';
                                                                        }
                                                                    }
                                                                ?>
                                                                    <div class="checkbox checkbox-inline">
                                                                        <input id="checkIdioma<?= $idioma->id_idioma ?>" <?= $selected ?> type="checkbox" value="<?= $idioma->id_idioma ?>" name="idioma[]">
                                                                        <label for="checkIdioma<?= $idioma->id_idioma ?>">
                                                                            <?= $idioma->nome_idioma ?>
                                                                        </label>
                                                                    </div>
                                                                <?php endforeach;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else:?>
                                                    <input type="hidden" name="idioma[]" value="">
                                                    <input type="hidden" name="habilidade[]" value="">
                                                <?php endif;?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control border-input" value="<?=$usuario->email_usuario?>" name="email_usuario" email="true" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Descrição usuário</label>
                                                            <textarea rows="5" name="obs" class="form-control border-input" placeholder=""><?=$usuario->obs?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>CPF / CNPJ</label>
                                                            <input type="text" class="form-control border-input" value="<?=$usuario->doc_usuario?>" name="doc_usuario">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Banco</label>
                                                            <input type="text" class="form-control border-input" value="<?=$usuario->banco_usuario?>" name="banco_usuario">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Agência</label>
                                                            <input type="text" class="form-control border-input" value="<?=$usuario->agencia_usuario?>" name="agencia_usuario">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Conta Corrente</label>
                                                            <input type="text" class="form-control border-input" value="<?=$usuario->conta_usuario?>" name="conta_usuario">
                                                        </div>
                                                    </div>
                                                    </div>

                                                <div>
                                                    <button type="button" class="btn btn-warning btn-fill btn-wd fundo-roxo-escuro" onclick="funcoes.showSwal('trocarSenha')">Trocar Senha</button>
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd pull-right fundo-rosa">Atualizar Perfil</button>
                                                </div>
                                                <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php require_once './includes/footer_imports.php'; ?>

    
    <script>
        $(document).ready(function() {
        $('#formEditaUsuario').validate();

        <?php if (isset($_GET['retorno']) && $_GET['retorno'] == 'ok') { ?>
            funcoes.showNotification(0,1,'Perfil atualizado.');
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'erro') { ?>
            funcoes.showNotification(0,4,'Perfil não atualziado.');
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'sOk') { ?>
            funcoes.showNotification(0,1,'Senha atualziada.');
        <?php }else if (isset($_GET['retorno']) && $_GET['retorno'] == 'sErro') { ?>
            funcoes.showNotification(0,4,'Senha não atualizada.');
        <?php } ?>
        });
    </script>
</html>