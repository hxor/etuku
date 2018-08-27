<?php

namespace App\Services;

use App\Services\Services;
use App\Models\CommodityCategory as Comcat;

class ComcatService extends Services
{
    public function create($request)
    {
        $data = Comcat::create($request->all());

        if ($data) {
            return [
                'success' => true,
                'message' => 'Successful!',
                'status' => '201',
                'data' => $data
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

    public function find($id)
    {
        return $data = Comcat::find($id);
    }

    public function read($id)
    {
        $data = Comcat::find($id);

        if ($data) {
            return [
                'success' => true,
                'message' => 'Successful!',
                'status' => '200',
                'data' => $data
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!',
                'status' => '404',
                'data' => ''
            ];
        }
    }

    public function update($request, $id)
    {
        $data = $this->read($id);
        if ($data) {
            $update = Comcat::where('id', $id)->update($request->except(['_method', '_token']));
            if ($update) {
                return [
                    'success' => true,
                    'message' => 'Successful!',
                    'status' => '201',
                    'data' => $update
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Fail to update!',
                    'status' => '400',
                    'data' => ''
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!',
                'status' => '404',
                'data' => ''
            ];
        }
    }

    public function delete($id)
    {
        $data = $this->read($id);
        if ($data) {
            $delete = Comcat::where('id', $id)->delete();
            if ($delete) {
                return [
                    'success' => true,
                    'message' => 'Successful!',
                    'status' => '201',
                    'data' => $delete
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Data Not Found!',
                    'status' => '404',
                    'data' => ''
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Data Not Found!',
                'status' => '404',
                'data' => ''
            ];
        }
    }

    public function getTable()
    {
        $model = Comcat::with('typeCom');
        return $this->dataTable($model)
            ->addColumn('action', function ($model) {
                return view('layouts.partials._action', [
                    'model' => $model,
                    'show_url' => route('admin.comcat.show', $model->id),
                    'edit_url' => route('admin.comcat.edit', $model->id),
                    'delete_url' => route('admin.comcat.destroy', $model->id)
                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
