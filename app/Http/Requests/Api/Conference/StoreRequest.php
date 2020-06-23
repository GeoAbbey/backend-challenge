<?php

namespace App\Http\Requests\Api\Conference;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'theme' => 'required',
            'address' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_at',
            'talks' => 'required|array',
            'talks.*.title' => 'required',
            'talks.*.address' => 'required',
            'talks.*.start_time' => 'required|date_format:H:i',
            'talks.*.end_time' => 'required|date_format:H:i|after:talks.*.start_time',
            'talks.*.description' => 'required',
            'talks.*.talk_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'talks.*.speakers' => 'required|array',
            'talks.*.speakers.*.id' => [
                'required',
                Rule::exists('speakers', 'id')->whereNull('deleted_at')
            ],
        ];
    }
}
