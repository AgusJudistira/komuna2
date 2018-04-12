<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HobbyController extends Controller
{
	public function __construct()
    {
        $this->middleware('web');
    }

}

