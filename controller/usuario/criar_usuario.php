<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/idiomas_usuario.php';

$nome_tarefa = $_POST["nome_tarefa"];
$tipo_tarefa = $_POST["tipo_tarefa"];
$palavra_chave = $_POST["palavra_chave"];
$briefing_tarefa = $_POST["briefing_tarefa"];
$estagio_compra = $_POST["estagio_compra"];
$id_persona = $_POST["id_persona"];
$tipo_cta = $_POST["tipo_cta"];
$referencias = $_POST["referencias"];
$consideracoes_gerais = $_POST["consideracoes_gerais"];
$id_projeto = $_POST["id_projeto"];
//$consideracoes_gerais = $_POST["consideracoes_gerais"];

//pre_r($_POST);
//die();    

if (isset($nome_tarefa) && isset($tipo_tarefa) && isset($palavra_chave) && 
    isset($briefing_tarefa) && isset($estagio_compra) && isset($id_persona) &&
    isset($tipo_cta) && isset($referencias) && isset($consideracoes_gerais)) {

    if (!empty($id_persona)) {
      
        $obj = new stdClass();
        
        $obj->nome_usuario = $nome_tarefa;
        $obj->sexo_usuario = $tipo_tarefa;
	$obj->foto_usuario = $palavra_chave;
	$obj->funcao_usuario = $funcao_usuario;
	$obj->email_usuario = $briefing_tarefa;
	$obj->senha_usuario = $estagio_compra;
	$obj->senha_usuario = $id_persona;
	$obj->senha_usuario = $tipo_cta;
	$obj->senha_usuario = $id_projeto;
//	$obj->senha_usuario = $estagio_compra;
        
        $obj->id_usuario = ta::getAutoInc();
        $obj->id_idioma = $idioma;
         
//        pre_r($obj);
        if(usuarios::insert($obj)){
            
            if(idiomas_usuario::insert($obj)){
                header('Location: ../../view/cria_usuario.php?retorno=ok');
            }
            else{
                header('Location: ../../view/cria_usuario.php?retorno=erro');
            }
        }
        else{
            header('Location: ../../view/cria_usuario.php?retorno=erro');
        }
    }
    else {
        header('Location: ../../view/cria_usuario.php?retorno=falha');
    }
} 
else {
    header('Location: ../../view/cria_usuario.php?retorno=falha');
}




