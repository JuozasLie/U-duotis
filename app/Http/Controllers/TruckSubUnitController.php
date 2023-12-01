<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Truck_subunit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TruckSubUnitController extends Controller
{
    public function index()
    {
        $trucks = Truck_subunit::with('mainTruck', 'subunitTruck')->orderBy('start_date', 'DESC')->get();
        return view('subunits.index', [
            'trucks' => $trucks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trucks = Truck::all();
        //for time select, to prevent selecting backup trucks on days that have passed already
        $min_date = Carbon::yesterday()->format('Y-m-d');
        return view('subunits.create', [
            'trucks' => $trucks,
            'min_date' => $min_date
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validation
        $request->validate([
            'main_truck' => 'required|exists:trucks,id',
            'subunit' => 'required|exists:trucks,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        // Check if the main truck is not the same as the subunit
        if ($request->input('main_truck') == $request->input('subunit')) {
            return redirect()->back()->with('status', 'Subunit cannot be the same as the main truck.');
        }
        // Check for date conflicts
        $dateConflicts = Truck_subunit::where('main_truck', $request->input('main_truck'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
                    ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('subunit', $request->input('subunit'))
                    ->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
                    ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);
            })
            ->exists();

        if ($dateConflicts) {
            return redirect()->back()->with('status', 'Date conflicts with existing subunits.');
        }
        // Check if the main truck is not a subunit of the subunit
        $subunitOfSubunit = Truck_subunit::where('main_truck', $request->input('subunit'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
                    ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);
            })
            ->exists();

        if ($subunitOfSubunit) {
            return redirect()->back()->with('status', 'The subunit has a subunit truck assigned to it during this period.');
        }
        // Create a new subunit
        Truck_subunit::create($request->all());

        return redirect()->route('subunit.index')->with('status', 'Subunit created successfully.');
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
        $subunit = Truck_subunit::findOrFail($id);
        $trucks = Truck::all();
        //for time select, to prevent selecting backup trucks on days that have passed already
        $min_date = Carbon::yesterday()->format('Y-m-d');

        return view('subunits.edit', [
            'trucks' => $trucks,
            'subunit' => $subunit,
            'min_date' => $min_date,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $request->validate([
            'main_truck' => 'required|exists:trucks,id',
            'subunit' => 'required|exists:trucks,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Check if the main truck is not the same as the subunit
        if ($request->input('main_truck') == $request->input('subunit')) {
            return redirect()->back()->with('status', 'Subunit cannot be the same as the main truck.');
        }

        // Check for date conflicts excluding the current subunit being edited
        $dateConflicts = Truck_subunit::where('id', '!=', $id)
            ->where('main_truck', $request->input('main_truck'))
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
                        ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);
                })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('subunit', $request->input('subunit'))
                            ->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
                            ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);
                    });
            })
            ->exists();

        if ($dateConflicts) {
            return redirect()->back()->with('error', 'Date conflicts with existing subunits.');
        }

        // Check if the main truck is not a subunit of the subunit excluding the current subunit being edited
        $subunitOfSubunit = Truck_subunit::where('id', '!=', $id)
            ->where('main_truck', $request->input('subunit'))
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->input('start_date'), $request->input('end_date')])
                    ->orWhereBetween('end_date', [$request->input('start_date'), $request->input('end_date')]);
            })
            ->exists();

        if ($subunitOfSubunit) {
            return redirect()->back()->with('error', 'The subunit truck has a another subunit during that period');
        }

        // Update the existing subunit
        $subunit = Truck_subunit::findOrFail($id);
        $subunit->update($request->all());

        return redirect()->route('subunit.index')->with('status', 'Subunit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truck = Truck_subunit::find($id);
        try {
            $truck->delete();
            return redirect()->route('subunit.index')
                ->with('status', 'Subunit has been deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('subunit.index')
                ->with('status', 'Subunit has not been deleted ' . $e->getMessage());
        }
    }
}
