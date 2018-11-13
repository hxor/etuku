<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market;

class MarketController extends Controller
{
    public function index()
    {
        $data = Market::all();
        $response = [
            'status' => true,
            'message' => 'Get All Markets',
            'data' => $data
        ];
        return response()->json($response, 200);
    }
}
