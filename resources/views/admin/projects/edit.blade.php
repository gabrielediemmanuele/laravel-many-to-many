@extends('layouts.app')

@section('font-awesome')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container mb-5">
        <a href="{{ route('admin.projects.index')}}" class="btn btn-success mt-3 mb-4"> 
            Back to Projects
        </a>
        <a href="{{ route('admin.projects.show', $project)}}" class="btn btn-success mt-3 mb-4"> 
            Show Details
        </a>
        <h1 class="text-success mb-3">Edit Project</h1>
        {{--* Validator conditions to show at screen error message - go to controllers > ComicController > n°49  --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Correggi i seguenti errori: </h3>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--! form con metodo post che si collega alla funzione store di comicsController --}}
        <form class="row g-3" action="{{ route('admin.projects.update', $project) }}" method="POST" >
            @csrf
            @method('PATCH') 
            {{-- for visualize correct the form use @csrf protect from fake dates --}}

            <div class="col-4">
                <label for="author" class="form-label">Author</label>
                <input type="text" id="author" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') ?? $project->author }}">
                {{--* error method  --}}
                @error('author')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $project->title }}">
                {{--* error method  --}}
                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-4">
                <label for="date" class="form-label">Date</label>
                <input type="text" id="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') ?? $project->date }}">
                {{--* error method  --}}
                @error('date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-4">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ?? $project->slug }}">
                {{--* error method  --}}
                @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{--* PROVA INSERIMENTO DEL TIPO --}}
           <label for="type_id" class="form-label">Type</label>
           <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
             <option value="">-- No type --</option>
             @foreach ($types as $type)
               <option value="{{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif>{{ $type->label }}
               </option>
             @endforeach
           </select>
           @error('type_id')
             <div class="invalid-feedback">
               {{ $message }}
             </div>
           @enderror

            <div class="col-8">
                <label for="link" class="form-label">Link</label>
                <input type="text" id="link" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') ?? $project->link }}">
                {{--* error method  --}}
                @error('link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') ?? $project->description }}">{{ old('description') ?? $project->description }}</textarea>
                {{--* error method  --}}
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-3">
                <button class="btn btn-success">Edit +
                    <i class="fa-solid fa-pencil fa-sm mx-2 text-light"></i>
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    const thumbPrev = document.getElementById('thumb-preview');
    const thumbInput = document.getElementById('thumb');

    thumbInput.addEventListener('change', function(){
        thumbPrev.src = this.value;
    })
</script>
@endsection