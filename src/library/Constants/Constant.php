<?php

namespace App\library\Constants;

use Phalcon\Mvc\User\Component;

/**
 * Clase para utilizar constantes para to_do el proyecto, utilizar con cautela.
 * eg: $this->Constant->_getDateFormatFull($fecha);
 * @package App\Constants
 */

class Constant extends Component
{

    private $days_full	= array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

    private $days_mini	= array("Dom","Lun","Mar","Mie","Jue","Vie","Sáb");
    private $months_full	= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    private $months_mini	= array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");


	 public function _getDayFull($param) {
        return $this->days_full[$param];
    }


    function _getDayMini($param) {
        return $this->days_mini[$param];
    }

    function _getMonthFull($param) {
        return $this->months_full[$param];
    }

    function _getMonthMini($param) {
        return $this->months_mini[$param];
    }

    function _getDateFormatFull($param){
    	# formateamos la fecha
    	$fecha_format = "{day_full} {day}, {month_full} del {year}";

    	$day_full = $this->_getDayFull((int)date("w", strtotime($param)));
    	$fecha_format = str_replace("{day_full}", $day_full, $fecha_format);

    	$day = date("d", strtotime($param));
    	$fecha_format = str_replace("{day}", $day, $fecha_format);

    	$month = $this->_getMonthFull((int)date("m", strtotime($param)));
    	$fecha_format = str_replace("{month_full}", $month, $fecha_format);

    	$year = date("Y", strtotime($param));
    	$fecha_format = str_replace("{year}", $year, $fecha_format);

    	return $fecha_format;
    }


    function _timeAgo($time_ago)
    {
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "Ahora";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "Hace 1 minuto";
            }
            else{
                return "Hace $minutes minutos";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "Hace 1 hora";
            }else{
                return "Hace $hours hrs";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "Ayer";
            }else{
                return "Hace $days días";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "Hace 1 semana";
            }else{
                return "Hace $weeks semanas";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "Hace 1 mes";
            }else{
                return "Hace $months meses";
            }
        }
        //Years
        else{
            if($years==1){
                return "Hace 1 año";
            }else{
                return "Hace $years Años";
            }
        }
    }

}

?>