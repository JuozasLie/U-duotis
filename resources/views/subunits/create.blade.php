@extends('layout')

@section('title', 'Subunits')

@section('content')
    <div class="row g-0 text-black">
        @if(Session::has('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ Session::get('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('subunit.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="main_truck" class="control-label mb-1"> Main truck </label>
                <select class="form-select" name="main_truck" id="main_truck" required>
                    @if (old('main_truck') != '')
                        <option>Select a main truck</option>
                    @else
                        <option selected>Select a main truck</option>
                    @endif
                    @foreach($trucks as $truck)
                        @if (old('main_truck') == $truck->id)
                            <option value="{{$truck->id}}" selected>{{$truck->unit_number}}</option>
                        @else
                            <option value="{{$truck->id}}">{{$truck->unit_number}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="subunit" class="control-label mb-1"> Subunit truck </label>
                <select class="form-select" name="subunit" id="subunit" required>
                    @if (old('subunit') != '')
                        <option>Select a subunit truck</option>
                    @else
                        <option selected>Select a subunit truck</option>
                    @endif
                    @foreach($trucks as $truck)
                        @if (old('subunit') == $truck->id)
                            <option value="{{$truck->id}}" selected>{{$truck->unit_number}}</option>
                        @else
                            <option value="{{$truck->id}}">{{$truck->unit_number}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" min="{{$min_date}}" placeholder="01-12-2023" required value="{{ old('start_date') ?? old('start_date')  ?? '' }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" min="{{$min_date}}" placeholder="01-12-2023" required value="{{ old('end_date') ?? old('end_date')  ?? '' }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-25">Create</button>
        </form>
    </div>
@endsection
