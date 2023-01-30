@extends('layouts.app')

@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 w-50 d-flex flex-column justify-content-center">
    <h1 class="text-center my-3 color-white">Manage Types</h1>

    @if (session('message'))
        <div class="alert alert-success text-center" role="alert">
            {{session('message')}}
        </div>
    @endif

    {{-- CREATE --}}
    <div class="add-types">
        <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="New Type">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add Type</button>
            </div>
        </form>
    </div>
    {{-- EDIT-UPDATE --}}
    <table class="table table-striped table-dark text-center">
        <tr >
            <th class="w-50" scope="col">Type</th>
            <th scope="col">Types Count</th>
        </tr>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td class="d-flex">
                        <form class="d-flex" action="{{route('admin.types.update', $type)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input class="type-input border-0 mx-2" type="text" name="name" value="{{$type->name}}">
                            <button type="submit" class="btn btn-warning d-flex flex-column"><i class="fa-solid fa-pen-to-square"></i>Update</button>
                        </form>
                        <div class="d-inline mx-2">
                            {{-- DELETE --}}
                            @include('admin.partials.form-delete',[
                                'route' => 'types',
                                'message' => "Please confirm you want to delete: $type->name",
                                'entity' => $type
                            ])
                        </div>
                    </td>
                    <td>{{count($type->projects)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
