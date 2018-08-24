<?php

namespace App\Services;

use App\Services\Services;
use App\Models\Market;

class MarketService extends Services
{
    public function create($request)
    {
        $data = Market::create($request->all());

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Added Successful!',
                'data' => $data
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Added Fail!',
                'data' => ''
            ], 400);
        }
    }

    public function find($id)
    {
        return $data = Market::find($id);
    }

    public function read($id)
    {
        $data = $this->find($id);

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
            $update = Market::where('id', $id)->update($request->except(['_method', '_token']));
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
            $delete = Market::where('id', $id)->delete();
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

    public function getTable()
    {
        $model = Market::query();
        return $this->dataTable($model)
            ->addColumn('action', function ($model) {
                return view('layouts.partials._action', [
                    'model' => $model,
                    'show_url' => route('admin.market.show', $model->id),
                    'edit_url' => route('admin.market.edit', $model->id),
                    'delete_url' => route('admin.market.destroy', $model->id)
                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
