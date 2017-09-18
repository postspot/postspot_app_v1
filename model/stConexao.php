<?php
require_once '../../config/config.php';
date_default_timezone_set('America/Sao_Paulo');

class Conexao {

    public static $instance;
    private static $user = USER;
    private static $pass = PASS;

    private function __construct() {
        //
    }

    public static function setConfig($usr, $pass) {
        self::$user = $usr;
        self::$pass = $pass;
    }

    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO('mysql:host=' . HOST . ';dbname=' . BANCO, self::$user, self::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            }

            return self::$instance;
        } catch (PDOException $ex) {
            echo '<h1>Erro interno de servidor. Por favor, entre em contato com um de nossos desenvolvedores.</h1>';
            echo '<br>email: contato@melhorcomprapocos.com.br';
            echo '<br>Erro'. $ex->getMessage();
            echo '<br>mysql:host=' . HOST . ';dbname=' . BANCO, self::$user, self::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            die();
        }
    }

}
