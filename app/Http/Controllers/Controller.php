<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function resourceNotFound()
    {
        return response()->json([
            'status' => 'error',
            'message' => 'resource not found'
        ], 404);
    }

    protected function deleteResource()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'resource deleted successfully'
        ], 200);
    }
}
