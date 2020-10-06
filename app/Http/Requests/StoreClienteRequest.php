<?php

namespace parqueos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'cc_user' => 'required|min:5|max:12',
            'name' => 'required',
            'tel_user' => 'required',
            'cel_user' => 'required',
            'email' => 'required|email',
            'cod_dc_user' => 'required'
        ]; 

    }
}
