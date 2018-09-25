<?php
require_once '../../config/config.php';
require_once '../../model/usuarios.php';
require_once '../../lib/operacoes.php';
require_once '../../model/projetos.php';
require_once '../../model/candidatos.php';

session_start();

$login_usuario = '';
$senha_usuario = '';

if (isset($_POST['campo_login']) && isset($_POST['campo_senha'])) {
    $login_usuario = $_POST['campo_login'];
    $senha_usuario = $_POST['campo_senha'];
}
else{
    session_destroy();
    header('location: ../../view/adm/index.php?erro=sessao3');
}

$usuario = usuarios::login($login_usuario, md5($senha_usuario));

if ($usuario == null) {
    session_destroy();
    header('location: ../../view/adm/index.php?erro=sessao3');
} 

else {
    $_SESSION['id_usuario'] = $usuario->id_usuario;
    $_SESSION['funcao_usuario'] = $usuario->funcao_usuario;
    $_SESSION['nome_usuario'] = $usuario->nome_usuario;
    $_SESSION['foto_usuario'] = $usuario->foto_usuario;
    
    $projeto = projetos::getByUsuario($usuario->id_usuario);
    if ( empty($projeto)  ||  $projeto == "" ||  $projeto == NULL){
        if($usuario->funcao_usuario == 5){
            $candidato = candidatos::getByIdUser($usuario->id_usuario);
            if($candidato->status_candidato == 0){
                $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
                switch ($candidato->modalidade_candidatos) {
                    case 1:
                        # Pauta
                        header('Location: ../../view/freelancers/registro_pauta.php?r=ok&u=' . $usuario->id_usuario);
                        break;
                    case 2:
                        # Redação
                        header('Location: ../../view/freelancers/registro_redator.php?r=ok&u=' . $usuario->id_usuario);
                        break;
                    case 3:
                        # Revisão
                        header('Location: ../../view/freelancers/registro_revisor.php?r=ok&u=' . $usuario->id_usuario);
                        break;
                    case 4:
                        # Design
                        header('Location: ../../view/freelancers/registro_designer.php?r=ok&u=' . $usuario->id_usuario);
                        break;
                }
            }else{
                header('location: ../../view/adm/index.php?erro=sessao4');
            }
        }else{
            header('location: ../../view/adm/index.php?erro=sessao4');
        }
        
    }else{
        $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
        if(count($projeto) > 1):
            header('location: ../../view/adm/lista_projetos.php');
        else:
            $_SESSION['id_projeto'] = $projeto[0]->id_projeto;
            $_SESSION['nome_projeto'] = $projeto[0]->nome_projeto;
            header('location: ../../view/adm/dashboard.php');
        endif;
    }
    
}
