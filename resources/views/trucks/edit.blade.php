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
        <form action="{{ route('trucks.update', $truck->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="unit_number" class="form-label">Unit Number</label>
                <input type="text" class="form-control" name="unit_number" id="unit_number" maxlength="255" value="{{ $truck->unit_number }}" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" name="year" id="year" value="{{ $truck->year }}" required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $truck->notes }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-25">Update</button>
        </form>
    </div>
@endsection
