@extends('layouts.app')


@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 d-flex flex-column">
    @if (session('message'))
        <div class="alert alert-success text-center" role="alert">
            {{session('message')}}
        </div>
    @endif
    <h1 class="text-center my-5">Edit <strong class="">{{$project->name}}</strong> Project</h1>
    <div class="row d-flex">
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="text-white" action="{{route('admin.projects.update',$project)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name',$project->name)}}" placeholder="Insert name">
                @error('name')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" name="type_id" aria-label="Default select example">
                    <option value="">Select type</option>
                        @foreach ($types as $type)
                            <option @if($type->id == old( 'type_id', $project->type?->id )) selected @endif
                                value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                </select>
            </div>

            <div class="mb-3">
                <p for="technology" class="form-label">Technology</p>
                @foreach ($technologies as $technology)
                    <input type="checkbox"
                    id="technology{{ $loop->iteration }}"
                    name="technologies[]"
                    value="{{ $technology->id }}"
                    @if (!$errors->all() && $project->technologies->contains($technology))
                        checked
                    @elseif ($errors->all() && in_array($technology->id, old('technologies',[])))
                        checked
                    @endif
                    >
                    <label class="me-2" for="technology{{ $loop->iteration }}">{{ $technology->name }}</label>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Image *</label>
                <input
                onchange="showImage(event)"
                type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image"  value="{{old('cover_image',$project->cover_image)}}" placeholder="Insert URL image">
                @error('cover_image')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror
                <div class="image mt-2">
                    <img id="output-image" width="150" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{$project->cover_image_original_name}}">
                </div>
            </div>

            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name *</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name" id="client_name"  value="{{old('client_name',$project->client_name)}}" placeholder="Insert Client Name">
                @error('client_name')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-3 text-black">
                <label for="summary" class="form-label text-white">Summary *</label>
                <textarea class="form-control @error('summary') is-invalid @enderror" name="summary" id="summary" rows="3">{{old('summary',$project->summary)}}</textarea>
                @error('summary')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="buttons mb-2">
                <button type="submit" class="btn btn-success mb-0">Send Edit</button>
                <a class="btn btn-warning mt-2" href="{{ route('admin.projects.show', $project) }}">Discard Edit</a>
            </div>
        </form>
        <div class="d-inline">
            @include('admin.partials.form-delete',[
                'route' => 'projects',
                'message' => "Please confirm you want to delete: $project->name",
                'entity' => $project
            ])
        </div>
    </div>
</div>


<script>
    ClassicEditor
            .create( document.querySelector( '#summary' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            })
            .catch( error => {
                console.error( error );
            } );

    function showImage(event){
        const tagImage = document.getElementById('output-image');
        tagImage.src = URL.createObjectURL(event.target.files[0]);
    }

    </script>
@endsection
