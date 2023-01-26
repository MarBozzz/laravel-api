<form onsubmit="return confirm('Please confirm you want to permanently delete {{$project->name}}')" class="" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger w-100" title="delete" ><i class="fa-solid fa-trash-can"></i></button>
</form>

