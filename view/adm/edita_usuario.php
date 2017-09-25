<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/habilidades.php';
require_once '../../model/idiomas.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';
require_once '../../model/habilidades_usuario.php';

if(isset($_GET["u"])){
    $usuario = usuarios::getById($_GET["u"]);
}

//pre_r($usuario);
//die();
$habilidades = habilidades::getAllSkills();
$idiomas = idiomas::getAllIdiomas();
$habilidades_user = habilidades_usuario::getHabilidadesUsuario($usuario->id_usuario);
$idiomas_user = idiomas_usuario::getIdiomasUsuario($usuario->id_usuario);
?>
<html lang="pt-br">
    <head>
        <?php require_once './includes/header_includes.php'; ?>
        <title>Post Stadium</title>
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
                        <form action="../../controller/usuario/edita_usuario.php" enctype="multipart/form-data" method="POST">
                        <input type="hidden" value="<?= $usuario->id_usuario ?>" name="id_usuario">
                        <h4 class="title"><i class="ti-user"></i> Edita Usuário</h4>
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
                                                    <input type="file" disabled class="form-control" name="foto_usuario" value="<?= $usuario->foto_usuario ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Função</label>
                                                    <select class="form-control border-input" name="funcao_usuario">
                                                        <option value="0" <?= ($usuario->funcao_usuario == '0') ? 'selected="selected"' : '' ?>>Gestor</option>
                                                        <option value="1" <?= ($usuario->funcao_usuario == '1') ? 'selected="selected"' : '' ?>>Analista</option>
                                                        <option value="2" <?= ($usuario->funcao_usuario == '2') ? 'selected="selected"' : '' ?>>Redator</option>
                                                        <option value="3" <?= ($usuario->funcao_usuario == '3') ? 'selected="selected"' : '' ?>>Cliente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
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
                                            <div class="col-md-12">
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
                                        </div>
                                    </div>
                                </div> <!-- end col-md-12 -->
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Informações Acesso
                                        </h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control border-input" name="email_usuario" value="<?= $usuario->email_usuario ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Senha</label>
                                                    <input type="text" disabled class="form-control border-input" name="senha_usuario">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Confirmar Senha</label>
                                                    <input type="text" disabled class="form-control border-input" name="confirmacao">
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill btn-info pull-right">Salvar</button>                                               
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