<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MarketRequest;
use App\Services\MarketService;

class MarketController extends Controller
{
    public $srv;

    public function __construct()
    {
        return $this->srv = new MarketService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.market.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.market.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarketRequest $request)
    {
        $result = $this->srv->create($request);
        if ($result['success']) {
            $this->srv->notif($result['message'], 'success');
            return redirect()->route('admin.market.index');
        } else {
            $this->srv->notif($result['message'], 'error');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getData = $this->srv->find($id);
        if (count($getData) > 0) {
            return view('pages.market.show', compact('getData'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getData = $this->srv->find($id);
        if (count($getData) > 0) {
            return view('pages.market.edit', compact('getData'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarketRequest $request, $id)
    {
        $result = $this->srv->update($request, $id);
        if ($result['success']) {
            $this->srv->notif($result['message'], 'success');
            return redirect()->route('admin.market.index');
        } else {
            $this->srv->notif($result['message'], 'error');
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->srv->delete($id);
        if ($result['success']) {
            $this->srv->notif($result['message'], 'success');
            return redirect()->route('admin.market.index');
        } else {
            $this->srv->notif($result['message'], 'error');
            return redirect()->back();
        }
    }

    /**
     * Datatable API
     */
    public function dataTable()
    {
        return $this->srv->getTable();
    }
}
