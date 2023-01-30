<nav class="aside-nav">
    <ul class="p-0">
        <li class="mt-3">
            <a class="mb-nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-line me-1"></i>&ensp;Dashboard</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{ route('admin.projects.index') }}"><i class="fa-regular fa-newspaper"></i>&ensp;My Projects</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-plus"></i>&ensp;New Project</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{ route('admin.types_project') }}"><i class="fa-solid fa-flag"></i>&ensp;Type/Project</a>
        </li>
        <li class="">
            <a class="mb-nav-link" href="{{route('admin.types.index')}}"><i class="fa-solid fa-folder-open"></i>&ensp;Types</a>
        </li>
        <li class="">
           <a class="mb-nav-link" href="{{route('admin.technologies.index')}}"><i class="fa-solid fa-bookmark"></i>&ensp;Technologies</a>
        </li>
    </ul>
</nav>
