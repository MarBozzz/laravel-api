<nav class="">
    <ul class="p-0">
        <li class="mt-3">
            <a class="mb-nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-pen-to-square"></i> Dashboard</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{ route('admin.projects.index') }}"><i class="fa-solid fa-pen-to-square"></i> My Projects</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-pen-to-square"></i>New Project</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{ route('admin.types_project') }}"><i class="fa-solid fa-pen-to-square"></i>Type/Project</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{route('admin.types.index')}}"><i class="fa-solid fa-folder-open"></i> Manage Types</a>
        </li>
    </ul>
</nav>
