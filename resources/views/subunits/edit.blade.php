@extends('layout')

@section('title', 'Trucks')

@section('content')
    <div class="row g-0 text-black">
        @if(Session::has('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ Session::get('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('subunit.update', $subunit->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="main_truck" class="control-label mb-1"> Main truck </label>
                <select class="form-select" name="main_truck" id="main_truck" required>
                    @foreach ($trucks as $truck)
                        <option value="{{ $truck->id }}" {{ $subunit->main_truck == $truck->id ? 'selected' : '' }}>
                            {{ $truck->unit_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="subunit" class="control-label mb-1"> Subunit truck </label>
                <select class="form-select" name="subunit" id="subunit" required>
                    @foreach ($trucks as $truck)
                        <option value="{{ $truck->id }}" {{ $subunit->subunit == $truck->id ? 'selected' : '' }}>
                            {{ $truck->unit_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" min="{{$min_date}}" placeholder="01-12-2023" required value="{{$subunit->start_date}}">
                </div>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" min="{{$min_date}}" placeholder="01-12-2023" required value="{{$subunit->start_date}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-25">Update</button>
        </form>
    </div>
@endsection
