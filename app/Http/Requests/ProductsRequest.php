<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ProductsRequest extends FormRequest
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
        if (request()->isMethod('put')) {
            return [
                //
                'title' =>'required',
                'price'=> 'required',
                'short_description' => 'required',
                'long_description' =>'required',
                'discount' =>'sometimes',
                'old_price' => 'sometimes',
                'category_id' => 'required',
                'sub_category_id' =>'required',
                'images' =>'image|mimes:jpeg,png,jpg,gif|max:2048'
            ];    
        } else {
            return [
                //
                'title' =>'required',
                'price'=> 'required',
                'short_description' => 'required',
                'long_description' =>'required',
                'discount' =>'sometimes',
                'old_price' => 'sometimes',
                'category_id' => 'required',
                'sub_category_id' =>'required',
                'images.*' =>'required|max:2048'
            ];
        }  
    }
    protected function failedValidation(Validator $validator)
    {
        session()->flash('error', $validator->errors());

    }

}
