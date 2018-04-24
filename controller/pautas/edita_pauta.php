<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../lib/phpMailer.php';
require_once '../../model/tarefas.php';
require_once '../../model/log_tarefas.php';
require_once '../../model/membros_equipe.php';

session_start();

$id_tarefa = $_POST["id_tarefa"];
$nome_tarefa = $_POST["nome_tarefa"];
$tipo_tarefa = $_POST["tipo_tarefa"];
$palavra_chave = $_POST["palavra_chave"];
$briefing_tarefa = $_POST["briefing_tarefa"];
$tipo_cta = $_POST["tipo_cta"];
$referencias = $_POST["referencias"];
$consideracoes_gerais = $_POST["consideracoes_gerais"];
$id_persona = $_POST["id_persona"];
$estagio_compra = $_POST["estagio_compra"];
$id_projeto = $_SESSION['id_projeto'];
$id_usuario = $_SESSION['id_usuario'];
$aprovacao = $_POST["aprovacao"];
$etapa = $_POST['etapa'];
$clientes = membros_equipe::buscarClientesDaEquipe($_SESSION['id_projeto']);
$moderadores = membros_equipe::buscarModeradorDaEquipe($_SESSION['id_projeto']);


if (isset($nome_tarefa) && isset($tipo_tarefa) && isset($palavra_chave) &&
    isset($briefing_tarefa) && isset($estagio_compra) && isset($id_persona) &&
    isset($tipo_cta) && isset($referencias) && isset($consideracoes_gerais) && isset($id_projeto)) {

    if (!empty($nome_tarefa) && !empty($tipo_tarefa) && !empty($estagio_compra) &&
        !empty($id_persona) && !empty($tipo_tarefa) && !empty($estagio_compra) && !empty($id_projeto)) {
    
        // Prepara a Tarefa
        $nova_tarefa = new stdClass();
        $nova_tarefa->id_tarefa = $id_tarefa;
        $nova_tarefa->nome_tarefa = $nome_tarefa;
        $nova_tarefa->palavra_chave = $palavra_chave;
        $nova_tarefa->briefing_tarefa = $briefing_tarefa;
        $nova_tarefa->estagio_compra = $estagio_compra;
        $nova_tarefa->tipo_cta = $tipo_cta;
        $nova_tarefa->referencias = $referencias;
        $nova_tarefa->consideracoes_gerais = $consideracoes_gerais;
        $nova_tarefa->id_persona = $id_persona;
        $nova_tarefa->id_projeto = $id_projeto;
        $nova_tarefa->id_tipo = $tipo_tarefa;
        $nova_tarefa->id_equipe = $id_projeto;


        if (tarefas::update($nova_tarefa)) {
            resetStatusTarefa($id_tarefa);
            if ($aprovacao == '0') { // Senão for para aprovação, apenas cria o log de salvo
                $nova_etapa = ($etapa == PAUTA_ESCREVENDO) ? PAUTA_ESCREVENDO : PAUTA_AJUSTANDO;
                $novo_log_salvo = new stdClass();
                $novo_log_salvo->etapa = $nova_etapa;
                $novo_log_salvo->status = 1;
                $novo_log_salvo->data_prevista = retornaDataPrevista($nova_etapa,$id_tarefa);
                $novo_log_salvo->id_tarefa = $id_tarefa;
                $novo_log_salvo->id_usuario = $id_usuario;
                if (log_tarefas::insert($novo_log_salvo)) {
                    header('Location: ../../view/adm/pautas.php?retorno=nOk');
                } else {
                    header('Location: ../../view/adm/detalhes_pauta.php?t=' . $id_tarefa . '&retorno=nErro');
                }
            } else if ($aprovacao == '1') { // Senão, Pode ser enviado para aprovação do cliente

                $nova_etapa = ($etapa == PAUTA_APROVACAO_MODERADOR) ? PAUTA_APROVACAO_CLIENTE : PAUTA_REAPROVACAO_CLIENTE;
                $novo_log_aprovacao = new stdClass();
                $novo_log_aprovacao->etapa = $nova_etapa;
                $novo_log_aprovacao->status = 1;
                $novo_log_aprovacao->data_prevista = retornaDataPrevista($nova_etapa,$id_tarefa);
                $novo_log_aprovacao->id_tarefa = $id_tarefa;
                $novo_log_aprovacao->id_usuario = $id_usuario;
                //Vai enviar email aqui

                $assunto = 'Nova pauta para você aprovar';
                foreach ($clientes as $cliente) :
                    //    PREPARA AS VARIAVEIS
                $param_email = array(
                    'nome' => $cliente->nome_usuario,
                    'titulo' => $nome_tarefa,
                    'data' => date("d/m/Y", strtotime($novo_log_aprovacao->data_prevista)),
                    'id_tarefa' => $id_tarefa
                );

                    //    LINKA + PARAMETROS
                $parametros = SITE . 'mail/cliente_pauta.php?' . http_build_query($param_email);

                    // VARIAVEIS
                $para = $cliente->email_usuario;
                $tmp = file_get_contents($parametros);
                smtpmailer($para, $assunto, $tmp);
                endforeach;

                if (log_tarefas::insert($novo_log_aprovacao)) {
                    header('Location: ../../view/adm/pautas.php?retorno=naOk');
                } else {
                    header('Location: ../../view/adm/detalhes_pauta.php?t=' . $id_tarefa . '&retorno=nErro');
                }
            } else if ($aprovacao == '2') {// Senão, Pode ser enviado para aprovação do moderador

                $nova_etapa = ($etapa == PAUTA_ESCREVENDO) ? PAUTA_APROVACAO_MODERADOR : PAUTA_REAPROVACAO_MODERADOR;
                $novo_log_aprovacao = new stdClass();
                $novo_log_aprovacao->etapa = $nova_etapa;
                $novo_log_aprovacao->status = 1;
                $novo_log_aprovacao->data_prevista = retornaDataPrevista($nova_etapa,$id_tarefa);
                $novo_log_aprovacao->id_tarefa = $id_tarefa;
                $novo_log_aprovacao->id_usuario = $id_usuario;
                //Vai enviar email aqui

                $assunto = 'Pauta em avaliação no projeto ' . $_SESSION['nome_projeto'] . ' - ' . date("d/m/Y") . ' às ' . date("H:i");
                foreach ($moderadores as $moderador) :
                    //    PREPARA AS VARIAVEIS
                    $param_email = array(
                        'nome' => $moderador->nome_usuario,
                        'titulo' => $nome_tarefa,
                        'projeto' => $_SESSION['nome_projeto'],
                        'data' => date("d/m/Y", strtotime($novo_log_aprovacao->data_prevista)),
                        'id_tarefa' => $id_tarefa
                    );

                    //    LINKA + PARAMETROS
                    $parametros = SITE . 'mail/pauta_avaliacao.php?' . http_build_query($param_email);

                    // VARIAVEIS
                    $para = $moderador->email_usuario;
                    $tmp = file_get_contents($parametros);
                    smtpmailer($para, $assunto, $tmp);
                endforeach;

                if (log_tarefas::insert($novo_log_aprovacao)) {
                    header('Location: ../../view/adm/pautas.php?retorno=navOk');
                } else {
                    header('Location: ../../view/adm/detalhes_pauta.php?t=' . $id_tarefa . '&retorno=nErro');
                }
            }
        } else {

        }
    } else {
        header('Location: ../../view/adm/detalhes_pauta.php?t=' . $id_tarefa . '&retorno=nErro');
    }
} else {
    header('Location: ../../view/adm/detalhes_pauta.php?t=' . $id_tarefa . '&retorno=nErro');
}