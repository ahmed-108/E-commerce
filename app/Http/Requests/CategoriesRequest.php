<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CategoriesRequest extends FormRequest
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
                    'category'=> ['required', Rule::unique('categories','category')->ignore($this->route('MainCategory'))],
                    'category_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for image
                ];    
        } else {
            return [
                //
                'category'=> 'required',
                'category_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for image
            ];
        }  
    }
    protected function failedValidation(Validator $validator)
    {
        session()->flash('error', $validator->errors());

    }

}
