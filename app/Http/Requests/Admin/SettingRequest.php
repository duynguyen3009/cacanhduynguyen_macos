<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        if ($input['mode'] == 'edit') {
            $required = null;
            if (isset($input['logo'])) {
                $required = 'required';
            }
        }
        return [
            'logo'             => "$required|image|mimes:jpeg,jpg,png|max:10000", // max 10000kb
            'company_name'              => 'required',
            'phone_number'              => 'bail|required|numeric|digits:10',
            'address'              => 'required',
            'email'              => 'bail|required|email',
            'consulation_time'              => 'bail|required',
        ];
        // $table->string('logo');
        //     $table->string('phone_number', 11);
        //     $table->string('link_facebook')->nullable();
        //     $table->string('link_youtube')->nullable();
        //     $table->string('link_tiktok')->nullable();
        //     $table->string('link_googlemap')->nullable();
        //     $table->string('company_name');
        //     $table->string('address');
        //     $table->string('email');
        //     $table->string('consulation_time');
    }

    public function attributes()
    {
        $attributes =  collect(require(app_path('Helpers/Form/config/setting.php')))->map(function ($item) {
            return $item['label'];
        })->toArray();

        $attributes['logo'] = 'Hình ảnh';

        return $attributes;
    }

    public function messages()
    {
        return [
            'company_name.required'                 => __('messages.required'),
            'phone_number.required'                 => __('messages.required'),
            'phone_number.numeric'                 => __('messages.numeric'),
            'phone_number.digits'                 => __('messages.digits10'),
            'address.required'                 => __('messages.required'),
            'email.required'                 => __('messages.required'),
            'email.email'                 => __('messages.email'),
            'logo.required'                => __('messages.required'),
            'logo.image'                   => __('messages.image'),
            'logo.mimes'                   => __('messages.image'),
            'logo.max'                     => __('messages.image_max'),
            'consulation_time.required'                 => __('messages.required'),
        ];
    }
}
