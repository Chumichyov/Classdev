<header class="pt-2 border-bottom bg-white">
    <div class="container ">
        <ul class="nav d-flex flex-wrap justify-content-center flex-nowrap">
            <li class="nav-item">
                <a class="nav-link px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.show' ? 'bottom-line' : '' }}"
                    aria-current="page" href="{{ route('course.show', $course) }}">Задания</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.user.index' ? 'bottom-line' : '' }}"
                    aria-current="page" href="{{ route('course.user.index', $course) }}">Участники</a>
            </li>
            @can('view', $course)
                <li class="nav-item">
                    <a class="nav-link px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.grade.index' ? 'bottom-line' : '' }}"
                        aria-current="page" href="{{ route('course.grade.index', $course) }}">Оценки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.setting.index' ? 'bottom-line' : '' }}"
                        aria-current="page" href="{{ route('course.setting.index', $course) }}">Настройки</a>
                </li>
            @endcan
        </ul>
    </div>
</header>
