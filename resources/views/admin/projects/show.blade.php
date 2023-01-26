@extends('layouts.app')


@section('title')
    | Admin
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center flex-column">
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif
    <div class="card my-5" style="width: 18rem;">
        @if ($project->cover_image)
            <div>
                <img src="{{asset('storage/' . $project->cover_image)}}" alt="{{$project->cover_image_original_name}}">
                <div><i>{{$project->cover_image_original_name}}</i></div>
            </div>
        @endif
        <img src="{{$project->cover_image}}" class="card-img-top" alt="{{$project->name}}">
        <div class="card-body">
        <h3 class="card-title text-center py-3">{{$project->name}}</h5>

        @if ($project->type)
            <h4>Type: {{ $project->type->name }}</h4>
        @endif

        @if ($project->technologies)
            <div>
                @foreach ($project->technologies as $technology )
                    <span class="badge text-bg-warning">{{$technology->name}}</span>
                @endforeach
            </div>
        @endif

        <h5 class="card-title">Client name: {{$project->client_name}}</h5>
        <p class="card-text py-3">Summary{!!$project->summary!!}</p>
        </div>
    </div>
    <a class="btn btn-warning mb-2" href="{{ route('admin.projects.edit', $project) }}">Edit this Project</a>
    <div class="d-inline">
        @include('admin.partials.form-delete',[
            'route' => 'projects',
            'message' => "Please confirm you want to delete: $project->name",
            'entity' => $project
        ])
    </div>
    <a class="btn btn-primary my-5" href="{{route('admin.projects.index')}}" >BACK TO PROJECTS</a>

</div>



@endsection
