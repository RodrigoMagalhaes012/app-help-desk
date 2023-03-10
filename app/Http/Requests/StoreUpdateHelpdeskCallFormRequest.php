<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateHelpdeskCallFormRequest extends FormRequest
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
        $rules = [
            'subject' => 'required|string|max:255|min:3',
            'description' => [
                'required',
                'min:6',
                'max:15'

            ]
        ];

        if ($this->method('PUT')) {
            $rules = [
                'subject' => 'required|string|max:255|min:3',
                'description' => [
                    'required',
                    'min:6',
                    'max:255'

                ]
            ];
        }

        return $rules;
    }
}
