<?php

namespace App\Http\Requests\Api\Conference;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'end_date' => 'sometimes|required|date|date_format:Y-m-d|after:start_at',
            'talks' => 'sometimes|required|array',
            'talks.*.title' => 'sometimes|required',
            'talks.*.address' => 'sometimes|required',
            'talks.*.start_time' => 'sometimes|required|date_format:H:i',
            'talks.*.end_time' => 'sometimes|required|date_format:H:i|after:talks.*.start_time',
            'talks.*.description' => 'sometimes|required',
            'talks.*.speakers' => 'sometimes|required|array',
            'talks.*.talk_date' => 'sometimes|required|date|date_format:Y-m-d|after:yesterday',
            'talks.*.speakers.*.id' => [
                'sometimes',
                'required',
                Rule::exists('speakers', 'id')->whereNull('deleted_at')
            ],
        ];
    }
}
