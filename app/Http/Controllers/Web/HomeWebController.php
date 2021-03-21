<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeWebController extends Controller
{
    public function showHome()
    {
        return view('web.home.index');
    }
}
