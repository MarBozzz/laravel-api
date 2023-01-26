@extends('layouts.app')


@section('title')
    | Admin
@endsection

@section('content')
<div class="container h-100 ">
    <h1 class="text-center my-5">Create a New Project</h1>
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

<form class="text-white" action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}" placeholder="Insert name">
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
                            <option
                                @if($type->id == old('type_id')) selected @endif
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
                    @if (in_array($technology->id, old('technologies',[])))
                        checked
                    @endif
                    >
                    <label class="me-2" for="technology{{ $loop->iteration }}">{{ $technology->name }}</label>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Image</label>
                <input
                onchange="showImage(event)"
                type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image"  value="{{old('cover_image')}}" placeholder="Insert image">
                @error('cover_image')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror
                <div class="image">
                    <img id="output-image" width="150" src="" alt="">
                </div>
            </div>

            <div class="mb-3">
                <label for="client_name" class="form-label">Client Name *</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name" id="client_name"  value="{{old('client_name')}}" placeholder="Insert Client Name">
                @error('client_name')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-3 text-black">
                <label for="summary" class="form-label">Summary *</label>
                <textarea name="summary" id="summary" rows="3">{{old('summary')}}</textarea>
                @error('summary')
                    <p  class="invalid-feedback">
                        {{$message}}
                    </p>
                @enderror

            <button type="submit" class="btn btn-primary mb-5">Invia</button>
        </form>
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
