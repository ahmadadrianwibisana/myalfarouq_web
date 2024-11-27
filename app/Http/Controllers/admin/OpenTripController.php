<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpenTrip;

class OpenTripController extends Controller
{
    public function index()
    {
        $open_trips = OpenTrip::all();

        return view('pages.admin.open_trip.index', compact('open_trips'));
    }
}
