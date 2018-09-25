<?php
require_once '../../config/config.php';
require_once '../../lib/operacoes.php';
require_once '../../model/usuarios.php';
require_once '../../model/candidatos.php';
require_once '../../model/conteudo_teste_candidato.php';
session_start();

$array_escolhas = $_POST["array_escolhas"];
$id_user = $_POST["id"];

//Retorna o candidato
$candidato = candidatos::getByIdUser($id_user);
$candidato->id_conteudo_teste_candidato;

//Sorteia a modalidade dentre as escolhidas
$indexSorteado = array_rand($array_escolhas);
$id_habilidade_sorteada = $array_escolhas[$indexSorteado];

//Busca o id do conteudo
$teste_sorteado = conteudo_teste_candidato::getAllByHabilidade($id_habilidade_sorteada);

//atribui ao candidato
if(candidatos::updateTeste($teste_sorteado->id_conteudo_teste_candidato, $id_user)){
    echo json_encode($teste_sorteado);
}else{
    echo json_encode('false');
}