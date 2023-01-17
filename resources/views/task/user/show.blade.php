@extends('layouts.course')
@section('content')
    <div class="container" style="max-width: 900px">
        <div class="starter-template ms-auto me-auto">
            @if (empty($completed))
                <div class="w-100 text-center">
                    <h2>Пользователь {{ $user->name . ' ' . $user->surname }} не выполнил задание</h2>
                </div>
            @else
                <div class="w-100 {{ !empty($completed) ? '' : 'border-bottom' }} py-2">
                    <div class="W-100 d-flex align-items-center justify-content-between">
                        <span class="fs-5">{{ $task->type->title }}</span>
                    </div>
                    <h1>
                        <a class="link-dark"
                            href="{{ route('task.show', ['course' => $course, 'task' => $task]) }}">{{ $task->title }}</a>
                    </h1>
                    <p class="lead mb-0">{{ $task->description }}</p>
                    <div class="row mb-4">
                        @foreach ($task->files as $file)
                            @if ($file->extension === 'pdf')
                                <div class="col-md-6 mt-4">
                                    <a class="link link-dark"
                                        href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"">
                                        <div
                                            class="w-100 d-flex justify-content-start align-items-center border rounded position-relative">
                                            <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                style="width: 105px; height: 70px;">
                                                <img class="img-settings" style="width: 50px; height: 50px;"
                                                    src="{{ asset('icons/pdf.png') }}" alt="">
                                            </div>
                                            <div class="points flex-0-1-auto ps-2 pe-2">
                                                <div class="points">{{ $file->originalName }}</div>
                                                <div class="points">PDF</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif ($file->extension === 'docx' || $file->extension === 'doc')
                                <div class="col-md-6 mt-4">
                                    <a class="link link-dark"
                                        href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}">
                                        <div
                                            class="w-100 d-flex justify-content-start align-items-center border rounded position-relative">
                                            <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                style="width: 105px; height: 70px;">
                                                <img class="img-settings" style="width: 50px; height: 50px;"
                                                    src="{{ asset('icons/word.png') }}" alt="">
                                            </div>
                                            <div class="points flex-0-1-auto ps-2 pe-2">
                                                <div class="points">{{ $file->originalName }}</div>
                                                <div class="points">Word</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif ($file->extension === 'png' ||
                                $file->extension === 'tiff' ||
                                $file->extension === 'jpg' ||
                                $file->extension === 'jpeg')
                                <div class="col-md-6 mt-4">
                                    <a class="link link-dark"
                                        href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"
                                        target="_blank">
                                        <div
                                            class="w-100 d-flex justify-content-start align-items-center border rounded position-relative">
                                            <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                style="width: 105px; height: 70px;">
                                                <img class="img-settings" style="width: 50px; height: 50px;"
                                                    src="{{ asset($file->dataPath) }}" alt="">
                                            </div>
                                            <div class="points flex-0-1-auto ps-2 pe-2">
                                                <div class="points">{{ $file->originalName }}</div>
                                                <div class="points">Изображение</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @elseif ($file->extension === 'txt' ||
                                $file->extension === 'html' ||
                                $file->extension === 'css' ||
                                $file->extension === 'js')
                                <div class="col-md-6 mt-4">
                                    <a class="link link-dark"
                                        href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}">
                                        <div
                                            class="w-100 d-flex justify-content-start align-items-center border rounded position-relative">
                                            <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                style="width: 105px; height: 70px;">
                                                <img class="img-settings" style="width: 50px; height: 50px;"
                                                    src="@if ($file->extension == 'txt') {{ asset('icons/txt.png') }} @elseif ($file->extension == 'html') {{ asset('icons/html.png') }} @elseif ($file->extension == 'css') {{ asset('icons/css.png') }} @elseif ($file->extension == 'js') {{ asset('icons/js.png') }} @endif"
                                                    alt="">
                                            </div>
                                            <div class="points flex-0-1-auto ps-2 pe-2">
                                                <div class="points">{{ $file->originalName }}</div>
                                                <div class="points">Текстовый</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="fs-4 d-flex w-100 align-items-center justify-content-between">
                        <a class="link-dark points me-3"
                            href="{{ route('task.user.index', ['course' => $course, 'user' => $user]) }}">{{ $user->name . ' ' . $user->surname }}</a>

                        @if (!is_null($completed) && $completed->option_id == 2)
                            <button class="btn btn-primary" style="min-width: 83px" data-bs-toggle="modal"
                                data-bs-target="#returnModal">Вернуть</button>
                        @elseif(!is_null($completed) && $completed->option_id == 3)
                            <div class="fz-16 text-end" style="min-width: 85px">
                                {{ !is_null($completed->grade) ? 'Оценка: ' . $completed->grade : 'Без оценки' }}</div>
                        @endif
                    </div>


                    @if (!empty($completed))
                        <div class="row
                                mt-4">
                            @foreach ($completed->files as $path)
                                @if ($path->extension === 'pdf')
                                    <div class="col-md-6 mb-4">
                                        <a class="link link-dark"
                                            href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $path->id]) }}">
                                            <div class="d-flex justify-content-start align-items-center border rounded">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="{{ asset('icons/pdf.png') }}" alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $path->originalName }}</div>
                                                    <div class="points">PDF</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @elseif ($path->extension === 'docx' || $path->extension === 'doc')
                                    <div class="col-md-6 mb-4">
                                        <a class="link link-dark"
                                            href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $path->id]) }}">
                                            <div class="d-flex justify-content-start align-items-center border rounded">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="{{ asset('icons/word.png') }}" alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $path->originalName }}</div>
                                                    <div class="points">Word</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @elseif ($path->extension === 'png' ||
                                    $path->extension === 'tiff' ||
                                    $path->extension === 'jpg' ||
                                    $path->extension === 'jpeg')
                                    <div class="col-md-6 mb-4">
                                        <a class="link link-dark"
                                            href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $path->id]) }}"
                                            target="_blank">
                                            <div class="d-flex justify-content-start align-items-center border rounded">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="{{ asset($path->dataPath) }}" alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $path->originalName }}</div>
                                                    <div class="points">Изображение</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @elseif ($path->extension === 'txt' ||
                                    $path->extension === 'html' ||
                                    $path->extension === 'css' ||
                                    $path->extension === 'js')
                                    <div class="col-md-6 mb-4">
                                        <a class="link link-dark"
                                            href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $path->id]) }}">
                                            <div class="d-flex justify-content-start align-items-center border rounded">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="@if ($path->extension == 'txt') {{ asset('icons/txt.png') }} @elseif ($path->extension == 'html') {{ asset('icons/html.png') }} @elseif ($path->extension == 'css') {{ asset('icons/css.png') }} @elseif ($path->extension == 'js') {{ asset('icons/js.png') }} @endif"
                                                        alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $path->originalName }}</div>
                                                    <div class="points">Текстовый</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        {{-- @if (!is_null($completed->grade))
                            <div class="fz-16">Оценка: {{ $completed->grade }}</div>
                        @endif --}}
                    @endif

                </div>
                @if ($completed->option_id == 2)
                    <div class="modal fade" id="returnModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="returnModalLabel">Вернуть задание</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form
                                    action="{{ route('task.return', ['course' => $course, 'task' => $task, 'user' => $completed->user_id]) }}"
                                    method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <select class="form-select" aria-label="Default select example" name="grade">
                                            <option value="" selected>Без оценки</option>
                                            <option value="2">Оценка "Два"</option>
                                            <option value="3">Оценка "Три"</option>
                                            <option value="4">Оценка "Четыре"</option>
                                            <option value="5">Оценка "Пять"</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Закрыть</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-bs-dismiss="modal">Вернуть</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endsection
