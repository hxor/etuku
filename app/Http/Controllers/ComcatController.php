<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ComcatRequest;
use App\Services\ComcatService;

class ComcatController extends Controller
{
    public $srv;

    public function __construct()
    {
        return $this->srv = new ComcatService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.comcat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.comcat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComcatRequest $request)
    {
        $result = $this->srv->create($request);
        if ($result) return redirect()->route('admin.comcat.index');
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
        return view('pages.comcat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComcatRequest $request, $id)
    {
        $result = $this->srv->update($request, $id);
        if ($result) return redirect()->route('admin.comcat.index');
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
        if ($result) return redirect()->route('admin.comcat.index');
    }

    /**
     * Datatable API
     */
    public function dataTable()
    {
        return $this->srv->getTable();
    }
}
