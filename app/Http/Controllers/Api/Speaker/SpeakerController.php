<?php

namespace App\Http\Controllers\Api\Speaker;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Speaker\StoreRequest;
use App\Http\Requests\Api\Speaker\ListRequest;
use App\Http\Requests\Api\Speaker\UpdateRequest;
use App\Http\Resources\Api\Speaker\SpeakerResource;
use App\Models\Speaker;
use App\Services\Speaker\UpdateService;

class SpeakerController extends Controller
{
    /**
     * SpeakerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('lists');
    }

    /**
     * @param ListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function lists(ListRequest $request)
    {
        $speakers = Speaker::filter($request->all())->orderBy('name', 'asc')->paginate(10);
        return SpeakerResource::collection($speakers);
    }

    /**
     * @param StoreRequest $request
     * @return SpeakerResource
     */
    public function store(StoreRequest $request)
    {
        $speaker = Speaker::create($request->only(['name', 'email', 'phone_number', 'address']));
        return new SpeakerResource($speaker);
    }

    /**
     * @param UpdateRequest $request
     * @param Speaker $speaker
     * @return SpeakerResource
     */
    public function update(UpdateRequest $request, Speaker $speaker)
    {
        (new UpdateService($speaker, $request->all()))->run();
        return new SpeakerResource(Speaker::findOrFail($speaker->id));
    }

    /**
     * @param Speaker $speaker
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Speaker $speaker)
    {
        $speaker->delete();
        return $this->deleteResource();
    }
}
