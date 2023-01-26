@extends('layouts.app')


@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 w-50 d-flex flex-column justify-content-center">
    <h1 class="text-center my-3 color-white">Projects</h1>

    @if (session('deleted'))
        <div class="alert alert-success" role="alert">
            {{session('deleted')}}
        </div>
    @endif


    <div class="table-wrapper w-100 d-flex flex-column align-items-center">

        <div class="row w-50 d-flex justify-content-center">
            <table class="table table-striped table-dark text-center my-5">
                <thead>
                  <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Project</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>
                            <td>{{$type->name}}</td>
                            <td>
                                <ul>
                                    @foreach ($type->projects as $project)
                                        <li><a href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <h2>NO RESULTS</h2>
                    @endforelse
                </tbody>
              </table>


        </div>
    </div>


</div>
@endsection
