<?php

namespace App\Http\Controllers\Api\Me;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Me\MeResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * MeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @return MeResource
     */
    public function me(Request $request)
    {
        return new MeResource($request->user());
    }
}
