<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class truck extends Model
{
    use HasFactory;
    protected $fillable = ['unit_number', 'year', 'notes'];
    public function subunits()
    {
        return $this->hasMany(truck_subunit::class, 'main_truck')->with('subunitTruck');
    }

    public function mainTrucks()
    {
        return $this->belongsToMany(Truck::class, 'truck_subunits', 'subunit', 'main_truck')
            ->withPivot('start_date', 'end_date')
            ->with('subunitTruck');
    }
}
