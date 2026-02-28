<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;

class AirportController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Airport::orderBy('city')->get(['code','city','name'])
        ]);
    }
}