<?php

namespace App\Http\Controllers\Backend\Desktop;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;

class DesktopController extends Controller
{
    public function index(Request $request)
    {
    	return View("backend.desktop.index");
    }
}
