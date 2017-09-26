<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/personas.php';
session_start();

$id_projeto = $_SESSION['id_projeto'];
$foto = $_POST["foto"];
$nome = $_POST["nome"];
$idade = $_POST["idade"];
$sexo = $_POST["sexo"];
$caracteristicas = $_POST["caracteristicas"];
$educacao = $_POST["educacao"];
$trabalho = $_POST["trabalho"];
$segmento = $_POST["segmento"];
$objetivos = $_POST["objetivos"];
$descricao = $_POST["descricao"];
$resolucao = $_POST["resolucao"];
$id_persona = $_POST["id_persona"];

 
if (isset($id_projeto) && isset($nome) && isset($idade) && isset($sexo) && 
    isset($caracteristicas) && isset($educacao) && isset($trabalho) && isset($segmento) 
    && isset($objetivos) && isset($descricao) && isset($resolucao) && isset($id_persona)) {
      
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
	$obj->id_persona = $id_persona;
         
        
        if(personas::update($obj)){
            header('Location: ../../view/adm/personas.php?retorno=eOk');
        }
        else{
            header('Location: ../../view/adm/edita_persona.php?persona='.$id_persona.'&retorno=falha');
        }
}
else{
    header('Location: ../../view/adm/edita_persona.php?persona='.$id_persona.'&retorno=falha');
}


