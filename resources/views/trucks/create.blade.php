@extends('layout')

@section('title', 'Trucks')

@section('content')
    <div class="row g-0 text-black">
        @if(Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('trucks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="unit_number" class="form-label">Unit Number</label>
                <input type="text" class="form-control" name="unit_number" id="unit_number" maxlength="255" required value="{{ old('unit_number') ?? old('unit_number')  ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" name="year" id="year" required value="{{ old('year') ?? old('year')  ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') ?? old('notes')  ?? '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-25">Save</button>
        </form>
    </div>
@endsection
