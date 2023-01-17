@extends('layouts.extended')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($courses as $course)
                <div class="my col-md-3 mb-4">
                    <div class="card ms-auto me-auto overflow-hidden" style="max-width: 330px">
                        <a class="d-block" href="{{ route('course.show', $course->id) }}">
                            <div class="position-relative">
                                <img class="card-img-top img-settings" src="{{ asset($course->info->imagePath) }}"
                                    style="height: 100px">
                                <div class="card-img-overlay p-2" style="background: rgba(108, 117, 125, .3)">
                                    <p class="card-text text-light points">
                                        {{ $course->users->find($course->leader_id)->name . ' ' . $course->users->find($course->leader_id)->surname }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-text points mb-2 text-dark">{{ $course->title }}</div>
                                <div class="card-text points text-dark">{{ $course->topic }}</div>
                            </div>
                        </a>
                        <div class="text-dark p-1 d-flex justify-content-end border-top" style="border-color: #d2d2d2;">
                            <a id="courseSetting" class="nav-link ms-2" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-three-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="courseSetting">
                                @can('view', $course)
                                    <a class="dropdown-item" href=""
                                        onclick="event.preventDefault();
                                    document.getElementById('course-delete').submit();">Удалить</a>
                                    <a class="dropdown-item"
                                        href="{{ route('course.setting.index', ['course' => $course]) }}">Настройки</a>

                                    <form id="course-delete" action="{{ route('course.destroy', ['course' => $course]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                @else
                                    <a class="dropdown-item" href=""
                                        onclick="event.preventDefault();
                                    document.getElementById('course-leave').submit();">Покинуть</a>

                                    <form id="course-leave" action="{{ route('course.leave', ['course' => $course]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
