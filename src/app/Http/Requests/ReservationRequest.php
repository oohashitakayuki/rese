<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => 'required|unique:reservations',
            'time' => 'required',
            'number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '予約する日を選択してください',
            'date.unique' => '同じ日に予約が入っています',
            'time.required' => '予約する時間を選択してください',
            'number.required' => '予約人数を選択してください',
        ];
    }
}
