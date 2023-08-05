<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $input      = $this->all();
        $required   = 'required';
        if (isset($input['id'])) {
            $required = null;
            if (isset($input['image'])) {
                $required = 'required';
            }
        }
        return [
            'name'              => 'required',
            'url'               => 'required|url',
            'image'             => "$required|image|mimes:jpeg,jpg,png|max:10000", // max 10000kb
            'status'            => 'not_in:0',
            'sequence'          => 'required|integer',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date'
        ];
    }

    public function attributes()
    {
        $attributes =  collect(require(app_path('Helpers/Form/config/slider.php')))->map(function ($item) {
            return $item['label'];
        })->toArray();

        $attributes['image'] = 'Hình ảnh';

        return $attributes;
    }

    public function messages()
    {
        return [
            'name.required'                 => __('messages.required'),
            'url.required'                  => __('messages.required'),
            'url.url'                       => __('messages.url'),
            'status.not_in'                 => __('messages.required'),
            'sequence.required'             => __('messages.required'),
            'sequence.integer'              => __('messages.integer'),
            'start_date.required'           => __('messages.required'),
            'start_date.date'               => __('messages.date'),
            'end_date.required'             => __('messages.required'),
            'end_date.date'                 => __('messages.date'),
            'end_date.after_or_equal'       => __('messages.after_or_equal'),
            'image.required'                => __('messages.required'),
            'image.image'                   => __('messages.image'),
            'image.mimes'                   => __('messages.image'),
            'image.max'                     => __('messages.image_max'),
        ];
    }
}
