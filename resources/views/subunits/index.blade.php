@extends('layout')

@section('title', 'Subunits')

@section('content')
    <div class="row g-0 justify-content-end">
        <div class="col-3 mb-1">
            <a href="{{ route('subunit.create') }}" type="button" class="btn btn-success w-100">New</a>
        </div>
    </div>
    <div class="row g-0">
        @if(Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Main truck Unit Number</th>
                <th scope="col">Main truck Year</th>
                <th scope="col">Subunit truck Unit Number</th>
                <th scope="col">Subunit truck Year</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trucks as $truck)
                <tr>
                    <td>{{ $truck->start_date }}</td>
                    <td>{{ $truck->end_date }}</td>
                    <td>{{ $truck->mainTruck->unit_number }}</td>
                    <td>{{ $truck->mainTruck->year }}</td>
                    <td>{{ $truck->subunitTruck->unit_number }}</td>
                    <td>{{ $truck->subunitTruck->year }}</td>
                    <td class="d-flex justify-content-between">
                        <a href="{{ route('subunit.edit', $truck->id) }}"><i class="bi bi-pencil-square pe-auto"></i></a>
                        <form id="delete-form-{{$truck->id}}" method="POST" action="{{route('subunit.destroy', $truck->id)}}">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" onclick="document.querySelector('#delete-form-{{$truck->id}}').submit()"><i class="bi bi-trash pe-auto"></i></a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
