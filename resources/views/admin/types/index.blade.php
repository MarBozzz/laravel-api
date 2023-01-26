@extends('layouts.app')

@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 w-50 d-flex flex-column justify-content-center">
    <h1 class="text-center my-3 color-white">Manage Types</h1>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <div class="">
        <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="New Type">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="fa-solid fa-circle-plus"></i>
                    ADD</button>
            </div>
        </form>
    </div>

    <table class="table table-striped table-dark text-center">
        <tr >
            <th class="w-75" scope="col">Type</th>
            <th scope="col">Type Count</th>
        </tr>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td class="d-flex">
                        <form action="{{route('admin.types.update', $type)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input class="border-0" type="text" name="name" value="{{$type->name}}">
                            <button type="submit" class="btn btn-warning">UPDATE</button>
                        </form>
                        <div class="d-inline">
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
