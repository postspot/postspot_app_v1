<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';
require_once '../../model/conteudo_teste_candidato.php';

$nome_usuario = $_POST["nome_usuario"];
$sobrenome_usuario = $_POST["sobrenome_usuario"];
$funcao_usuario = 5;
$email_usuario = $_POST["email_usuario"];
$senha_usuario = $_POST["senha_usuario"];
$modalidade_candidatos = $_POST["modalidade_candidatos"];

$checkUsuario = usuarios::getByEmail($email_usuario);

if (!isset($checkUsuario)) {
    if (isset($nome_usuario) && isset($email_usuario) && isset($senha_usuario)) {

        if (!empty($nome_usuario)) {

            session_start();
            $obj = new stdClass();

            $obj->nome_usuario = $nome_usuario;
            $obj->modalidade_candidatos = $modalidade_candidatos;
            $obj->sobrenome_usuario = $sobrenome_usuario;
            $obj->funcao_usuario = $funcao_usuario;
            $obj->email_usuario = $email_usuario;
            if($modalidade_candidatos == 1){
                $conteudosBanco = conteudo_teste_candidato::getAll();
                $indexSorteado = array_rand($conteudosBanco);
                $obj->id_conteudo_teste_candidato = $conteudosBanco[$indexSorteado];
            }
            $obj->senha_usuario = md5($senha_usuario);
            $obj->obs = '';
            $obj->status_candidato = 0;
            $obj->id_usuario = usuarios::getAutoInc();

            if (usuarios::insert($obj) && candidatos::insert($obj)) {
                $_SESSION['id_usuario'] = $obj->id_usuario;
                $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
                switch ($modalidade_candidatos) {
                    case 1:
                        # Pauta
                        header('Location: ../../view/freelancers/registro_pauta.php?r=ok&u=' . $obj->id_usuario);
                        break;
                    case 2:
                        # Redação
                        header('Location: ../../view/freelancers/registro_redator.php?r=ok&u=' . $obj->id_usuario);
                        break;
                    case 3:
                        # Revisão
                        header('Location: ../../view/freelancers/registro_revisor.php?r=ok&u=' . $obj->id_usuario);
                        break;
                    case 4:
                        # Design
                        header('Location: ../../view/freelancers/registro_designer.php?r=ok&u=' . $obj->id_usuario);
                        break;

                    default:
                        # Qualquer outro tipo
                        header('Location: ../../view/freelancers/inscricao.php?retorno=erro');
                        break;
                }
            } else {
                header('Location: ../../view/freelancers/inscricao.php?retorno=erro');
            }
        } else {
            header('Location: ../../view/freelancers/inscricao.php?retorno=erro');
        }
    } else {
        header('Location: ../../view/freelancers/inscricao.php?retorno=erro');
    }

} else {
    session_destroy();
    header('Location: ../../view/freelancers/inscricao.php?retorno=exi');
}