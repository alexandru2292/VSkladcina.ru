<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 1/31/19
 * Time: 10:18 AM
 */

namespace App\Repositories;


class Tool
{
    public static function getCustomDateFormat($date, $format)
    {
        $dateEvent = \Carbon\Carbon::parse($date);

        /**
         * set customizer format date
         */
        if(isset($format)){
            $result['format'] = $dateEvent->format($format);
        }
        /**
         * set day (number)
         */
        $day =  $dateEvent->format('d');
        $result['d'] = $day;

        /**
         * set name month
         */
        $mounth = $dateEvent->format('m');
        switch ($mounth) {
            case 01 :
                 $result['m'] ="января";
                break;
            case 02 :
                 $result['m'] ='февраля';
                break;
            case 03 :
                 $result['m'] ='марта';
                break;
            case 04:
                 $result['m'] ='апреля';
                break;
            case 05 :
                 $result['m'] = 'мая';
                break;
            case 06 :
                 $result['m'] ='июня';
                break;
            case 07 :
                 $result['m'] ='июля';
                break;
            case "08" :
                 $result['m'] ='августа';
                break;
            case "09" :
                 $result['m'] ='сентября';
                break;
            case 10 :
                 $result['m'] ='октября ';
                break;
            case 11 :
                 $result['m'] ='ноября';
                break;
            case 12 :
                 $result['m'] ='декабря';
                break;
        }

        /**
         * set year (number)
         */
        $year =  $dateEvent->format('Y');

        $result['Y'] = $year;

        return $result;
    }
}