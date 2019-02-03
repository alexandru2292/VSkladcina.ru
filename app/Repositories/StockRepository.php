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
use App\TmpCkeditorImage;
use DB;
use Auth;
use Image;
use Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Session;
class StockRepository
{
    public function getStocks($stock){

        $stocks = $stock->select('*')->orderBy('id', "DESC")->get();
        $stocks->load('hasType');


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

            /**
             * Calculate the sum price_contribution
             */
            $stocksArr[$key]->price_contribution = (int)$stocksArr[$key]->price_contribution + (int)$stocksArr[$key]->commission_contribution;
            /**
             * Customize the number format : example 8 000
             */
            $stocksArr[$key]->price_contribution = number_format($stocksArr[$key]->price_contribution, false, false, ' ');

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

/**
 * Anulat
 */
//    public function addStockName($request){
//        if($request->name){
//            session(['stockName' => $request->name]);
//            return  $request->name;
//        }
//    }
//
//    public function create($request){
//        if($request->titleVal){
//            session(['textarea_title' => $request->titleVal]);
//            return  $request->titleVal;
//        }
//    }
//
//    public function createParagraph($request){
//        if($request->paragraph){
//            session(['text_paragraph' => $request->paragraph]);
//            return  $request->paragraph;
//        }
//    }
//    public function addImg($request){
//        if($request->hasFile('img') ){ // if exist img file
//            $image = $request->file('img'); // file - image
//            if($image->isValid() ){
//
//                if(filesize($image) <= 5242880){ // 5 MB (converted in Bytes)
//
//                    $str = Auth::user()->id . time();
//                    $obj = new \stdClass;   // $obj - empty object
//                    /**
//                     * Stock img
//                     */
//                    $ext = $image->getClientOriginalExtension();
//
//                    $obj->mini = $str.'_img.jpg';
//                    // Library Image
//
//                    $img = Image::make($image); // obj Image
//                    /**
//                     * If change new image delete old img
//                     */
//                    session()->push('images.name', $str."_img.jpg");
//                    $oldStr =  session('images.name');
//
//                    $lastKey = count($oldStr) -2;
//                    $lastKey  == -1 ? $lastKey = 0 : ''; // if we change photo first time we assign last key first element from session array
////                    dd($oldStr);
//                    $lastStr = $oldStr[$lastKey]; // select first elemtn from session array
//
////                    if (file_exists(public_path()."/img/content/cards/". $lastStr)){
////                        unlink(public_path()."/img/content/cards/". $lastStr);
////                    }
//                    /**
//                     * Move img to folder
//                     */
//                    $img->fit(config('settings.stockImg')['width'],       //folder public                                       name img mini
//                        config('settings.stockImg')['height'])->save('img/content/cards/'.$obj->mini);
//                    $imgName = $obj->mini;
//                    /**
//                     * Save in session img
//                     */
//                    session(['showImg'=> $imgName]);
//                    return $imgName;
//                }else{
//                    return ['error' => "Максимальный размер файла не должен превышать 5 МБ"];
//                }
//
//            }
//        }
//    }
/**
*  /Anulat
*/

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

//                    if (file_exists(public_path()."/img/content/cards/". $lastStr)){
//                        unlink(public_path()."/img/content/cards/". $lastStr);
//                    }
                    /**
                     * Move img to folder
                     */
                    $img->fit(config('settings.stockImgMin')['width'],       //folder public                                       name img mini
                        config('settings.stockImgMin')['height'])->save('img/content/cards/'.$obj->mini);
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
    public function allFormData($request, $stock){
        /**
         * if the request does not contain all fields of the form return false;
         */

        if(count($request->all()) < 5){
            return false;
        }

        /**
         * Get user role
         */
        $userRole = Auth::user()->role_user->load('role')->role->alias;

        /**
         * Get all data the form
         */
        $data = $request->except('_token');


        /**
         * Set integer number  for price_contribution
         */
        $data['price_contribution'] = (int)str_replace(' ', '', $data['price_contribution']);

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
            'price_contribution.integer' => 'Поле "взнос(цена)" должно быть целым числом.',
            'subtitle.required' => 'Поле "абзац" обязательно для заполнения',
            'youtube_link.required' => 'Поле "видео" обязательно для заполнения',
            'min_count.required' => 'Поле "минимальное количество" обязательно для заполнения',
            'commission_contribution.required' => 'Поле "Взнос (комиссия)" обязательно для заполнения',
            'commission_contribution.integer' => 'Поле "Взнос (комиссия)"  должно быть целым числом.',
            "min_count.integer" => "Поле \"Минимальное количество\" должно быть целым числом."

        ];
        /**
         * Set validation rules
         */
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'subtitle' => 'required',
           /* 'title' => 'required',
            'big_img' => 'required',*/
            'min_img' => 'required',
            'tags' => 'required',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'price_contribution' => 'required|integer',
            'commission_contribution' => 'required|integer',
            'delivery' => 'required',
//            'youtube_link' =>  $data['type_id'] == 2 ? 'required' : '',
            'min_count' => 'required|integer',
            'date_collection' => 'required'
        ], $messages);

        if ($validator->fails()) {
            $result['errors'] = $validator->errors();
            return $result;
        }


        /** ------------------
         * SAVE IN DATABASE
         * -------------------
         */

        $data['delivery'] = implode(', ', $data['delivery']);


        isset($userRole) && $userRole == "Admin" ? $data['status'] = "is_open":"";
        isset($userRole) && $userRole == "Moderator" ? $data['status'] = "is_open" : "";
        isset($userRole) && $userRole == "Admin" ? $data['star'] = 5 : "";
        isset($userRole) && $userRole == "Moderator" ? $data['star'] = 5 : "";

        if(  isset($userRole) &&  $userRole != "Admin" && $userRole != "Moderator"){
            $data['status'] = 'moderation';
            $data['star'] = 0;
        }




        $stock->fill($data);
        $stockAdded = $stock->save($data);

        if($stockAdded){
            /**
             * Delete data from right form
             */
            \Session::forget('stockName');
            \Session::forget('textarea_title');
            \Session::forget('text_paragraph');
            \Session::forget('showImg');
            \Session::forget('showImgMin');

            /**
             * change the successful message depending on which (care) user has added a stock ( the logical code is in the file MyScript.js)
             */
            isset($userRole) && $userRole === "Admin" ? $result['successAdmin'] = 1 : '';
            isset($userRole) && $userRole === "Moderator" ? $result['successModerator'] = 1 : '';
            $result['success'] = 1;
        }
        return $result;
    }

    /**
     * @param $stock - The model Stock
     * @return mixed - all stocks where status == moderation
     */
    public function getModerationStocks($stock){
        $stocks = $stock->orderBy('id', 'DESC')->where('status', 'moderation')->get();
        return $stocks;
    }

    /**
     * Get the dates stock for page card
     */
    public function getCard($stock, $id){

       $stock = $stock->where('id', $id)->first();

        /**
         * Make the foreign key relations
         */
       $stock->load('hasType', 'hasCategory', 'hasSubcategory', 'hasUser', 'hasManyFollowers');
        /**
         * get Customized date format
         */
        $date_collection = Tool::getCustomDateFormat($stock->date_collection, 'd.m.Y');
        $stock->date_collection = $date_collection;

        /**
         * Calculate the sum price_contribution
         */
        $stock->price_contribution = (int)$stock->price_contribution + (int)$stock->commission_contribution;
        /**
         * Customize the number format : example 8 000
         */
        $stock->price_contribution =   number_format($stock->price_contribution, false, false, ' ');

        /**
         * set tags
         */
        $stock->tags = explode(', ', $stock->tags);
        $a = [];
        foreach ($stock->tags as $tag){
            $a[] = '<a href="#">'.$tag.'</a>';
        }
        $stock->tags  = implode(', ', $a);

        /**
         * set relation with followers
         */
        foreach ($stock->hasManyFollowers as $follower){
            $follower->load("hasUser");
        }
        $stock->countFollowers =  count($stock->hasManyFollowers);
        dd($stock);
        return $stock;
    }


    public function uploadImageContent($request)
    {
        if ($request->hasFile('upload')){
            //        dd($request->all());

            /**
             * If don't errors to validation then move the image on destination path
             */
            $file = $request->file('upload');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            /**
             * If file type is Video
             */

           if($extension == "mp4" || $extension == "WebM" || $extension == "Ogv"){
               /**
                * Validate video file
                */
               $validator =  Validator::make($request->all(), [
                   'upload' => 'mimes:mp4,WebM,Ogv|max:262144',
               ]);
               /**
                * If we have errors to validation  need to alert on page
                */
               if ($validator->fails()) {
                   $message = $validator->errors();
                   $funcNum = Input::get('CKEditorFuncNum');
                   echo '<script>window.parent.CKEDITOR.tools.callFunction("'.$funcNum.'", "Фаил слишком большой", "'.$message->first().'")</script>';
                   return false;
               }
               $this->moveStoreEchoFile($filename, "/video/", $request);
               return false;
           }

            /**
             * If file type is IMAGE
             */
           if($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "gif"){
               /**
                * Validate image file
                */
               $validator =  Validator::make($request->all(), [
                   'upload' => 'image|mimes:jpeg,jpg,png,gif|max:5120',
               ]);
               /**
                * If we have errors to validation  need to alert on page
                */
               if ($validator->fails()) {
                   $message = $validator->errors();
                   $funcNum = Input::get('CKEditorFuncNum');
                   echo '<script>window.parent.CKEDITOR.tools.callFunction("'.$funcNum.'", "Фаил слишком большой", "'.$message->first().'")</script>';
                   return false;
               }
               $this->moveStoreEchoFile($filename, "/img/content/cards/", $request);
               return false;
           }
            $funcNum = Input::get('CKEditorFuncNum');
            echo '<script>window.parent.CKEDITOR.tools.callFunction("'.$funcNum.'", "", "Система не подержывает этот фаил")</script>';
        }
    }


    /** Save  name in DB
     *  Move in image/video map
     *  Echo - in link input on Ckeditor
     * @param $filename
     * @param $filePath
     * @param $request - file from CKEDITOR
     * @return bool
     */
    public function moveStoreEchoFile($filename, $filePath, $request){

        /**
         * create new name file if exist original name
         */
        if (file_exists(public_path($filePath) . $filename)) {
            $filename = Carbon::now()->timestamp . '.' . $filename;
        }
        $file = $request->file('upload');
        $file->move(public_path() . $filePath, $filename);
        /**
         * Save  in DB the name of the image added from CKEDITOR that(ca) we later delete them(pe ele) from the map
         */
        DB::table('tmp_ckeditor_images')->insert(
            ['name' => $filename]
        );
        $url = $filePath . $filename;
        $url = url($url);
        $funcNum = Input::get('CKEditorFuncNum');
        echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "")</script>';
    }
}

