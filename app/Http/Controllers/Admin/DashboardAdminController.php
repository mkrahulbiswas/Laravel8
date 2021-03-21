<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ServiceRequest;
use App\Feedback;

use Illuminate\Support\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
