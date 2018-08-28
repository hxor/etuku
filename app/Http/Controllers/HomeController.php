<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeCommodity;
use App\Models\Commodity;
use App\Models\CommodityPrice as Comprice;
use App\Models\CommodityCategory as Comcat;
use App\Models\Market;
use App\Models\TypePrice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $market = Market::all();
        $typePrice = TypePrice::all();
        $comprice = Comprice::query();
        $commodity = Commodity::query();
        return view('home', compact('market', 'typePrice', 'comprice', 'commodity'));
    }
}
