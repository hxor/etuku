<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\CommodityCategory as Comcat;
use App\Models\Commodity;
use DB;

class CommodityController extends Controller
{
    public function getComByMarket($market)
    {
        $data = Market::where('slug', $market)->with(['comPrice', 'comPrice.com'])->first();
        
        $response = [
            'status' => true,
            'message' => 'Get All Commodities By Markets',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function getPriceByMarket($id)
    {
        $market = Market::findOrFail($id);
        $comCat = Comcat::get();

        $data = [];

        foreach($comCat as $comCatRow) {
           $prices =  DB::select("SELECT c.title komoditas, FORMAT(cp.price,0,'id_ID') harga, cp.status, cp.date 
                FROM `commodity_prices` cp 
                LEFT JOIN commodities c ON c.id=cp.commodity_id
                LEFT JOIN commodity_categories cc ON cc.id=c.commodity_category_id
                WHERE cp.market_id={$market->id} 
                AND cc.id=". $comCatRow->id ." AND cp.type_price_id=1 
                AND cp.date IN(SELECT MAX(`date`) FROM commodity_prices GROUP BY commodity_id)");

            // dump($prices);

            if(count($prices)) $data[$comCatRow->title] = $prices;

        }
        
        $response = [
            'status' => true,
            'message' => 'Get All Commodities By Market',
            'data' => [
                'market' => $market->title, 
                'prices' => $data
            ]
        ];
        return response()->json($response, 200);
    }
}
