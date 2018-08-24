<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommodityRequest;
use App\Services\CommodityService;

class CommodityController extends Controller
{
    public $srv;

    public function __construct()
    {
        return $this->srv = new CommodityService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.commodity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.commodity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommodityRequest $request)
    {
        $result = $this->srv->create($request);
        if ($result) return redirect()->route('admin.commodity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->srv->read($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->srv->find($id);
        return view('pages.commodity.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommodityRequest $request, $id)
    {
        $result = $this->srv->update($request, $id);
        if ($result) return redirect()->route('admin.commodity.index');
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
        if ($result) return redirect()->route('admin.commodity.index');
    }

    /**
     * Datatable API
     */
    public function dataTable()
    {
        return $this->srv->getTable();
    }
}
