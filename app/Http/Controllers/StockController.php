<?php

namespace App\Http\Controllers;
use App\Repositories\StockRepository;
use App\Subcategory;
use App\Type;
use Illuminate\Http\Request;
use App\Category;
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
    public function index()
    {
        $stocks = $this->stockRepository->getStocks();
        $this->content = view(config('settings.theme').'.contentIndex')->with(['stocks' =>  $stocks])->render();
        return $this->renderOutput();
    }

    /**
     * Show template for added stock
     */
    public function StockEdit(Category $categorys, Subcategory $subcategorys, Type $types){
        /**
         * Get all categories, subcategories and types stocks
         */
        $CatSubTypes =  $this->stockRepository->getCategorySubCatTypes($categorys, $subcategorys, $types);
        $this->content = view(config('settings.theme').'.stockAdd')->with('catSubTypes', $CatSubTypes)->render();
        return $this->renderOutput();
    }

    /**
     * @param Request $request - All dates from Stocks
     *    Add Title, Paragraph, img, youtubeLink and Tags for Stock with AJAX
     * @return \Illuminate\Http\JsonResponse
     */
    public function stockAdd(Request $request){

        $this->stockRepository->addStockName($request) ? $result['name'] = $this->stockRepository->addStockName($request) : '';
        $this->stockRepository->create($request) ? $result['title'] = $this->stockRepository->create($request) : '';
        $this->stockRepository->createParagraph($request) ?  $result['paragraph'] = $this->stockRepository->createParagraph($request) : '';
        $this->stockRepository->addImg($request) ? $result['img'] = $this->stockRepository->addImg($request) : '';
        $this->stockRepository->addImgMin($request) ? $result['img_min'] = $this->stockRepository->addImgMin($request) : '';
        $this->stockRepository->addYtLink($request) ? $result['ytLink'] = $this->stockRepository->addYtLink($request) : '';
        $this->stockRepository->tags($request) ? $result['tags'] = $this->stockRepository->tags($request) : '';
        /**
         * all data from stockForm
         */
        $this->stockRepository->allFormData($request) ? $result = $this->stockRepository->allFormData($request) : '';

        return response()->json($result);
    }

    /**
     * @param Request $request - stock Name with null value from deleted session
     */
    public function rmSessName(Request $request){
        if(!$request->stockName){
            \Session::forget('stockName');
        }

        return response()->json(['success'=> 1]);
    }
    /**
     * @param Request $request - stock Title with null value from deleted session
     */
    public function rmSessTitle(Request $request){
        if(!$request->stockTitle){
            \Session::forget('textarea_title');
        }
        return response()->json(['success'=> 1]);
    }
    /**
     * @param Request $request - stock Paragraph with null value from deleted session
     */
    public function rmSessParagraph(Request $request){
        if(!$request->stockParagraph){
            \Session::forget('text_paragraph');
        }
        return response()->json(['success'=> 1]);
    }
    /**
     * @param Request $request - stock Paragraph with null value from deleted session
     */
    public function rmSessYtLink(Request $request){
        if(!$request->link){
            \Session::forget('textareaYtLink');
        }
        return response()->json(['success'=> 1]);
    }
   /**
     * @param Request $request - stock Tags with null value from deleted session
     */
    public function rmSessTags(Request $request){
        if(!$request->stockTags){
            \Session::forget('stockTags');
        }
        return response()->json(['success'=> 1]);
    }
    public function store(Request $request){
//        dd($request->all());
    }
}

