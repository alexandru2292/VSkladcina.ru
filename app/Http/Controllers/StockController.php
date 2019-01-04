<?php

namespace App\Http\Controllers;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
class StockController extends SiteController
{
    public function __construct(StockRepository $stockRep)
    {
        $this->stockRep = $stockRep;
        $this->template = config('settings.theme').'.catalog';
    }
    public function index(Request $request)
    {
        $this->content = view(config('settings.theme').'.contentCatalog')->with(['Variable' =>  'OK'])->render();
        return $this->renderOutput();
    }
}

