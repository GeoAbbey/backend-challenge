<?php

namespace App\Http\Controllers\Web\Dashboard\Attendee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard.attendee.dashboard');
    }
}
