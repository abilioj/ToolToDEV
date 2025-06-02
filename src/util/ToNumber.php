<?php

namespace abilioj\ToolToDev\util;

/**
 * Description of ToNumber
 *
 * @author AJGF
 */
class ToNumber {
    
    public function __construct() {
    }

    /**
     * Formata número inteiro sem separador de milhar
     * @param integer $numero inteiro a ser formatado
     * @return string
     */
    public static function inteiro(int $numero) {
        $numero = number_format($numero, 0, '.', '.');
        return $numero;
    }

    /**
     * Formata número inteiro com separador de milhar
     * @param integer $numero inteiro a ser formatado
     * @return string
     */
    public static function inteiro_br(int $numero) {
        $numero = number_format($numero, 0, ',', '.');
        return $numero;
    }

    /**
     * Formata número inteiro em engle com separador de milhar
     * @param integer $numero inteiro a ser formatado
     * @return string
     */
    public static function inteiro_en(int $numero) {
        $numero = number_format($numero, 0, '.', '');
        return $numero;
    }

    /**
     * Formata número inteiro para decimal com duas casas e com separador de milhar
     * @param integer $numero inteiro a ser formatado
     * @return string
     */
    public static function inteiro_decimal_br(int $numero) {
        $numero = number_format($numero, 2, ',', '.');
        return $numero;
    }

    /**
     * Formata número inteiro engle para decimal com duas casas e com separador de milhar
     * @param integer $numero inteiro a ser formatado
     * @return string
     */
    public static function inteiro_decimal_en(int $numero) {
        $numero = number_format($numero, 2, '.', '');
        return $numero;
    }

    public static function arredondamento(int $numero,int $casa) {
        $numero = number_format($numero, $casa, '.', '');
        return $numero;
    }

}
