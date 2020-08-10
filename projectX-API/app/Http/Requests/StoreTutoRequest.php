<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutoRequest extends FormRequest
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
            'title' => 'string|required | unique:tutos|max:255',
            'difficulty' => 'required',
            'langage' => 'required',
            'state' => 'integer|required',
            'author_id' => 'integer|required',
            'summary' => 'string|required',
            'content' => 'string|required',
            'pathImg' => 'string|required',
            //
        ];
    }
}
