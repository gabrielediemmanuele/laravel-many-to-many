@extends('layouts.app')

{{--* font awesome  --}}
@section('font-awesome')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

{{--* CONTENT --}} 
@section('content')
<div class="container mt-5">
    Lista
    <a href="{{ route('admin.projects.create')}}" class="btn btn-primary">
      + Add new projeect
    </a>
</div>

<div class="container mt-5">
{{-- @dump($projects) --}}
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Author</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Date</th>
        <th scope="col">Link</th>
        <th scope="col">Type</th>
        <th scope="col">Description</th>
        <th scope="col">Create At</th>
        <th scope="col">Update At</th>
        <th scope="col">Details</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($projects as $project)
      <tr>
        <td>{{$project->id}}</td>
        <td>{{$project->author}}</td>
        <td>{{$project->title}}</td>
        <td>{{$project->slug}}</td>
        <td>{{$project->date}}</td>
        <td><a href="{{$project->link}}">Vai alla repo</a></td>
        <td>{{$project->type?->label}}</td>
        <td><a href="{{ route('admin.projects.show', $project)}}">Visualizza Descrizione</a></td>
        <td>{{$project->created_at}}</td>
        <td>{{$project->updated_at}}</td>
        <td>
          <a href="{{ route('admin.projects.show', $project)}}">
            <i class="fa-solid fa-up-right-from-square"></i>
          </a>
        </td>
        <td> 
          <a href="{{ route('admin.projects.edit', $project)}}" class="text-success">
              <i class="fa-solid fa-pen-to-square"></i>
          </a>
        </td>
        <td>
          <a href="#" class="mx-1" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}">
            <i class="fa-solid fa-trash-arrow-up fa-xl text-danger"></i>
          </a>
          {{--* MODAL --}}
          <div class="modal fade" id="delete-modal-{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina Comics</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   Do you want to delete "<strong>{{$project->title}}</strong>"? Click <span class="text-danger">"Delete"</span> to continue or go <span class="text-primary">"Back"</span>  to projects.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Back</button>

                  <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="mx-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
              @empty 
                  <tr>
                    <td> <i> Non ci sono progetti.</i></td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        {{ $projects->links('pagination::bootstrap-5')}}
    </div>
@endsection