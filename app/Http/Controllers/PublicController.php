<?php

namespace App\Http\Controllers;

use App\Models\TypeCommodity as TypeCom;
use App\Models\TypePrice as TypePrice;
use App\Models\Market;
use App\Models\Commodity;
use App\Models\CommodityPrice as ComPrice;
use App\Models\CommodityCategory as ComCat;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $market = Market::first();
        $typePrice = TypePrice::first();
        $comCat = ComCat::all();
        $comPrice = ComPrice::query();

        $markets = Market::pluck('title', 'id');
        $typePrices = TypePrice::pluck('title', 'id');
        $commodities = Commodity::orderBy('title', 'ASC')->pluck('title', 'id')->all();

        return view('pages.public.index', compact('market', 'markets', 'typePrice', 'typePrices', 'comCat', 'comPrice', 'commodities'));
    }

    public function search(Request $request)
    {
        $marketId       = $request->market;
        $typePriceId    = $request->price;
        $commodityId    = $request->commodity;

        $market = Market::findOrFail($marketId);
        $typePrice = TypePrice::findOrFail($typePriceId);

        $markets = Market::pluck('title', 'id');
        $typePrices = TypePrice::pluck('title', 'id');
        $commodities = Commodity::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        
        if ($commodityId != '0') {
            $commodity = Commodity::findOrFail($commodityId);
            return view('pages.public.show', compact('market', 'markets', 'typePrice', 'typePrices', 'comCat', 'comPrice', 'commodity', 'commodities'));   
        }

        $comCat = ComCat::all();
        return view('pages.public.index', compact('market', 'markets', 'typePrice', 'typePrices', 'comCat', 'comPrice', 'commodities'));
    }
}
