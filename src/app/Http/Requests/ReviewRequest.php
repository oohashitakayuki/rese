<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'star' => 'required',
            'comment' => 'required|string|max:150',
        ];
    }

    public function messages()
    {
        return [
            'star.required' => 'スターをクリックして評価してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => 'コメントは150文字以内で入力してください',
        ];
    }
}
