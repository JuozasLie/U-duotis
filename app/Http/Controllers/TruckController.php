<?php

namespace App\Http\Controllers;

use App\Models\truck;
use App\Models\truck_subunit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trucks = Truck::all();
        return view('trucks.index', [
            'trucks' => $trucks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trucks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validation
        $request->validate([
            'unit_number' => 'required|unique:trucks|max:255',
            'year' => 'required|date_format:Y|after:1900|before:' . Carbon::now()->addYears(5)->format('Y'),
        ]);
        try {
            $new_truck = Truck::create([
                'unit_number' => $request->unit_number,
                'year' => $request->year,
                'notes' => $request->notes,
            ]);
            return redirect()->route('trucks.create')
                ->with('status', 'Truck ' . $new_truck->unit_number . ' has been created successfully!');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('trucks.create')
                ->with('status', 'Truck ' . $new_truck->unit_number . ' has not been created');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $truck = Truck::find($id);
        return view('trucks.edit', [
            'truck' => $truck,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        # Validation
        $request->validate([
            'unit_number' => 'required|unique:trucks|max:255',
            'year' => 'required|date_format:Y|after:1900|before:' . Carbon::now()->addYears(5)->format('Y'),
        ]);
        $truck = Truck::find($id);
        try {
            $truck->update([
                'unit_number' => $request->unit_number,
                'year' => $request->year,
                'notes' => $request->notes,
            ]);
            return redirect()->route('trucks.index')
                ->with('status', 'Truck ' . $truck->unit_number . ' has been updated successfully!');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('trucks.index')
                ->with('status', 'Truck ' . $truck->unit_number . ' has not been updated ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truck = Truck::find($id);
        try {
            $truck->delete();
            return redirect()->route('trucks.index')
                ->with('status', 'Truck ' . $truck->unit_number . ' has been deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('trucks.index')
                ->with('status', 'Truck ' . $truck->unit_number . ' has not been deleted ' . $e->getMessage());
        }
    }
}
