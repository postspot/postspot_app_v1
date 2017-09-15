<?php
// ####  comente as 4 linhas abaixo se o site estiver na hostgator
define('USER', 'pocosja_juliano');
define('PASS', 'cjb728723');
define('BANCO', 'pocosja_home');
//define('HOST', '195.110.58.173');
define('HOST', '216.155.142.66');


/* --------- lista de usuários (ambiente de produção) -------- */

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);



// #### comente a linha abaixo se o site estiver no servidor hostgator
//define("DEV_LINUX", 'http://localhost/appMelhorCompra/');

// #### descomente a linha abaixo se o site estiver no servidor hostgator
// define("DEV_LINUX",':/home/gruponacionalinn/public_html/site');

define('DIR_ROOT', '/var/www/html');

set_include_path(ini_get("include_path") . PATH_SEPARATOR ."C:/xampp/htdocs/postSpotLocal/");

//set_include_path(ini_get("include_path") . PATH_SEPARATOR ."/var/www/html");
//set_include_path(ini_get("include_path").".;e:\\home\\SEU_LOGIN_DE_FTP\\SEU_DIRETORIO");


define('CONTATO', 'contato@pocosja.com.br');
define('SITE', 'http://www.pocosja.com.br/');


header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");