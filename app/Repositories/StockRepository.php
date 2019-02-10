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
use App\Follower;
class StockRepository
{
    protected $stockCategory;
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
                    if($request->old_img){
                      if (file_exists(public_path()."/img/content/cards/". $request->old_img)){
                            unlink(public_path()."/img/content/cards/". $request->old_img);
                        }
                    }

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
        if($userRole == "Admin" || $userRole == "Moderator"){

            /**
             * Get all data the form
             */
            $data = $request->except('_token');


            /**
             * Set integer number  for price_contribution
             */
            $data['price_contribution'] = (int)str_replace(' ', '', $data['price_contribution']);

            /**
             * set column min_img for add values in BD and check if textarea #stockInfo isset
             */

            isset($data['min_imghidden']) ? $min_img = $data['min_imghidden'] : $min_img = '';
            $data['min_img'] = $min_img;
            if(isset($data['min_imghidden'])) unset($data['min_imghidden']);

            /**
             * check if completed textarea #stockInfo
             */

            if($data['description'] == "<p>Напишите что-нибудь</p>"){
                $data['description'] = '';
            }
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
                'date_collection' => 'required',
                'description' => 'required'
            ], $messages);

            if ($validator->fails()) {
                $result['errors'] = $validator->errors();
                return $result;
            }

            // dd($data);

            /** ------------------
             * SAVE IN DATABASE
             * -------------------
             */

            $data['delivery'] = implode(', ', $data['delivery']);


            isset($userRole) && $userRole == "Admin" ? $data['status'] = "is_open":"";
            isset($userRole) && $userRole == "Admin" ? $data['star'] = 5 : "";


            if(  isset($userRole) &&  $userRole != "Admin"){
                $data['status'] = 'moderation';
                $data['star'] = 0;
            }
            /**
             * Check count imgs who we  need to  save in DB , if we selected more imgs and after we is canceled them(pe ele), now(acum) we need  deleted their
             */

            $explodeImg =  explode('/content/', $data['description']);
            /** set array with card img-s
             *  dd($explodeImg); =  array{ 0 => cards/b_0c1ec9c9709948ca0d01b8262c52ab9d.jpg" style=..., 1 => cards/b_0c1ec9c9709948ca0d01b8262c52ab9d.jpg" style=...
             */
            $poz =   strpos($explodeImg[0], 'cards/');
            if($poz === false){
                unset($explodeImg[0]);
            }

            $explodeImg = implode(', ', $explodeImg);
            $explodeImg = explode(' ', $explodeImg);
            /**
             * Select only images elements
             */
            foreach ($explodeImg as $key => $item){
                if (strpos($explodeImg[$key], 'cards/') === false){
                    unset($explodeImg[$key]);
                }
            }
            /**
             * delete  last space and " from name images)
             */

            $explodeImg = implode($explodeImg, ' ');
            $imagesForStore = explode('cards/', $explodeImg);

            foreach ($imagesForStore as $k =>  $item){
                $imagesForStore[$k] = str_replace(' ', '', $imagesForStore[$k]);
                $imagesForStore[$k] = str_replace('"', '', $imagesForStore[$k]);
                if (!$imagesForStore[$k]){
                    unset($imagesForStore[$k]);
                }
            }
            /**
             * we getting one array with the images name
             * Next - we need delete all images which don't save in the added stock (excepted images from $imagesForStore)
             */
            $delImgFromFolder = TmpCkeditorImage::whereNotIn('name', $imagesForStore)->get();
            /**
             * Delete img-s from folder which we canceled in CKeditor
             */

            foreach ($delImgFromFolder as $item){
                if (file_exists(public_path()."/img/content/cards/". $item->name)){
                    unlink(public_path()."/img/content/cards/". $item->name);
                }
            }
            TmpCkeditorImage::select("*")->delete();


            /**
             * Store the stock values
             */
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
        } else{
            return ['useRights' => 'У вас нет прав модератора или администратора'];
        }
    }

    /**
     * @param $stock - The model Stock
     * @return mixed - all stocks where status == moderation
     */
    public function getModerationStocks($stock){
        if(Auth::check()){
            $userRole = Auth::user()->load("role_user")->role_user->load("role")->role->alias;
            if($userRole == "Admin"){
              $stocks = $stock->orderBy('id', 'DESC')->where('status', 'moderation')->get();
              return $stocks;
            }else{
             return abort(404);
            }
        }else{
            return abort(404);
        }
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
            str_replace(' ', '', $filename);
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

    /** Check if logged user is following this stock
     * @param $stock_id - this is id stock which user is following
     * @return mixed
     */
    public function hasFollower($stock_id){
        if(Auth::user()){
            $hasFollower =  Follower::where([['stock_id', $stock_id], ['user_id', '=', Auth::user()->id]])->first();
            if($hasFollower === null){
                return $hasFollower;
            }else{
                $hasFollower->hasFollower =1;
                return $hasFollower;
            }
        }else{
            return false;
        }

    }

    /**
     * @param $request - dates from status form
     * @param $stock - the stock from getting relations creator's stock
     * @param $message - the message for creator's stock
     * @return \Illuminate\Http\JsonResponse - success message
     */
    public function updateStatus($request, $stock, $message, $notification){

        if($request->status == "on_editing" || $request->status == "is_open" || $request->status == "moderation"){

            $stock = $stock->where('id', $request->stock_id)->first();
            $stock->load("hasUser", "hasManyFollowers", "hasCategory");
            $stock->status = $request->status;
            $toCreatorStock = $stock->user_id;
            /**
             * Get current logged user for to indicate who sent the message or the notification
             */
            $sender = Auth::user()->id;

            /**
             * After save the status we send message and notification
             */
            if($stock->save()){


                /**
                 *
                 * the system sends a NOTIFICATION to the stock category followers
                 */ if($request->status == "is_open"){

                    $notificationMsg  =  config('settings.notificationMessage.is_open');

                    /**
                     * get users who are subscribed to the stock category
                     */
                    $this->stockCategory  =  $stock->hasCategory->alias;
                    $stocks = Stock::with('hasCategory', 'hasManyFollowers')->whereHas('hasCategory', function ($query) {
                        $query->where('alias', "$this->stockCategory");
                    })->get();

                    $data = [];
                    foreach ($stocks as $stock){
                        foreach ($stock->hasManyFollowers as $key =>  $follower){
                            /**
                             * if the admin is subscribed to a stock then(atunci) we do not send a notification
                             */
                            if($follower->user_id != $sender){
                                $data[$key]['user_id'] = $follower->user_id;
                                $data[$key]['notification'] = $notificationMsg;
                                $data[$key]['sender_user_id'] = $sender;
                            }
                        }
                    }

                    $ntfSends = $notification->insert($data);
                    if (!$ntfSends){
                        return response()->json(['success' => 0, 'successMsg' => 'Ошибка при отправления уведомления ']);
                    }
                }

                /**
                 *
                 * the system sends a MESSAGE to the stock creator
                 */
                if($request->status == "is_open" || $request->status == "on_editing"){
                    //send  message about status stock -   to user  $stock->hasUser->id
                    $statusMsg = '';
                    if($request->status == "is_open" ){$statusMsg  =  config('settings.statusMessage.is_open');}
                    if($request->status == "on_editing"){$statusMsg = $request->message;}

                    /**
                     * prepare data
                     */
                    $message->user_id = $toCreatorStock;
                    $message->message = $statusMsg;
                    $message->sender_user_id = $sender;
                    if ($message->save()){
                        return response()->json(['success' => 1, 'successMsg' => 'Сообщение  успешно отправлено']);
                    }else{
                        return response()->json(['success' => 0, 'successMsg' => 'Ошибка при отправления сообщения']);
                    }
                }
            }else{
                return response()->json(['success' => 0, 'successMsg' => 'Ошибка при ияменения статуса']);
            }
        }
    }
}

