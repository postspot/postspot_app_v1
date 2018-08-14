<?php
//Desenvolvimento
/*define('USER','root');
 define('PASS','');
 define('BANCO','banco_andress_n');
 define('HOST','localhost');
 define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']. '/postspot');
 define('SITE', 'http://localhost/postspot/');
 define('AMBIENTE_PROD', false);*/

//Produção
define('USER', 'app');
define('PASS', '7sHiJKJb5rCI');
define('BANCO', 'app');
define('HOST', 'mysql.app.postspot.com.br');

define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']. '/postspot');
define('SITE', 'https://app.postspot.com.br/postspot/');
define('AMBIENTE_PROD', true);


define('GUSER', 'ola@app.postspot.com.br');
define('GPWD', '#PostSpot2017');
define('APP_NOME', 'Time PostSpot');


date_default_timezone_set('America/Sao_Paulo');

define('PAUTA_ESCREVENDO', 0);
define('PAUTA_APROVACAO_MODERADOR', 1);
define('PAUTA_APROVACAO_CLIENTE', 2);
define('PAUTA_REPROVADA', 3);
define('PAUTA_AJUSTANDO', 4);
define('PAUTA_REAPROVACAO_MODERADOR', 5);
define('PAUTA_REAPROVACAO_CLIENTE', 6);
define('CONTEUDO_ESCREVENDO', 7);
define('CONTEUDO_APROVACAO_MODERADOR', 8);
define('CONTEUDO_APROVACAO_CLIENTE', 9);
define('CONTEUDO_REPROVADO', 10);
define('CONTEUDO_AJUSTANDO', 11);
define('CONTEUDO_REAPROVACAO_MODERADOR', 12);
define('CONTEUDO_REAPROVACAO_CLIENTE', 13);
define('CONTEUDO_PARA_PUBLICAR', 14);
define('CONTEUDO_PUBLICADO', 15);