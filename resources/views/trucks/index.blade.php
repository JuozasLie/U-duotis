@extends('layout')

@section('title', 'Trucks')

@section('content')
    <div class="row g-0 justify-content-end">
        <div class="col-3 mb-1">
            <a href="{{ route('trucks.create') }}" type="button" class="btn btn-success w-100">New</a>
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
                <th scope="col">ID</th>
                <th scope="col">Unit Number</th>
                <th scope="col">Year</th>
                <th scope="col">Notes</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trucks as $truck)
                <tr>
                    <td>{{ $truck->id }}</td>
                    <td>{{ $truck->unit_number }}</td>
                    <td>{{ $truck->year }}</td>
                    <td>{{ $truck->notes }}</td>
                    <td class="d-flex justify-content-between">
                        <a href="{{ route('trucks.edit', $truck->id) }}"><i class="bi bi-pencil-square pe-auto"></i></a>
                        <form id="delete-form-{{$truck->id}}" method="POST" action="{{route('trucks.destroy', $truck->id)}}">
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
