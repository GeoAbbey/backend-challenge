<?php

namespace App\Http\Controllers\Api\Conference;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ticket\StoreRequest;
use App\Http\Resources\Api\Ticket\TicketResource;
use App\Libraries\Utilities;
use App\Models\Conference;
use App\Models\Ticket;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * TicketController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:attendee');
    }

    public function lists()
    {
        $attendee = auth('attendee')->user();
        $tickets = Ticket::where('attendee_id', $attendee->id)->orderBy('created_at', 'desc')->get();
        return TicketResource::collection($tickets);
    }

    /**
     * @param StoreRequest $request
     * @param Conference $conference
     * @return TicketResource
     */
    public function store(StoreRequest $request, Conference $conference)
    {
        $data = $request->all();
        $attendee = auth('attendee')->user();
        $ticket = DB::transaction(function () use($attendee, $data, $conference) {
            $ticket = new Ticket();
            $ticket->ticket_number = Utilities::generateTicketNumber();
            $ticket->attendee_id = $attendee->id;
            $ticket->conference_id = $conference->id;
            $ticket->save();

            $attendee->talks()->attach(Arr::pluck($data['talks'], 'id'));
            return $ticket;
        });
        return new TicketResource($ticket);
    }
}
