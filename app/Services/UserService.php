<?php

namespace App\Services;

use App\Services\Services;
use App\Models\User;

class UserService extends Services
{
    public function create($request)
    {
        $request['password'] = bcrypt($request->password);
        $data = User::create($request->all());

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
        return $data = User::find($id);
    }

    public function read($id)
    {
        $data = $this->find($id);

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
                'message' => 'Not Found!',
                'status' => '404',
                'data' => ''
            ];
        }
    }

    public function update($request, $id)
    {
        $data = $this->find($id);
        if ($data) {
            $request['password'] =  $request->password == null ? $data->password : bcrypt($request->password);
            $update = User::where('id', $id)->update($request->except(['_method', '_token']));
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
                    'message' => 'Update Fail!',
                    'status' => '400',
                    'data' => ''
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Not Found!',
                'status' => '404',
                'data' => ''
            ];
        }
    }

    public function delete($id)
    {
        $data = $this->read($id);
        if ($data) {
            $delete = User::where('id', $id)->delete();
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
                    'message' => 'Delete Fail!',
                    'status' => '400',
                    'data' => ''
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Not Found!',
                'status' => '404',
                'data' => ''
            ];
        }
    }

    public function getTable()
    {
        $model = User::query();
        return $this->dataTable($model)
            ->addColumn('action', function ($model) {
                return view('layouts.partials._action', [
                    'model' => $model,
                    'show_url' => route('admin.user.show', $model->id),
                    'edit_url' => route('admin.user.edit', $model->id),
                    'delete_url' => route('admin.user.destroy', $model->id)
                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
