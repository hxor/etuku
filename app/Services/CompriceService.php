<?php

namespace App\Services;

use App\Services\Services;
use App\Models\CommodityPrice as Comprice;
use App\Models\TypePrice;

class CompriceService extends Services
{
    public function create($request)
    {
        $isFound = Comprice::where('type_price_id', $request->type_price_id)
            ->where('commodity_id', $request->commodity_id)
            ->where('market_id', $request->market_id)->orderBy('id', 'DESC')->first();

        if (empty($isFound)) {

            $request['gap'] = 0;
            $request['status'] = 'equal';

            $addPrice = Comprice::create($request->all());

            if ($addPrice) {
                return [
                    'success' => true,
                    'message' => 'Successful!',
                    'status' => '201',
                    'data' => $addPrice
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Fail!',
                    'status' => '400',
                    'data' => ''
                ];
            }
        } else {
            if ($isFound->date == $request->date) {
                return [
                    'success' => false,
                    'message' => 'Some data was entry!',
                    'status' => '400',
                    'data' => ''
                ];
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
                    return [
                        'success' => true,
                        'message' => 'Successful!',
                        'status' => '201',
                        'data' => $addPrice
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Fail!',
                        'status' => '400',
                        'data' => ''
                    ];
                }
            }
        }
    }

    public function find($id)
    {
        return $data = Comprice::find($id);
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
        /**
         * Nambahin Kondisi Kalo ada Data diupdate sebelum data terbaru, harus kalkulasi ulang
         * PR
         */
        $data = $this->find($id);
        if ($data) {
            $update = Comprice::where('id', $id)->update($request->except(['_method', '_token']));
            if ($update) {
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
                    return [
                        'success' => true,
                        'message' => 'Successful!',
                        'status' => '201',
                        'data' => $addPrice
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Fail!',
                        'status' => '400',
                        'data' => ''
                    ];
                }
                
                return [
                    'success' => true,
                    'message' => 'Successful!'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Fail!'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Data not found!'
            ];
        }
    }

    public function delete($id)
    {
        $data = $this->read($id);
        if ($data) {
            $delete = Comprice::where('id', $id)->delete();
            if ($delete) {
                return [
                    'success'   => true,
                    'message'   => 'Successful!',
                    'status'    => '201',
                    'data'      => ''
                ];
            } else {
                return [
                    'success'   => true,
                    'message'   => 'Successful!',
                    'status'    => '404',
                    'data' => ''
                ];
            }
        } else {
            return [
                'success'   => true,
                'message'   => 'Successful!',
                'status'    => '404',
                'data'      => ''
            ];
        }
    }

    public function getTypePrice($slug)
    {
        return $typePrice = TypePrice::where('slug', $slug)->first();
    }

    public function getTable($slug)
    {
        $typePrice = $this->getTypePrice($slug);

        $model = Comprice::with('typePrice')->with('com.comUnit')->with('market')->where('type_price_id', $typePrice->id);
        return $this->dataTable($model)
            ->addColumn('status', function ($model) {
                if ($model->status == 'up') {
                    return 'Naik';
                } elseif ($model->status == 'down') {
                    return 'Turun';
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($model) use ($typePrice) {
                return view('layouts.partials._action', [
                    'model' => $model,
                    'show_url' => route('admin.price.show', [$typePrice->slug, $model->id]),
                    'edit_url' => route('admin.price.edit', [$typePrice->slug, $model->id]),
                    'delete_url' => route('admin.price.destroy', [$typePrice->slug, $model->id])
                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
