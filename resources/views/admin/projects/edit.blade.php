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

            {{--* per caricare l'immagine --}} 
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-8"> 
                        <label for="cover_image" class="form-label">Cover Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" value="{{ old('cover_image') }}">
                        @error('cover_image')
                            <div class="invalid-feedback">
                                {{ $message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="" class="img-fluid" id="cover_image_preview">
                    </div>
                </div>
            </div>

            @if ($project->cover_image)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger delete-image-button">
                    <i class="fa-solid fa-trash" id="delete-image-button"></i>
                    <span class="visually-hidden">delete image</span>
                </span>
            @endif

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

           {{--* CHECKBOXS per selezionare la\le Technology --}}
           <label class="form-label">Technologies</label>
           <div class="form-check bg-light text-primary p-3">
                <div class="row">
                    @foreach ($technologies as $technology)
                    <div class="col-3 mb-3">
                        <input type="checkbox" 
                            id="technology-{{ $technology->id }}"
                            value="{{ $technology->id }}"
                            name="technologies[]"
                            class="form-check-control"
                            @if (in_array($technology->id, old('technologies', $project_technologies))) checked @endif
                        >
                        <label for="technology-{{ $technology->id }}">
                            {{ $technology->tech_name }}
                        </label>
                    </div>
                    @endforeach
                </div>
           </div>
           @error('technologies')
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
    <script type='text/javascript'>
        /*  prendo l'id della stringa che contiene l'immagine*/
        const inputFileElement = document.getElementById('cover_image');
        /* mi aggancio all'id che conterrà la preview */
        const coverImagePreview = document.getElementById('cover_image_preview');
        /* se la preview non ha src (vuoto) lo sostituisco con un placeholder */
        if (!coverImagePreview.getAttribute('src') || coverImagePreview.getAttribute('src') == "http://127.0.0.1:8000/storage") {
            coverImagePreview.src = "https://placehold.co/400";
        }
        /* al cambio di immagine costruisco anche l'url per la preview  */
        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            /*generiamo un url / blob e lo inseriamo nel src per far vedere che la prev si aggiorna*/
            coverImagePreview.src = URL.createObjectURL(file);
        })
    </script>

    @if ($project->cover_image)
        <script>
            const deleteImageButton = document.getElementById('delete-image-button');
            const deleteImageForm = document.getElementById('delete-image-form');
            
            deleteImageButton.addEventListener('click', function() {
                deleteImageForm.submit();
            })
        </script>
    @endif
@endsection