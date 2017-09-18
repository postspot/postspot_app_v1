<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';

//$id_projeto = $_POST["id_projeto"];
//$foto = $_POST["foto"];
//$nome = $_POST["nome"];
//$idade = $_POST["idade"];
//$sexo = $_POST["sexo"];
//$caracteristicas = $_POST["caracteristicas"];
//$educacao = $_POST["educacao"];
//$trabalho = $_POST["trabalho"];
//$segmento = $_POST["segmento"];
//$objetivos = $_POST["objetivos"];
//$descricao = $_POST["descricao"];
//$resolucao = $_POST["resolucao"];

pre_r($_POST);
die();

if (isset($id_projeto) && isset($nome) && isset($idade) && isset($sexo) && 
    isset($caracteristicas) && isset($educacao) && isset($trabalho) &&
    isset($segmento) && isset($objetivos) && isset($descricao) && isset($resolucao)) {

    if (!empty($id_projeto) && !empty($nome) && !empty($idade)) {
      
        $obj = new stdClass();
        
        $obj->nome = $nome;
        $obj->idade = $idade;
	$obj->sexo = $sexo;
	$obj->caracteristicas = $caracteristicas;
	$obj->educacao = $educacao;
	$obj->trabalho = $trabalho;
	$obj->segmento = $segmento;
	$obj->objetivos = $objetivos;
	$obj->descricao = $descricao;
	$obj->resolucao = $resolucao;
	$obj->foto = $foto;
	$obj->id_projeto = $id_projeto;
         
        
        if(personas::insert($obj)){
            header('Location: ../../view/adm/cria_persona.php?retorno=ok');
        }
        else{
            header('Location: ../../view/adm/cria_persona.php?retorno=erro');
            
        }
    }
    else {
        header('Location: ../../view/adm/cria_persona.php?retorno=falha');
    }
} 
else {
    header('Location: ../../view/adm/cria_persona.php?retorno=falha');
}




