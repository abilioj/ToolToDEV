<?php

namespace abilioj\ToolToDev\util;

/**
 * Description of Date
 * @package category util
 * @author Abílio José G Ferreira
 * Classe que implementa os metodos de data e hora
 * @version 1.0
 */
class Date{

    private $DataDefat = "0001-01-31"; 
    private $DataDefatPT_BR = "31/01/0001"; 
    private $dataNew;
    private $years;
    private $month;
    private $day;
    private $hour;
    private $minute;
    private $second;
    private $fullTime;
    private $diff;
    private $stnMsg;

    function __construct() {
        //$this->dataNew = new DateTime(date('y-m-d H:i:s'));
        $this->day = date('d');
        $this->month = date('m');
        $this->years = date('Y');
        $this->fullTime = date("H:i:s");
        $this->diff = null;
        $this->stnMsg = '';
    }

    //1- Funcao que retorna a data atual no padrao Ingles (DD-MM-YYYY):
    // definindo padrao pt (dd/MM/YYYY)
    function data_atual() {
        $data = "$this->day/$this->month/$this->years";
        return $data;
    }

    //2- Funcao que retorna a data atual no padrao Ingles (YYYY-MM-DD):
    function data_atual_en() {
        $data = "$this->years/$this->month/$this->day";
        return $data;
    }

    function data_atualBD() {
        $data = "$this->years-$this->month-$this->day";
        return $data;
    }

    //definindo padr�o pt (dd/MM/YYYY HH:ii:ss)
    function dataEhora_atual() {
        $data = "$this->day-$this->month-$this->years $this->fullTime";
        return $data;
    }

    // definindo padr�o en (YYYY/MM/dd HH:ii:ss)
    function dataEhora_atual_en() {
        $data = "$this->years-$this->month-$this->day $this->fullTime";
        return $data;
    }

    function hora_atualHM() {
        $hora = date("H:i");
        return $hora;
    }

    function hora_atual_completa() {
        return $this->fullTime;
    }

    function valida_data($data, $tipo = "pt") {
        if ($tipo == 'pt') {
            $d = explode("/", $data);
            $dia = $d[0];
            $mes = $d[1];
            $ano = $d[2];
        } else if ($tipo == 'en') {
            $d = explode("-", $data);
            $dia = $d[2];
            $mes = $d[1];
            $ano = $d[0];
        }
        //usando fun��o checkdate para validar a data
        if (checkdate($mes, $dia, $ano)) {
            $data = $ano . '/' . $mes . '/' . $dia;
            if (
            //verificando se o ano tem 4 d�gitos
                    (strlen($ano) != '4') ||
                    //verificando se o m�s � menor que zero
                    ($mes <= '0') ||
                    //verificando se o m�s � maior que 12
                    ($mes > '12') ||
                    //verificando se o dia � menor que zero
                    ($dia <= '0') ||
                    //verificando se o dia � maior que 31
                    ($dia > '31')
            ) {
                return false;
            }
            if (strlen($data) == 10)
                return true;
        } else {
            return false;
        }
    }

    function data_user_para_mysql($y) {
        if ($y == null)
            return $this->DataDefat;
        $data_inverter = explode("/", $y);
        $x = $data_inverter[2] . '-' . $data_inverter[1] . '-' . $data_inverter[0];
        return $x;
    }

    function data_mysql_para_user($y) {
        if ($y != '') {
            if ($y == $this->DataDefat):
                return '';
            else:
                $x = implode("/", array_reverse(explode("-", $y)));
                return $x;
            endif;
        } else {
            return '';
        }
    }
    
    function datetime_mysql_para_user($y,$op=0) {
    if (!empty($y) && $y != "0000-00-00 00:00:00") { 
        $dataHora = explode(" ", $y); // Separa data e hora
        $data = implode("/", array_reverse(explode("-", $dataHora[0]))); // Converte data para DD/MM/YYYY
        $hora = isset($dataHora[1]) ? $dataHora[1] : ''; // Mantém a hora se existir
        return ($op==0)? trim("$data $hora") : trim($data); // Retorna data e hora formatadas
    } 
    return ''; // Retorna vazio se for inválido
}


