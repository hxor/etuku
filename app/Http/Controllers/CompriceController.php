<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompriceRequest;
use App\Services\CompriceService;

class CompriceController extends Controller
{
    public $srv;

    public function __construct()
    {
        return $this->srv = new CompriceService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $data = $this->srv->getTypePrice($slug);
        return view('pages.comprice.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $data = $this->srv->getTypePrice($slug);
        return view('pages.comprice.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompriceRequest $request, $slug)
    {
        $result = $this->srv->create($request);   
        if ($result['success']) {
            $data = $this->srv->getTypePrice($slug);
            return redirect()->route('admin.price.index', $data->slug);
        } else {
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $current = $this->srv->find($id);
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
                    ->get();
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
                    $oldPrice = $result->price;
                    foreach ($new as $row) {
                        $child = Comprice::find($row->id);
                        $newPrice = $child->price;

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

                        $child->update($request);

                        $oldPrice = $child->price;
                    }
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
                return 'Tidak ada yang di atas tapi ada yang di bawah';
            } else if (count($old) > 0 && count($new) == 0) {
                return 'Ada yang di atas tapi tidak ada yang di bawah';
            } else {
                return 'Ada yang di atas dan ada yang di bawah';
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $data = $this->srv->getTypePrice($slug);
        $model = $this->srv->find($id);
        return view('pages.comprice.edit', compact('data', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompriceRequest $request, $slug, $id)
    {
        $result = $this->srv->update($request, $id);
        if ($result['success']) {
            $data = $this->srv->getTypePrice($slug);
            return redirect()->route('admin.price.index', $data->slug);
        } else {
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $data = $this->srv->getTypePrice($slug);
        $result = $this->srv->delete($id);
        if ($result['success']) {
            return redirect()->route('admin.price.index', $data->slug);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Datatable API
     */
    public function dataTable($slug)
    {
        return $this->srv->getTable($slug);
    }
}
