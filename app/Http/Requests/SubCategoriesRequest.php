<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoriesRequest extends FormRequest
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
                    'category_id'=> 'required',
                    'sub_category_name' =>['required', Rule::unique('sub-category','sub_category_name')->ignore($this->route('SubCategory'))],
                ];    
        } else {
            return [
                //
                'category_id'=> 'required',
                'sub_category_name' =>'required', // Adjust validation rules for image
            ];
        }  
    }
    protected function failedValidation(Validator $validator)
    {
        session()->flash('error', $validator->errors());
    }
}