    function validaDataTime($paramData): DateTime {
        $data = null;
        if ($paramData != null):
            $data = new DateTime($paramData);
        else:
            $data = new DateTime($paramData);
        endif;
        return $data;
    }

    function data_to_form($y, $BrowserID) {
        if ($y != '') :
            if ($y == $this->DataDefat):
                return '';
            else:
                if ($BrowserID != 6):
                    return $this->data_mysql_para_user($y);
                else:
                    return $y;
                endif;
            endif;
        else:
            return '';
        endif;
    }

    function data_to_formController($y, $BrowserID, $opIDArrays) {
        if ($y != ''):
            if ($y == $this->DataDefat):
                return '';
            else:
                foreach ($opIDArrays as $n):
                    if ($n == $BrowserID):
                        if ($BrowserID == $n):
                            return $this->data_mysql_para_user($y);
                        else:
                            return $y;
                        endif;
                    endif;
                endforeach;
            endif;
        else:
            return '';
        endif;
    }

    //%y year(s), %m month(s), %d day(s), %H hour(s), %i minute(s) and %s second(s)
    //Parâmetros : $ParDataInial, $ParDataFinal
    function GetHoraDuracaoEntreDateTime($ParDataInial, $ParDataFinal) {
        //%y year(s), %m month(s), %d day(s), %H hour(s), %i minute(s) and %s second(s)
        $dataIn = new DateTime($ParDataInial);
        $dataFi = new DateTime($ParDataFinal);
        $DATA_diff = $dataIn->diff($dataFi);
        $this->hour = $DATA_diff->h;
        $this->minute = $DATA_diff->i;
        //{$DATA_diff->y} anos, {$DATA_diff->m} meses,
        return "{$DATA_diff->d} D, {$DATA_diff->h} H, {$DATA_diff->i} M";
    }

    //Parâmetros : $ParDataInial, $ParDataFinal
    function GetDuracaoEntreDateTime($ParDataFinal) {
//        $datatime1 = new DateTime(date('y-m-d H:i:s'));
        $datatime1 = new DateTime(date($this->dataEhora_atual_en()));
        $datatime2 = new DateTime($ParDataFinal);
        $data1 = $datatime1->format('Y-m-d H:i:s');
        $data2 = $datatime2->format('Y-m-d H:i:s');
        $this->diff = $datatime1->diff($datatime2);
       
        return "{$this->diff->d} dias, {$this->diff->h} Horas, {$this->diff->i} minutos";
    }

    function TransformaDataBD_ENEmAno($paramDataBD_EN): int {
        $d = explode("-", $paramDataBD_EN);
//        $dia = $d[2];
//        $mes = $d[1];
        $ano = (int) $d[0];
        return $ano;
    }

    public function addHoraData(int $ptempo): string {
        $dataNew = new DateTime($this->dataEhora_atual_en());
        $dataNew->add(new DateInterval('PT' . $ptempo . 'H'));
        return date_format($dataNew, 'Y-m-d H:i:s');
    }

    public function addMinutoData(int $ptempo): string {
        $dataNew = new DateTime($this->dataEhora_atual_en());
        $dataNew->add(new DateInterval('PT' . $ptempo . 'M'));
        return date_format($dataNew, 'Y-m-d H:i:s');
    }

    public function getDataNew() {
        return $this->dataNew;
    }

    public function getDataDefat() {
        return $this->DataDefat;
    }

    public function getDataDefatPT_BR() {
        return $this->DataDefatPT_BR;
    }

    public function getYears() {
        return $this->years;
    }

    public function getMonth() {
        return $this->month;
    }

    public function getDay() {
        return $this->day;
    }

    public function getHour() {
        return $this->hour;
    }

    public function getMinute() {
        return $this->minute;
    }

    public function getSecond() {
        return $this->second;
    }

    public function getFullTime() {
        return $this->fullTime;
    }

    public function getStnMsg() {
        return $this->stnMsg;
    }

    function getDiff() {
        return $this->diff;
    }

}
