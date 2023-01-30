@extends('layouts.app')


@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 w-75 d-flex flex-column justify-content-center">
    <h1 class="text-center my-3 color-white">Projects</h1>

    @if (session('deleted'))
        <div class="alert alert-success text-center" role="alert">
            {{session('deleted')}}
        </div>
    @endif


    <div class="table-wrapper w-100 d-flex flex-column align-items-center">
        <h3 class="mt-3">Total projects: {{$projects->total()}}</h3>

        <div class="row w-75 d-flex justify-content-center">
            <table class="table table-striped table-dark text-center my-5">
                <thead>
                  <tr>
                    <th scope="col"  class="">
                        <a href="{{ route('admin.projects.orderby',['id',$direction]) }}">ID</a>
                    </th>
                    <th scope="col" class="">
                        <a href="{{ route('admin.projects.orderby',['name',$direction]) }}">Project Name</a>
                    </th>
                    <th scope="col" class="technology">Technology</th>
                    <th scope="col" class="">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>{{$project->id}}</td>
                            <td>{{$project->name}}
                                &ensp; <span class="badge ">{{ $project->type?->name }}</span></td>
                            <td class="">@forelse ($project->technologies as $technology)
                                <span class="badge text-bg-warning">{{$technology->name}}</span>
                            @empty
                                <span class="text-center">No Results</span>
                            @endforelse</td>
                            <td class="d-flex justify-content-end">
                                <a class="btn btn-primary d-flex flex-column" href="{{route('admin.projects.show', $project)}}" title="show"><i class="fa-solid fa-circle-info"></i><span>View</span></a>
                                <a class="btn btn-warning mx-2 d-flex flex-column" href="{{route('admin.projects.edit', $project)}}" title="edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                                <div class="d-inline">
                                    @include('admin.partials.form-delete',[
                                        'route' => 'projects',
                                        'message' => "Please confirm you want to delete: $project->name",
                                        'entity' => $project
                                    ])
                                </div>
                            </td>
                        </tr>
                    @empty
                        <h2 class="text-center">No Results</h2>
                    @endforelse
                </tbody>
              </table>
              <div class="">
                  {{$projects->links()}}
              </div>
            <div class="d-flex justify-content-center">
                <a class="text-white new-project btn btn-success mb-5" href="{{route('admin.projects.create')}}">Create New Project</a>
            </div>
        </div>
    </div>

    {{-- <div class="row d-flex">
        @forelse ($projects as $project)
        <div class="col-6 d-flex justify-content-center py-5">
            <div class="card" style="width: 18rem;">
                <img src="{{$project->cover_image}}" class="card-img-top" alt="{{$project->name}}">
                <div class="card-body">
                    <h3 class="card-title py-3 text-center">{{$project->name}}</h5>
                    <p class="card-text">{{$project->id}}</p>
                    <p class="card-text">{{$project->summary}}</p>
                    <div class="d-flex flex-column">
                        <a class="btn btn-primary " href="{{route('admin.projects.show', $project)}}" title="show">See Details >></a>
                        <a class="btn btn-success my-2" href="{{route('admin.projects.edit', $project)}}" title="edit">Edit Project</a>
                        <div class="w-100">
                            @include('admin.partials.delete-form')
                        </div>

                    </div>

                </div>
            </div>
        </div>

    @empty
       <h2>NO RESULTS</h2>
    @endforelse

    </div> --}}
</div>
@endsection
