<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\CommodityCategory as Comcat;
use App\Models\Commodity;

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
}
