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
        $current = $this->find($id);
        if ($current) {
            $old = $current->where('type_price_id', $current->type_price_id)
                    ->where('commodity_id', $current->commodity_id)
                    ->where('market_id', $current->market_id)
                    ->where('id', '<', $current->id)
                    ->latest('id')
                    ->first();
            $new = $current->where('type_price_id', $current->type_price_id)
                    ->where('commodity_id', $current->commodity_id)
                    ->where('market_id', $current->market_id)
                    ->where('id', '>', $current->id)
                    ->first();
            if (count($old) == 0 && count($new) == 0) {
                $request['gap'] = 0;
                $request['status'] = 'equal';

                $result = Comprice::where('id', $id)->update($request->except(['_method', '_token']));
                if ($result) {
                    
                    return [
                        'success' => true,
                        'message' => 'Successful!',
                        'status' => '201',
                        'data' => $result
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Fail!',
                        'status' => '400',
                        'data' => ''
                    ];
                }
            } else if (count($old) == 0 && count($new) > 0 ) {
                $request['gap'] = 0;
                $request['status'] = 'equal';

                $result = Comprice::where('id', $id)->update($request->except(['_method', '_token']));
                if ($result) {
                    $oldPrice = $request->price;
                    $newPrice = $new->price;

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

                    $request = [
                        'gap' => $gap, 
                        'status' => $status,
                    ];

                    $resultChild = $new->update($request);

                    if ($resultChild) {
                        return [
                            'success' => true,
                            'message' => 'Successful!',
                            'status' => '201',
                            'data' => $resultChild
                        ];
                    } else {
                        return [
                            'success' => false,
                            'message' => 'Fail Update!',
                            'status' => '400',
                            'data' => ''
                        ];
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Not Found Result!',
                        'status' => '404',
                        'data' => ''
                    ];
                }
            } else if (count($old) > 0 && count($new) == 0) {
                $oldPrice = $old->price;
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

                $resultChild = $current->update($request->except(['_method', '_token']));

                if ($resultChild) {
                    return [
                        'success' => true,
                        'message' => 'Successful!',
                        'status' => '201',
                        'data' => $resultChild
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Fail Update!',
                        'status' => '400',
                        'data' => ''
                    ];
                }

            } else {

                $oldPrice = $old->price;
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

                $resultChild = $current->update($request->except(['_method', '_token']));

                if ($resultChild) {

                    $oldPrice = $request->price;
                    $newPrice = $new->price;

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

                    $request = [
                        'gap' => $gap, 
                        'status' => $status,
                    ];

                    $resultChild = $new->update($request);
                    return [
                        'success' => true,
                        'message' => 'Successful!',
                        'status' => '201',
                        'data' => $resultChild
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Fail Update!',
                        'status' => '400',
                        'data' => ''
                    ];
                }
            }
        }
    }

    public function delete($id)
    {
        $current = $this->find($id);
        if ($current) {
            $old = $current->where('type_price_id', $current->type_price_id)
                    ->where('commodity_id', $current->commodity_id)
                    ->where('market_id', $current->market_id)
                    ->where('id', '<', $current->id)
                    ->latest('id')
                    ->first();
            $new = $current->where('type_price_id', $current->type_price_id)
                    ->where('commodity_id', $current->commodity_id)
                    ->where('market_id', $current->market_id)
                    ->where('id', '>', $current->id)
                    ->first();


            if (count($old) > 0 && count($new) > 0) {
                $oldPrice = $old->price;
                $newPrice = $new->price;

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

                $request = [
                    'status' => $status,
                    'gap' => $gap
                ];

                $resultChild = $new->update($request);

                if ($resultChild) {

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
                        'success' => false,
                        'message' => 'Fail Update Price!',
                        'status' => '400',
                        'data' => ''
                    ];
                }
            } else if (count($old) == 0 && count($new) > 0 ) {
                    $oldPrice = 0;
                    $newPrice = $new->price;

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

                    $request = [
                        'gap' => 0, 
                        'status' => 'equal'
                    ];

                    $resultChild = $new->update($request);

                    if ($resultChild) {

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
                            'success' => false,
                            'message' => 'Fail Update Price!',
                            'status' => '400',
                            'data' => ''
                        ];
                    }
            } else {
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
            }
        } else {
            return [
                'success'   => false,
                'message'   => 'Data Not Found!',
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
