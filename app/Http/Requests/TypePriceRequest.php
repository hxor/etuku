<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TypePrice;

class TypePriceRequest extends FormRequest
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
        $data = TypePrice::find($this->typeprice);

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'slug' => 'required|string|unique:type_prices,slug',
                        'title' => 'required|string|min:2|unique:type_prices,title'
                    ];
                }
            case 'PUT':
                {
                    return [
                        'slug' => 'required|string|unique:type_prices,slug,' . $data->id,
                        'title' => 'required|string|min:2|unique:type_prices,title,' . $data->id
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'slug' => 'required|string|unique:type_prices,slug,' . $data->id,
                        'title' => 'required|string|min:2|unique:type_prices,title,' . $data->id
                    ];
                }
            default:
                break;
        }
    }
}
