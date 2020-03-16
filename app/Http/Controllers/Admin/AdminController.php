<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use App\Order;
use Carbon;

class AdminController extends Controller
{

	// protected route
    public function __construct()
	{
	    $this->middleware('auth');
	}

    public function index()
    {
    	return view('admin/dashboard');
    }

}
