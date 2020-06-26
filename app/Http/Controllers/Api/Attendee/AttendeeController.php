<?php

namespace App\Http\Controllers\Api\Attendee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Attendee\ListRequest;
use App\Http\Requests\Api\Attendee\StoreRequest;
use App\Http\Requests\Api\Attendee\UpdateRequest;
use App\Http\Resources\Api\Attendee\AttendeeResource;
use App\Models\Attendee;
use App\Services\Attendee\UpdateService;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * AttendeeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('store');
    }

    /**
     * @param ListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function lists(ListRequest $request)
    {
        $attendees = Attendee::filter($request->all())->orderBy('created_at', 'desc')->paginate(10);
        return AttendeeResource::collection($attendees);
    }

    /**
     * @param StoreRequest $request
     * @return AttendeeResource
     */
    public function store(StoreRequest $request)
    {
        $attendee = Attendee::create($request->only(['first_name', 'last_name', 'email', 'phone_number',
            'address', 'password']));
        return new AttendeeResource($attendee);
    }

    /**
     * @param Attendee $attendee
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Attendee $attendee)
    {
        $attendee->delete();
        return $this->deleteResource();
    }
}
