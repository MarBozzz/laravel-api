@extends('layouts.app')


@section('title')
    | Admin
@endsection

@section('content')
<div class="container w-50 d-flex flex-column justify-content-center align-items-center ">
    @if (session('message'))
        <div class="alert alert-success w-100 text-center" role="alert">
            {{session('message')}}
        </div>
    @endif
    <div class="wrapper d-flex">
        <div class="card my-3 text-center">
            @if ($project->cover_image)
                <div class="px-2 pt-2">
                    <img src="{{asset('storage/' . $project->cover_image)}}" alt="{{$project->cover_image_original_name}}">
                    <div><i>Image Original Name: {{$project->cover_image_original_name}}</i></div>
                </div>
            @endif
            {{-- <img src="{{$project->cover_image}}" class="card-img-top" alt="{{$project->name}}"> --}}
            <div class="card-body pb-3">
            <h2 class="card-title text-center  text-capitalize text-black">Project Name: {{$project->name}}</h2>

            @if ($project->type)
                <h4>Project Type: {{ $project->type->name }}</h4>
            @endif

            @if ($project->technologies)
                <div>
                    @foreach ($project->technologies as $technology )
                        <span class="badge text-bg-warning py-2 my-3">{{$technology->name}}</span>
                    @endforeach
                </div>
            @endif

            <h5 class="card-title text-capitalize">Client name: {{$project->client_name}}</h5>
            <p class="card-text">Summary:{!!$project->summary!!}</p>
            </div>
        </div>

        <div class="mx-3 d-flex flex-column justify-content-center">
            <span class="actions d-inline-block text-white text-center">&darr;&ensp;Actions&ensp;&darr;</span>
            <a class="btn btn-warning d-flex flex-column" href="{{ route('admin.projects.edit', $project) }}"><i class="fa-solid fa-pen-to-square"></i><span>Edit this Project</span></a>
            <div class="my-1">
                @include('admin.partials.form-delete',[
                    'route' => 'projects',
                    'message' => "Please confirm you want to delete: $project->name",
                    'entity' => $project
                ])
            </div>
            <a class="btn btn-primary d-flex flex-column" href="{{route('admin.projects.index')}}" ><i class="fa-regular fa-newspaper"></i><span>Back to Projects</span></a>
        </div>
    </div>



</div>



@endsection
