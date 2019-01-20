<?php

namespace App\Http\Controllers;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;

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
     * @param Request $request - All dates from Stocks
     *    Add Title, Paragraph, img, youtubeLink and Tags for Stock with AJAX
     * @return \Illuminate\Http\JsonResponse
     */
    public function stockAdd(Request $request){

        $this->stockRepository->addStockName($request) ? $result['name'] = $this->stockRepository->addStockName($request) : '';
        $this->stockRepository->create($request) ? $result['title'] = $this->stockRepository->create($request) : '';
        $this->stockRepository->createParagraph($request) ?  $result['paragraph'] = $this->stockRepository->createParagraph($request) : '';
        $this->stockRepository->addImg($request) ? $result['img'] = $this->stockRepository->addImg($request) : '';
        $this->stockRepository->addYtLink($request) ? $result['ytLink'] = $this->stockRepository->addYtLink($request) : '';
        $this->stockRepository->tags($request) ? $result['tags'] = $this->stockRepository->tags($request) : '';

        return response()->json($result);
    }
    public function store(Request $request){
        dd($request->all());
    }
}

