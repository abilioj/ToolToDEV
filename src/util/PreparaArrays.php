<?php

namespace abilioj\ToolToDev\util;

use abilioj\ToolToDev\util\ToString;
/**
 * Description of PreparaArray
 *
 * @author Abílio José G Ferreira
 */
class PreparaArrays {

   function __construct() {

   }

   public function ArryasTOMaiusculas($array) {
      $return = array_map(function($value) {
         return ToString::StringPraMaiusculas($value);
      }, $array);
      return $return;
   }

   /**
    * (PHP 5.6, PHP 7)<br/>
    * Alias of <b>StringToArray Explode</b>
    * @link http://php.net/manual/en/function.join.php
    * @param $paramString string
    * @param $paramCarac string
    * <br/><br/>
    * <p><b>Descrição:</b>Com essa função iremos converter um String para uma array.
    * Para tal, iremos utilizar a função explode, passando o caractere que desejamos
    * utilizar para separar os dados na string.</p>
    */
   function StringToArray(string $paramString, string $paramCarac) {
      $array = explode($paramCarac, $paramString);
      return $array;
   }

   /**
    * (PHP 5.6, PHP 7)<br/>
    * Alias of <b>ArrayToString Implode</b>
    * @link http://php.net/manual/en/function.join.php
    * @param $paramArray array
    * @param $paramCarac string
    * <br/><br/>
    * <p><b>Descrição:</b>
    * <br/>Com essa função vamos converter um array para uma string.
    * Para tal, iremos utilizar a função implode(), passando o caractere que desejamos
    * utilizar para separar os dados na string.</p>
    */
   function ArrayToString(array $paramArray, string $paramCarac) {
      $array = implode($paramCarac, $paramArray);
      return $array;
   }

}
