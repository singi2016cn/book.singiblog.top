<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// TODO 完善爬虫
class StoreBooks extends FormRequest
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
            'category' => 'required|numeric|min:1|max:10',
            'title' => 'required|unique:books|max:255',
            'cover' => 'nullable|max:255',
            'author' => 'nullable|max:255',
            'isbn' => 'nullable|numeric|regex:/[\d{13}]/',
            'publish_id' => '',
            'tag_id' => '',
        ];
    }

}
