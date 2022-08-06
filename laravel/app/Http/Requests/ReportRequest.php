<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from'          => 'required|numeric',
            'to'            => 'different:from|required|numeric',
            'transportType' => 'required|numeric',
            'departureType' => 'required|numeric',
            'weight'        => 'sometimes|required|numeric',
            'dateTime'      => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'from.required'          => 'Поле откуда обязательно.',
            'to.required'            => 'Поле куда обязательно.',
            'transportType.required' => 'Поле тип транспорта обязательно.',
            'departureType.required' => 'Поле тип отправления обязательно.',
            'weight.required'        => 'Поле веса обязательно.',
            'dateTime.required'      => 'Поле дата и время поездки обязательно.',
        ];
    }
}
