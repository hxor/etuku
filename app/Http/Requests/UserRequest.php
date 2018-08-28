<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = User::find($this->user);

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6',
                        'role' => 'required'
                    ];
                }
            case 'PUT':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users,email, '. $data->id,
                        'password' => 'sometimes|nullable|string|min:6',
                        'role' => 'required'
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users,email, ' . $data->id,
                        'password' => 'sometimes|nullable|string|min:6',
                        'role' => 'required'
                    ];
                }
            default:
                break;
        }
    }
}
