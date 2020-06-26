<?php

namespace App\Http\Controllers\Api\Attendee;

use App\Http\Controllers\Api\Auth\LoginController;

class AuthController extends LoginController
{
    /**
     * AuthController constructor.
     * @param string $guard
     */
    public function __construct($guard = 'attendee')
    {
        parent::__construct($guard);
    }
}
