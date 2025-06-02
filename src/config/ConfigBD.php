<?php

namespace abilioj\ToolToDev\config;

use PDO;

/**
 * Description of ConfigBDClass
 * Cofigurar as configurações de conexão co o banco de dados
 * @author abilio.jose
 * @version 0.1 
 * @copyright  GPL © 2022, HEANA. 
 * @access public  
 * @package app/Rules
 */
class ConfigBD {

    private $database;
    private $user;
    private $host;
    private $password;
    private $port;
    private $charset;
    private $prefixoBD;
    private $drivers;
    private $dsn;
    private $options;
    private $optDB;

    function __construct() {
        $this->charset = $_ENV['CHARSET'] ?? "utf8";
        $this->drivers = $_ENV['DB_DRIVERS']; // drivers - "mysql"  "pgsql" "sqlite" "sqlsrv"
        $this->optDB = $_ENV['ENV']; //desenvolvimento: 0 :: Valor de produção: 1 
        $this->prefixoBD = $_ENV['DB_PREFIXOBD'];
        $this->host = $_ENV['DB_HOST'];
        $this->database = $this->prefixoBD . $_ENV['DB_DATABASE'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->port = $_ENV['DB_PORT']; 
        $this->dsn = "" . $this->drivers . ":host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database . "";
        $this->options = array(PDO::ATTR_PERSISTENT => true);
    }

    public function getDatabase() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPort() {
        return $this->port;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function getCharset() {
        return $this->charset;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }

    public function getPrefixoBD() {
        return $this->prefixoBD;
    }

    public function setPrefixoBD($prefixoBD) {
        $this->prefixoBD = $prefixoBD;
    }

    public function getDrivers() {
        return $this->drivers;
    }

    public function setDrivers($drivers) {
        $this->drivers = $drivers;
    }

    public function getDsn() {
        return $this->dsn;
    }

    public function setDsn($dsn) {
        $this->dsn = $dsn;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function getOptDB() {
        return $this->optDB;
    }

    public function setOptDB($optDB) {
        $this->optDB = $optDB;
    } 
}
