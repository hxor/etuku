<?php

namespace App\Services;

use App\Services\Services;
use App\Models\CommodityPrice as Comprice;

class CompriceService extends Services
{
    public function create($request)
    {
        $isFound = Comprice::where('type_price_id', $request->type_price_id)
            ->where('commodity_id', $request->commodity_id)
            ->where('market_id', $request->market_id)->orderBy('id', 'DESC')->first();

        if ($isFound->date == $request->date & $isFound->price == $request->price) {
            return response()->json([
                'success' => false,
                'message' => 'Data Founded!',
                'data' => ''
            ], 400);
        } else {
            $oldPrice = $isFound->price;
            $newPrice = $request->price;
            if ($oldPrice == $newPrice) {
                $status = 'equal';
                $gap = 0;
            } elseif ($oldPrice < $newPrice) {
                $status = 'up';
                $gap = $newPrice - $oldPrice;
            } else {
                $status = 'down';
                $gap = $oldPrice - $newPrice;
            }
            $request['gap'] = $gap;
            $request['status'] = $status;
            
            $addPrice = Comprice::create($request->all());

            if ($addPrice) {
                return response()->json([
                    'success' => true,
                    'message' => 'Added Successful!',
                    'data' => $addPrice
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Added Fail!',
                    'data' => ''
                ], 400);
            }
        }
    }

    public function read($id)
    {
        $data = Comprice::find($id);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Successful!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Fail!',
                'data' => ''
            ], 404);
        }
    }

    public function update($request, $id)
    {
        $data = $this->read($id);
        if ($data) {
            $update = Comprice::where('id', $id)->update($request->all());
            if ($update) {
                return response()->json([
                    'success' => true,
                    'message' => 'Successful!',
                    'data' => $update
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Fail!',
                    'data' => ''
                ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Fail!',
                'data' => ''
            ], 404);
        }
    }

    public function delete($id)
    {
        $data = $this->read($id);
        if ($data) {
            $delete = Comprice::where('id', $id)->delete();
            if ($delete) {
                return response()->json([
                    'success' => true,
                    'message' => 'Successful!',
                    'data' => $delete
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Fail!',
                    'data' => ''
                ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Fail!',
                'data' => ''
            ], 404);
        }
    }
}
