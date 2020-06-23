<?php

namespace App\Http\Resources\Api\Ticket;

use App\Http\Resources\Api\Attendee\AttendeeResource;
use App\Http\Resources\Api\Conference\ConferenceResouce;
use App\Http\Resources\Api\Talk\TalkResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'ticker_number' => $this->ticket_number,
            'conference' => new ConferenceResouce($this->conference),
            'talks' => TalkResource::collection($this->attendee->talks->where('conference_id', $this->conference->id)),
            'attendee' => new AttendeeResource($this->attendee)
        ];
    }
}
