<?php

namespace App\Http\Controllers;
use App\Follower;
use App\Message;
use App\Notification;
use App\Repositories\StockRepository;
use App\Stock;
use App\Subcategory;
use App\Type;
use Illuminate\Http\Request;
use App\Category;
use Auth;
class StockController extends SiteController
{
    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->template = config('settings.theme').'.index';
    }

    /**
     * Return all stocks with main page
     */
    public function index(Stock $stock)
    {
        $stocks = $this->stockRepository->getStocks($stock, 0);
        $this->content = view(config('settings.theme').'.contentIndex')->with(['stocks' =>  $stocks])->render();
        return $this->renderOutput();
    }

    /**
     * Show template for added stock
     */
    public function StockEdit(Category $categorys, Subcategory $subcategorys, Type $types, $id = null){

         $userRole = Auth::user()->load("role_user")->role_user->load("role")->role->alias;
          if($userRole == "Admin" || $userRole == "Moderator"){
              /**
               * Get all categories, subcategories and types stocks
               */
              $CatSubTypes = $this->stockRepository->getCategorySubCatTypes($categorys, $subcategorys, $types);
              /**
               * Get the stock for editing
               */
              $stock = $this->stockRepository->getStockForEditing($id);
//              dd($stock);
              $this->content = view(config('settings.theme').'.stockAdd')->with(['catSubTypes'=> $CatSubTypes, 'stock' => $stock])->render();
              return $this->renderOutput();
          }else{

              return abort(404);
          }
    }

    /**
     * @param Request $request - All dates from Stocks
     *    Add Title, Paragraph, img, youtubeLink and Tags for Stock with AJAX
     * @return \Illuminate\Http\JsonResponse
     */
    public function stockAdd(Request $request, Stock $stock){
/**
 * Anulat
 */
//        $this->stockRepository->addStockName($request) ? $result['name'] = $this->stockRepository->addStockName($request) : '';
//        $this->stockRepository->create($request) ? $result['title'] = $this->stockRepository->create($request) : '';
//        $this->stockRepository->createParagraph($request) ?  $result['paragraph'] = $this->stockRepository->createParagraph($request) : '';
//        $this->stockRepository->addImg($request) ? $result['img'] = $this->stockRepository->addImg($request) : '';
//        $this->stockRepository->addYtLink($request) ? $result['ytLink'] = $this->stockRepository->addYtLink($request) : '';
/**
 * /Anulat
 */
        $this->stockRepository->addImgMin($request) ? $result['img_min'] = $this->stockRepository->addImgMin($request) : '';
        $this->stockRepository->tags($request) ? $result['tags'] = $this->stockRepository->tags($request) : '';
        /**
         * all data from stockForm
         */
        $this->stockRepository->allFormData($request, $stock, 'add') ? $result = $this->stockRepository->allFormData($request, $stock, 'add') : '';

        return response()->json($result);
    }

    /**
     * @param Request $request - image from ckEditor ('stockInfo')
     */
    public function addImgWithCkeditor(Request $request){
        //Add img from CKEDITOR
        if($request->upload){
            $this->stockRepository->uploadImageContent($request);
        }
    }
//    /**
//     *  Request $request - stock Name with null value from deleted session
//     */
//    public function rmSessName(Request $request){
//        if(!$request->stockName){
//            \Session::forget('stockName');
//        }
//
//        return response()->json(['success'=> 1]);
//    }
//    /**
//     *  Request $request - stock Title with null value from deleted session
//     */
//    public function rmSessTitle(Request $request){
//        if(!$request->stockTitle){
//            \Session::forget('textarea_title');
//        }
//        return response()->json(['success'=> 1]);
//    }
//    /**
//     *  Request $request - stock Paragraph with null value from deleted session
//     */
//    public function rmSessParagraph(Request $request){
//        if(!$request->stockParagraph){
//            \Session::forget('text_paragraph');
//        }
//        return response()->json(['success'=> 1]);
//    }
//    /**
//     *  Request $request - stock Paragraph with null value from deleted session
//     */
//    public function rmSessYtLink(Request $request){
//        if(!$request->link){
//            \Session::forget('textareaYtLink');
//        }
//        return response()->json(['success'=> 1]);
//    }
//   /**
//     *  Request $request - stock Tags with null value from deleted session
//     */
//    public function rmSessTags(Request $request){
//        if(!$request->stockTags){
//            \Session::forget('stockTags');
//        }
//        return response()->json(['success'=> 1]);
//    }

    /**
     * Show the page stock with content
     */
    public function showCard(Stock $stock, $id,$allStatus = null){

        $card = $this->stockRepository->getCard($stock, $id, $allStatus);
        $follower = $this->stockRepository->hasFollower($id);
        $this->content = view(config('settings.theme').'.contentCard')->with(["stock" => $card, 'hasFollower' => $follower ])->render();
        return $this->renderOutput();
    }

    /**
     * Show all stocks where status == moderation for Admin or Moderator change the status on Published
     */
    public function showModerationStocks(Stock $stock){
         $stocks = $this->stockRepository->getModerationStocks($stock);
         $this->content = view(config('settings.theme').'.contentIndex')->with(['stocks' =>  $stocks,'viewStatus' => 'moderation'])->render();
         return $this->renderOutput();
    }
    /**   $stock = $stock->where([['id', '=', $id], ['status', '!=', 'on_editing']])->first();
     * Edit the stock status
     */
    public function editStatus(Request $request, Stock $stock, Message $message, Notification $notification){
        return  $this->stockRepository->updateStatus($request, $stock, $message, $notification);
    }
    /**
     * get stocks from followers where user_id = logged user
     */
    public function getMyStocks(){
        $myStocks = $this->stockRepository->selectMyStocks();
        $this->content = view(config('settings.theme').'.myStocks')->with(['myStocks' =>  $myStocks])->render();
        return $this->renderOutput();
    }
    /**
     * Get the stocks with status on_editing
     */
    public function getOnEditing(){
        $myStocks = $this->stockRepository->getStocksWithOnEditingStatus();
        $this->content = view(config('settings.theme').'.onEditing')->with(['myStocks' =>  $myStocks])->render();
        return $this->renderOutput();
    }

    /**
     * Update the stock
     */
    public function stockUpdate(Request $request){
        $res =  $this->stockRepository->updateTheStock($request);
        return response()->json($res);
    }
}

