<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'name'              => 'required',
            'status'            => 'not_in:0',
            'sequence'          => 'required|integer',
        ];
    }

    public function attributes()
    {
        $attributes =  collect(require(app_path('Helpers/Form/config/category.php')))->map(function ($item) {
            return $item['label'];
        })->toArray();


        return $attributes;
    }

    public function messages()
    {
        return [
            'name.required'                 => __('messages.required'),
            'status.not_in'                 => __('messages.required'),
            'sequence.required'             => __('messages.required'),
            'sequence.integer'              => __('messages.integer'),
        ];
    }
}
