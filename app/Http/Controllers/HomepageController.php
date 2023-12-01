<?php

namespace App\Http\Controllers;

use App\Models\truck_subunit;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $trucks = truck_subunit::with('mainTruck', 'subunitTruck')->orderBy('start_date', 'DESC')->get();
        return view('homepage', [
            'trucks' => $trucks,
        ]);
    }
}
