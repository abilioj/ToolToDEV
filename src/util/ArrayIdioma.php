<?php

namespace abilioj\ToolToDev\util;

use Exception;
/**
 * Classe ArrayIdioma
 * @package abilioj\ToolToDev\util
 *
 * Classe para manipulação de arrays de idiomas, especialmente para mensagens de erro e sucesso.
 * Fornece métodos para criar arrays com mensagens em diferentes idiomas.
 */
class ArrayIdioma {

   private $String;
   private $Array;
   private $sizeArray; //tamanho do Array

   function __construct() {

   }

   public function getSizeArray(): int {
      return $this->sizeArray;
   }

   function getString(): string {
      return $this->String;
   }

   function setString(string $paramString) {
      $this->String = $paramString;
   }

   function setArray(array $paramArray) {
      $this->Array = $paramArray;
   }

   //Monta Array de conexão -> resquivendo idice PADRÕES
   public function ArrayConnection(array $paramArray): array {
      $this->sizeArray = $tamanhoArray = (int) sizeof($paramArray);
      switch ($tamanhoArray):
         case 1:
            $this->Array = $array_failedConn_usEN = array("Connection" => $paramArray[0]);
            break;
         case 10:
            $this->Array = $array_failedConn_usEN = array(
                "Connection" => $paramArray[0], "failed" => $paramArray[1],
                "Access" => $paramArray[2], "denied" => $paramArray[3],
                "for" => $paramArray[4], "user" => $paramArray[5],
                "root" => $paramArray[6], "msgi" => $paramArray[7],
                "msgii" => $paramArray[8], "msgiii" => $paramArray[9]
            );
            break;
         case 11:
            $this->Array = $array_usEN = array(
                "Connection" => $paramArray[0],
                "failed:" => $paramArray[1],
                "php_network_getaddresses:" => $paramArray[2],
                "getaddrinfo" => $paramArray[3],
                "failed:" => $paramArray[4],
                "Este" => $paramArray[5],
                "host" => $paramArray[6],
                "n�o" => $paramArray[7],
                "�" => $paramArray[8],
                "conhecido." => $paramArray[9],
                "10" => $paramArray[10]
            );
            break;
      endswitch;
      return $this->Array;
   }

   //metodo de array de Palavras de Connection erros ao Conectar em pt-br
   public function ArrayConnErro_us_EN(): array {
      // "Connection" => "failed" => "Access" => "denied" => "for" => "user" => "root" => "msgi" => "msgii" => "msgiii" =>
      $this->Array = $array_failedConn_usEN = array(
          "Connection" => "Connection",
          "failed" => "failed:",
          "Access" => "Access",
          "denied" => "denied",
          "for" => "for",
          "user" => "user",
          "root" => "admin@localhost",
          "msgi" => "(using",
          "msgii" => "password:",
          "msgiii" => "YES)"
      );
      return $this->Array;
   }

   //metodo de array de Palavras de Connection erros ao Conectar em pt-br
   public function ArrayConnErro_pt_BR(): array {
      $this->Array = $array_failedConn_ptBR = array(
          "Connection" => "Conexão",
          "failed" => "falhou:",
          "Access" => "Acesso",
          "denied" => "negado",
          "for" => "para",
          "user" => "usuário",
          "root" => "admin@localhost",
          "msgi" => "(usando",
          "msgii" => "senha:",
          "msgiii" => "SIM)"
      );
      return $this->Array;
   }

   //metodo de array de Palavras de Connection erros ao Conectar em pt-br
   public function ArrayConnErro_Hostus_EN(): array {
      // "Connection" => "failed" => "Access" => "denied" => "for" => "user" => "root" => "msgi" => "msgii" => "msgiii" =>
      $this->Array = $array_usEN = array(
          "Connection" => "Connection",
          "failed:" => "failed:",
          "php_network_getaddresses:" => "php_network_getaddresses:",
          "getaddrinfo" => "getaddrinfo",
          "failed:" => "failed:",
          "Este" => "This",
          "host" => "host",
          "n�o" => "is",
          "�" => "not",
          "conhecido." => "known.",
          "10" => ""
      );
      return $this->Array;
   }

   //metodo de array de Palavras de Connection erros ao Conectar em pt-br
   public function ArrayConnErro_Hostpt_BR(): array {
      $this->Array = $array_ptBR = array(
          "Connection" => "Falha",
          "failed:" => "na conexão:",
          "php_network_getaddresses:" => "php_network_getaddresses:",
          "getaddrinfo" => "getaddrinfo",
          "failed:" => "falhou:",
          "Este" => "Este",
          "host" => "host",
          "n�o" => "não",
          "�" => "é",
          "conhecido." => "conhecido.",
          "" => ""
      );
      return $this->Array;
   }

   //metodo de array de Palavras de Connection Conectar em us-EN
   public function ArrayConn_us_EN(): array {
      return $this->Array = $array_Conn_usEN = array("Connected" => "Connected");
   }

   //metodo de array de Palavras de Connection Conectar em pt-br
   public function ArrayConn_pt_BR(): array {
      return $this->Array = $array_Conn_ptBR = array("Connected" => "Conectado");
   }

}
