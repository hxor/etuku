<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CommodityPrice as Comprice;

class CompriceRequest extends FormRequest
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
        $data = Comprice::find($this->comprice);

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'type_price_id' => 'required',
                        'commodity_id' => 'required',
                        'market_id' => 'required',
                        'price' => 'required|numeric',
                        'date' => 'required'
                    ];
                }
            case 'PUT':
                {
                    return [
                        'type_price_id' => 'required',
                        'commodity_id' => 'required',
                        'market_id' => 'required',
                        'price' => 'required|numeric',
                        'date' => 'required'
                    ];
                }
            case 'PATCH':
                {
                    return [
                        'type_price_id' => 'required',
                        'commodity_id' => 'required',
                        'market_id' => 'required',
                        'price' => 'required|numeric',
                        'date' => 'required'
                    ];
                }
            default:
                break;
        }
    }
}
