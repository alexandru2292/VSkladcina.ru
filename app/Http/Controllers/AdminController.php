<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Stock;
use App\Repositories\StockRepository;
class AdminController extends SiteController
{
    public function __construct(StockRepository $stockRepository){
        $this->stockRepository = $stockRepository;
        $this->template = config('settings.theme').'.admin.index';
    }
    public function index(Stock $stock){
        $stocks = $this->stockRepository->getStocks($stock, 1);

        $this->content = view(config('settings.theme').'.admin.contentIndex')->with('stocks', $stocks)->render();
        return $this->renderOutputAdmin();
    }

    /** Delete the stock for admin url('/')
     * @param $id - stock id
     * @return \Illuminate\Http\JsonResponse - response to admin/myScripts.js > $("#confirm-msg-delete").on("click",....
     */
    public function deleteStock($id){

        $res =  $this->stockRepository->removeTheStock($id);
        if($res){
            return response()->json(['success' => 1]);
        }

    }
}
