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
use Auth;
use Image;
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

    /**
     * @param $request
     */
    public function addStockName($request){
        if($request->name){
            session(['stockName' => $request->name]);
            return  $request->name;
        }
    }

    public function create($request){
        if($request->titleVal){
            session(['textarea_title' => $request->titleVal]);
            return  $request->titleVal;
        }
    }

    public function createParagraph($request){
        if($request->paragraph){
            session(['text_paragraph' => $request->paragraph]);
            return  $request->paragraph;
        }
    }
    public function addImg($request){
        if($request->hasFile('img') ){ // if exist img file
            $image = $request->file('img'); // file - image
            if($image->isValid() ){

                if(filesize($image) <= 5242880){ // 5 MB (converted in Bytes)

                    $str = Auth::user()->id . time();
                    $obj = new \stdClass;   // $obj - empty object
                    /**
                     * Stock img
                     */
                    $ext = $image->getClientOriginalExtension();

                    $obj->mini = $str.'_img.jpg';
                    // Library Image

                    $img = Image::make($image); // obj Image
                    /**
                     * If change new image delete old img
                     */
                    session()->push('images.name', $str."_img.jpg");
                    $oldStr =  session('images.name');
                    $lastKey = count($oldStr) -2;
                    $lastStr = $oldStr[$lastKey];
                    if (file_exists(public_path()."/img/content/". $lastStr)){
                        unlink(public_path()."/img/content/". $lastStr);
                    }
                    /**
                     * Move img to folder
                     */
                    $img->fit(config('settings.stockImg')['width'],       //folder public                                       name img mini
                        config('settings.stockImg')['height'])->save('img/content/'.$obj->mini);
                    $imgName = $obj->mini;
                    /**
                     * Save in session img
                     */
                    session(['showImg'=> $imgName]);
                    return $imgName;
                }else{
                    return ['error' => "Максимальный размер файла не должен превышать 5 МБ"];
                }

            }
        }
    }


    /**
     *  $request - from textarea youtube link
     */
    public function addYtLink($request){
        if($request->link){
            session(['textareaYtLink' => $request->link]);
            return  $request->link;
        }
    }

    /**
     * add tags for stock
     */
    public function tags($request){
       if($request->tags){
           session(['stockTags' => $request->tags]);
           return  $request->tags;
       }
    }
}

