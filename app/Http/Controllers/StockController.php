<?php

namespace App\Http\Controllers;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends SiteController
{
    public function __construct(StockRepository $stockRep)
    {
        $this->stockRep = $stockRep;
        $this->template = config('settings.theme').'.index';
    }
    public function index()
    {
        $stocks = $this->stockRep->getStocks();
        $this->content = view(config('settings.theme').'.contentIndex')->with(['stocks' =>  $stocks])->render();
        return $this->renderOutput();
    }
    public function StockEdit(){
        $this->content = view(config('settings.theme').'.stockAdd')->render();
        return $this->renderOutput();
    }
}

