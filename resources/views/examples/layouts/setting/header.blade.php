<header class="pt-2 border-bottom bg-white">
    <div class="container d-flex flex-wrap justify-content-center">
        <ul class="nav col-12 col-md-auto justify-content-center mb-md-0">
            <li class="nav-item">
                <a href="{{ route('course.setting.index', $course) }}"
                    class="nav-link active px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.setting.index' ? 'bottom-line' : '' }}">Тематика</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('course.setting.connection.index', $course) }}"
                    class="nav-link px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.setting.connection.index' ? 'bottom-line' : '' }}">Подключение</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('course.setting.task.index', $course) }}"
                    class="nav-link px-2 pb-3 link-dark my-text-13 position-relative {{ Route::currentRouteName() == 'course.setting.task.index' ? 'bottom-line' : '' }}">Задания</a>
            </li>
        </ul>
    </div>
</header>
