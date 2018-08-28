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
            $this->srv->notif($result['message'], 'success');
            $data = $this->srv->getTypePrice($slug);
            return redirect()->route('admin.price.index', $data->slug);
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
    public function show($slug, $id)
    {
        $getData = $this->srv->find($id);
        if (count($getData) > 0) {
            $data = $this->srv->getTypePrice($slug);
            return view('pages.comprice.show', compact('getData', 'data'));
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
    public function edit($slug, $id)
    {
        $data = $this->srv->getTypePrice($slug);
        $getData = $this->srv->find($id);
        if (count($getData) > 0) {
            return view('pages.comprice.edit', compact('getData', 'data'));
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
    public function update(CompriceRequest $request, $slug, $id)
    {
        $result = $this->srv->update($request, $id);
        if ($result['success']) {
            $this->srv->notif($result['message'], 'success');
            $data = $this->srv->getTypePrice($slug);
            return redirect()->route('admin.price.index', $data->slug);
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
    public function destroy($slug, $id)
    {
        $data = $this->srv->getTypePrice($slug);
        $result = $this->srv->delete($id);
        if ($result['success']) {
            $this->srv->notif($result['message'], 'success');
            return redirect()->route('admin.price.index', $data->slug);
        } else {
            $this->srv->notif($result['message'], 'error');
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
