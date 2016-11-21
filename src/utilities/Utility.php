<?php

namespace App\Utilities;
use App\library\Constants\Constant;

/**
 * Created by PhpStorm.
 * User: jasilva
 * Date: 14/09/2016
 * Time: 12:59
 */


/**
 * Clase para guardar metodos para la vista para usar con volt
 * eg: {{ utility._strtotime('parametros_aqui') }}
 * Class Utility
 * @package App\Utilities
 */
class Utility
{

    function _strtotime($param) {
        return strtotime($param);
    }


    function _split($param) {
        return str_split($param);
    }

    function getItem($array, $indexx, $indexy) {

    	if(isset($array[$indexx][$indexy]))
    		return $array[$indexx][$indexy];
    	else
    		return false;
    }

    function _getDateFormatFull($fecha) {
        $constant = new Constant();
        return $constant->_getDateFormatFull($fecha);
    }

    function _timeAgo($fecha) {
        $constant = new Constant();
        $fecha = date("Y-m-d H:i:s", strtotime($fecha));

        return $constant->_timeAgo($fecha);
    }

    function _getDayFull($numberoofweek){
        $constant = new Constant();
        return $constant->_getDayFull($numberoofweek);
    }

    function _getDayMini($numberoofweek){
        $constant = new Constant();
        return $constant->_getDayMini($numberoofweek);
    }

    function _replace($coincidencia, $reemplazo, $string){
        return str_replace($coincidencia, $reemplazo, $string);
    }

    function _number_format($number) {
        if(is_numeric($number))
            return number_format($number , 0, ',', '.');
        else
            return "-";
    }
}