<?php

namespace App\Http\Requests\Api\Conference;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'theme' => 'sometimes|required',
            'address' => 'sometimes|required',
            'start_date' => 'sometimes|required|date|date_format:Y-m-d',
            'end_date' => 'sometimes|required|date|date_format:Y-m-d|after:start_at'
        ];
    }
}
