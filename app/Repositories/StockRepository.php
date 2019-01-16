<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 1/3/19
 * Time: 11:15 PM
 */

namespace App\Repositories;
use App\Stock;
use DB;
class StockRepository
{
    public function getStocks(){
        $stocks = DB::table("stocks")->orderBy('id', 'DESC')->get();

        /**
         * Get day,  name month and year created stocks.  EXAMPLE : 02 января 2019
         */
        $stocksArr = [];
        foreach ($stocks as $key => $stock){
            $stocksArr = $stocks;
            /**
             * Get day
             */
            $dateEvent = \Carbon\Carbon::parse($stock->created_at);
            $stocksArr[$key]->day =  $dateEvent->format('d');
            /**
             * get name month
             */
            $stocksArr[$key]->month  = $this->getNameMonth($stock->created_at);

            /**
             * get year
             */
            $stocksArr[$key]->year =  $dateEvent->format('Y');

            /**
             * create the stars block of the block stocks
             */
            $starsView = "";
            for ($active = 1; $active <= 5; $active++)
                if ($active <= $stock->star) {

                    $starsView .= " <div class=\"star-item star-item--active\" ><svg class=\"icon icon-star\" ><use xlink:href = \"img/icons.svg#icon-star\" /></svg></div > ";
                } else {
                    $starsView .= " <div class=\"star-item\" ><svg class=\"icon icon-star\" ><use xlink:href = \"img/icons.svg#icon-star\" /></svg></div >";
                }
            $stocksArr[$key]->starsView = $starsView;
        }
        return $stocksArr;
    }

    public function getNameMonth($date){
        $dateEvent = \Carbon\Carbon::parse($date);
//        $data =  $dateEvent->format('Y-m-d');
        $mounth =  $dateEvent->format('m');
        switch ($mounth) {
            case 01 :
                return "января";
                break;
            case 02 :
                return 'февраля';
                break;
            case 03 :
                return 'марта';
                break;
            case 04:
                return 'апреля';
                break;
            case 05 :
                return 'мая';
                break;
            case 06 :
                return 'июня';
                break;
            case 07 :
                return 'июля';
                break;
            case "08" :
                return 'августа';
                break;
            case "09" :
                return 'сентября';
                break;
            case 10 :
                return 'октября ';
                break;
            case 11 :
                return 'ноября';
                break;
            case 12 :
                return'декабря';
                break;

        }

    }


    public function create($request){
        session(['textarea_title' => $request->titleVal]);
        return $data['title'] = $request->titleVal;
    }

    public function createParagraph($request){
        session(['text_paragraph' => $request->paragraph]);
        return $data['paragraph'] = $request->paragraph;
    }
    public function update($request){

    }
}

