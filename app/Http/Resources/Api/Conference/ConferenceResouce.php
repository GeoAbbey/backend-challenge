<?php

namespace App\Http\Resources\Api\Conference;

use Illuminate\Http\Resources\Json\JsonResource;

class ConferenceResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'theme' => $this->theme,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'address' => $this->address
        ];
    }
}
