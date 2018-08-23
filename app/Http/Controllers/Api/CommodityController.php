<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommodityCategory as Comcat;
use App\Models\Commodity;

class CommodityController extends Controller
{
    public function index()
    {
        $comcat = Comcat::with(['com.comLastPrice' => function($query){
            $query->orderBy('id', 'DESC')->first();
        }])
        ->with('com.comUnit')
        ->take(4)->get();

        return response()->json([
            'success' => true,
            'message' => 'Get Some Commodity',
            'data' => $comcat
        ]);
    }

    public function show($id)
    {
        $comdetail = Commodity::find($id);
        if ($comdetail) {
            $comPrice = $comdetail->comPrice();
            return response()->json([
                'success' => true,
                'message' => 'Detail Commodity Detail',
                'data' => [
                    'commodity' => $comdetail,
                    'comprice' => $comPrice->take(5)->get(),
                    'history' => $comPrice->paginate(5)
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Detail Commodity Not Found',
                'data' => ''
            ], 404);
        }
    }

}
