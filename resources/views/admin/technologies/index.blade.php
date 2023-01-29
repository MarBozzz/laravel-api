@extends('layouts.app')

@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 w-50 d-flex flex-column justify-content-center">
    <h1 class="text-center my-3 color-white">Manage Technologies</h1>

     @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif


{{-- CREATE --}}
<div class="">
    <form action="{{route('admin.technologies.store')}}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" placeholder="New Technology">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-circle-plus"></i>ADD</button>
        </div>
    </form>
</div>
{{-- EDIT-UPDATE --}}
<table class="table table-striped table-dark text-center">
    <tr >
        <th class="w-75" scope="col">Technology</th>
        <th scope="col">Technologies Count</th>
    </tr>
    <tbody>
        @foreach ($technologies as $technology)
            <tr>
                <td class="d-flex">
                    <form action="{{route('admin.technologies.update', $technology)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input class="border-0" type="text" name="name" value="{{$technology->name}}">
                        <button type="submit" class="btn btn-warning">UPDATE</button>
                    </form>
                    <div class="d-inline">

                        {{-- DELETE --}}
                        @include('admin.partials.form-delete',[
                            'route' => 'technologies',
                            'message' => "Please confirm you want to delete: $technology->name",
                            'entity' => $technology
                        ])
                    </div>
                </td>
                <td>{{count($technology->projects)}}</td>
            </tr>
        @endforeach
    </tbody>
 </table>
</div>
@endsection
