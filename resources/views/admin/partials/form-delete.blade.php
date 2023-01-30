<button type="button" class="btn btn-danger d-flex flex-column" data-bs-toggle="modal" data-bs-target="#modal{{$entity->id}}">
    <i class="fa-solid fa-trash-can"></i><span>Delete</span>
</button>

<!-- Modal -->
<div class="modal fade text-black" id="modal{{$entity->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
            <h1 class="modal-title fs-5 text-black " id="exampleModalLabel">Deleting</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                 {{$message}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{route('admin.' . $route . '.destroy',$entity)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirm DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>
