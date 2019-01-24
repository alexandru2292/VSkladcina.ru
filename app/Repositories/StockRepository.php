<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 1/3/19
 * Time: 11:15 PM
 */

namespace App\Repositories;
use App\Category;
use App\Stock;
use DB;
use Auth;
use Image;
use Validator;
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

    /**
     * Get all categories, subcategories and types stocks
     */
    public function getCategorySubCatTypes($categorys, $subcategorys, $types){
        $categories = $categorys->all();
        $subcategories = $subcategorys->all();
        $types = $types->all();

        $data['categories'] = $categories;
        $data['subcategories'] = $subcategories;
        $data['types'] = $types;
        return $data;

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
                    $lastKey  == -1 ? $lastKey = 0 : ''; // if we change photo first time we assign last key first element from session array
//                    dd($oldStr);
                    $lastStr = $oldStr[$lastKey]; // select first elemtn from session array

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
    public function addImgMin($request){

//        dd($request->all());

        if($request->hasFile('img_min') ){ // if exist img file
            $image = $request->file('img_min'); // file - image
            if($image->isValid() ){

                if(filesize($image) <= 5242880){ // 5 MB (converted in Bytes)
                    $str = Auth::user()->id . time();
                    $obj = new \stdClass;   // $obj - empty object
                    /**
                     * Stock img
                     */
                    $obj->mini = $str.'_img_min.jpg';
                    // Library Image

                    $img = Image::make($image); // obj Image
                    /**
                     * If change new image delete old img
                     */
                    session()->push('images.name_min', $str."_img_min.jpg");
                    $oldStr =  session('images.name_min');

                    $lastKey = count($oldStr) -2;
                    $lastKey  == -1 ? $lastKey = 0 : ''; // if we change photo first time we assign last key first element from session array

                    $lastStr = $oldStr[$lastKey]; // select first elemtn from session array

                    if (file_exists(public_path()."/img/content/". $lastStr)){
                        unlink(public_path()."/img/content/". $lastStr);
                    }
                    /**
                     * Move img to folder
                     */
                    $img->fit(config('settings.stockImgMin')['width'],       //folder public                                       name img mini
                        config('settings.stockImgMin')['height'])->save('img/content/'.$obj->mini);
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

    /**
     * @param $request -> all data Stocks for add in BD
     * @return mixed
     */
    public function allFormData($request){
        /**
         * if the request does not contain all fields of the form return false;
         */
        if(count($request->all()) < 5){
            return false;
        }

        /**
         * Get all data the form
         */
        $data = $request->all();
//        dd($data);
        /**
         * set column name for add values in BD
         */
        isset($data['min_imghidden']) ? $min_img = $data['min_imghidden'] : $min_img = '';
        $data['min_img'] = $min_img;
        if(isset($data['min_imghidden'])) unset($data['min_imghidden']);
        /**
         * Set error messages
         */
        $messages = [
            'delivery.required' => 'Выберите службы доставки',
            'date_collection.required' => 'Выберите дата сбора',
            'big_img.required' => 'Выберите изображение',
            'min_img.required' => 'Выберите изображение',
            'tags.required' => 'Поле теги обязательно для заполнения',
            'category_id.required' => 'Выберите категорию',
            'type_id.required' => 'Выберите тип',
            'price_contribution.required' => 'Выберите взнос(цена)',
            'commission_contribution.required' => 'Выберите взнос(комиссия)',
            'subtitle.required' => 'Поле абзац обязательно для заполнения',

        ];
        /**
         * Set validation rules
         */
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'subtitle' => 'required',
            'big_img' => 'required',
            'min_img' => 'required',
            'tags' => 'required',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'price_contribution' => 'required',
            'commission_contribution' => 'required',
            'delivery' => 'required'
        ], $messages);

        if ($validator->fails()) {

            $result['errors'] = $validator->errors();
            return $result;
        }


        /** ------------------
         * SAVE IN DATABASE
         * -------------------
         */
        $result['success'] = 1;

        return $result;
    }
}

