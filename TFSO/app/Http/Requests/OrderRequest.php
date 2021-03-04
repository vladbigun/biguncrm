<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
           'name' => 'required',
           'surname' => 'required',
           'middle_name' => 'required',
           'phone_number' => 'required',
           'sum' => 'required',
        ];
    }
    public function messages(){
        return [
        'name.required' => 'Строка Имя должна быть заполнена',
        'phone_number.required' => 'Строка Номер телефона должна быть заполнена',
        'sum.required' => 'Строка Сумма должна быть заполнена',
        ];
    }
}
