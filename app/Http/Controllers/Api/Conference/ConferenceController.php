<?php

namespace App\Http\Controllers\Api\Conference;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Conference\ListRequest;
use App\Http\Requests\Api\Conference\StoreRequest;
use App\Http\Requests\Api\Conference\UpdateRequest;
use App\Http\Resources\Api\Conference\ConferenceResouce;
use App\Http\Resources\Api\Talk\TalkResource;
use App\Models\Conference;
use App\Services\Conference\StoreService;
use App\Services\Conference\UpdateService;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * ConferenceController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['lists', 'show']);
    }

    /**
     * @param ListRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function lists(ListRequest $request)
    {
        $conferences = Conference::filter($request->all())->orderBy('created_at', 'desc')->paginate(10);
        return ConferenceResouce::collection($conferences);
    }

    public function show(Conference $conference)
    {
        return (new ConferenceResouce($conference))->additional([
            'talks' => TalkResource::collection($conference->talks)
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return ConferenceResouce
     */
    public function store(StoreRequest $request)
    {
        $conference = (new StoreService($request->all()))->run();
        return new ConferenceResouce($conference);
    }

    /**
     * @param UpdateRequest $request
     * @param Conference $conference
     * @return ConferenceResouce
     */
    public function update(UpdateRequest $request,  Conference $conference)
    {
        (new UpdateService($conference, $request->all()))->run();
        return new ConferenceResouce(Conference::findOrFail($conference->id));
    }

    /**
     * @param Conference $conference
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Conference $conference)
    {
        $conference->delete();
        return $this->deleteResource();
    }
}
