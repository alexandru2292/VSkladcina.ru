<?php

namespace App\Http\Controllers;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

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
    public function StockEdit(){
        $this->content = view(config('settings.theme').'.stockAdd')->with('contentBox')->render();
        return $this->renderOutput();
    }

    /**
     *  Add Title Stock
     */
    public function stockAdd(Request $request){
        $result = $this->stockRepository->create($request);
        return response()->json($result);
    }

    public function stockUpdate(Request $request){
//        return $this->stockRepository->update($request);
    }

    /**
     * Add Paragraph Stock
     */
    public function addParagraph(Request $request){
        $result = $this->stockRepository->createParagraph($request);
        return response()->json($result);
    }
}

