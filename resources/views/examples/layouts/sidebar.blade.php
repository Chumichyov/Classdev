<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
    <div class="offcanvas-header pe-4 ps-4">
        <button type="button" class="btn-close rounded-circle my" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <a class="navbar-brand mt-1 mb-1" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <div class="offcanvas-body pe-4 ps-4">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            @if (auth()->check())
                <li class="nav-item border-bottom">
                    <a class="nav-link active fz-18" aria-current="page" href="{{ route('course.index') }}">Все
                        курсы</a>
                </li>
            @endif
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fz-18"
                    data-bs-toggle="collapse" data-bs-target="#teacher-collapse" aria-expanded="false">
                    Преподаю
                </button>
                <div class="collapse" id="teacher-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        @foreach ($courses->where('leader_id', auth()->user()->id) as $courseTeacher)
                            <li class="mb-1">
                                <a href="{{ route('course.show', $courseTeacher->id) }}"
                                    class="points d-block fz-16 link-dark text-decoration-none rounded">{{ $courseTeacher->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed fz-18"
                    data-bs-toggle="collapse" data-bs-target="#student-collapse" aria-expanded="false">
                    Участвую
                </button>
                <div class="collapse" id="student-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        @foreach ($courses->where('leader_id', '<>', auth()->user()->id) as $courseStudent)
                            <li class="mb-1">
                                <a href="{{ route('course.show', $courseStudent->id) }}"
                                    class="points d-block fz-16 link-dark text-decoration-none rounded">{{ $courseStudent->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @if (auth()->check())
                @can('view', auth()->user())
                    <li class="nav-item">
                        <a class="nav-link active fz-16" aria-current="page" href="{{ route('admin.index') }}">Admin
                            Panel</a>
                    </li>
                @endcan
            @endif
        </ul>
    </div>
</div>
