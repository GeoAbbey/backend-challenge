<?php

namespace App\Http\Resources\Api\Talk;

use App\Http\Resources\Api\Speaker\SpeakerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TalkResource extends JsonResource
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
            'title' => $this->title,
            'address' => $this->address,
            'talk_date' => date('Y-m-d', strtotime($this->talk_date)),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'description' => $this->description,
            'speakers' => SpeakerResource::collection($this->speakers)
        ];
    }
}
