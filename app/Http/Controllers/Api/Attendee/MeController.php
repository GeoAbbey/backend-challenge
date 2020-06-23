<?php

namespace App\Http\Controllers\Api\Attendee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Attendee\UpdateRequest;
use App\Http\Resources\Api\Attendee\AttendeeResource;
use App\Models\Attendee;
use App\Services\Attendee\UpdateService;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * MeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:attendee');
    }

    /**
     * @param Request $request
     * @return AttendeeResource
     */
    public function show(Request $request)
    {
        return new AttendeeResource($request->user());
    }

    /**
     * @param UpdateRequest $request
     * @param Attendee $attendee
     * @return AttendeeResource
     */
    public function update(UpdateRequest $request)
    {
        $attendee = $request->guard('attendee')->user();
        (new UpdateService($attendee, $request->all()))->run();
        return new AttendeeResource(Attendee::findOrFail($attendee->id));
    }
}
