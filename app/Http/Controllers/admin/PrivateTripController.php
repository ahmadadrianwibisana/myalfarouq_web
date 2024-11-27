<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivateTrip;

class PrivateTripController extends Controller
{
    public function index()
    {
        $private_trips = PrivateTrip::all();

        return view('pages.admin.private_trip.index', compact('private_trips'));
    }

}
