@extends('layouts.course')
@section('content')
    <div class="container" style="max-width: 900px">
        <div class="starter-template ms-auto me-auto" style="max-width: 900px">
            <div class="w-100 d-flex justify-content-between align-items-center mb-2">
                <span class="fs-5">{{ $task->type->title }}</span>
                @can('view', $course)
                    <a href="{{ route('course.setting.task.show', ['course' => $course, 'task' => $task]) }}"
                        class="btn btn-primary">Настроить</a>
                @endcan
            </div>
            <h1>{{ $task->title }}</h1>
            <p class="fs-5 mb-0">{{ $task->description }}</p>
            <div class="row">
                @foreach ($task->files as $file)
                    @if ($file->extension === 'pdf')
                        <div class="col-md-6 mt-4">
                            <a class="link link-dark"
                                href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}">
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

            @if ($task->type->id != 1)
                @if (auth()->user()->id != $course->leader_id)
                    {{-- Возможность создать решение --}}
                    <div class="w-100 mt-4">
                        <div class="w-100 d-flex align-items-center justify-content-between">
                            <h3 class="mb-0">Мои задания</h3>
                            @if (!empty($completed))
                                @if ($completed->option_id == 1)
                                    <button class="btn btn-primary px-4 user-select-none" data-bs-toggle="modal"
                                        data-bs-target="#sendModal">Загрузить</button>
                                @elseif ($completed->option_id == 2)
                                    <div class="fs-5">
                                        Сдано
                                    </div>
                                @endif
                            @else
                                <button class="btn btn-primary px-4 user-select-none" data-bs-toggle="modal"
                                    data-bs-target="#sendModal">Загрузить</button>
                            @endif
                        </div>
                        @if (!empty($completed) && ($completed->option_id != 1 || ($completed->user_id = auth()->user()->id)))
                            <div class="row">
                                @foreach ($completed->files as $file)
                                    @if ($file->extension === 'pdf')
                                        <div class="col-md-6 mt-4 d-flex justify-content-between">
                                            <div
                                                class="w-100 d-flex justify-content-start align-items-center border {{ $file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id ? 'rounded-start' : 'rounded' }} position-relative">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="{{ asset('icons/pdf.png') }}" alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $file->originalName }}</div>
                                                    <div class="points">PDF</div>
                                                </div>

                                                <a class="position-absolute top-0 bottom-0 start-0 end-0"
                                                    href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"></a>
                                            </div>
                                            @if ($file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id)
                                                <div class="bg-danger p-2 text-white align-middle position-relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                    <a href="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        class="position-absolute top-0 bottom-0 start-0 end-0"
                                                        onclick="event.preventDefault();
                                                document.getElementById('file-destroy{{ $file->id }}').submit();"></a>
                                                    <form class="d-none" id="file-destroy{{ $file->id }}"
                                                        action="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif ($file->extension === 'docx' || $file->extension === 'doc')
                                        <div class="col-md-6 mt-4 d-flex justify-content-between">
                                            <div
                                                class="w-100 d-flex justify-content-start align-items-center border {{ $file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id ? 'rounded-start' : 'rounded' }} position-relative">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="{{ asset('icons/word.png') }}" alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $file->originalName }}</div>
                                                    <div class="points">Word</div>
                                                </div>

                                                <a class="position-absolute top-0 bottom-0 start-0 end-0"
                                                    href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"></a>
                                            </div>
                                            @if ($file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id)
                                                <div class="bg-danger p-2 text-white align-middle position-relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                    <a href="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        class="position-absolute top-0 bottom-0 start-0 end-0"
                                                        onclick="event.preventDefault();
                                                document.getElementById('file-destroy{{ $file->id }}').submit();"></a>
                                                    <form class="d-none" id="file-destroy{{ $file->id }}"
                                                        action="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif ($file->extension === 'png' ||
                                        $file->extension === 'tiff' ||
                                        $file->extension === 'jpg' ||
                                        $file->extension === 'jpeg')
                                        <div class="col-md-6 mt-4 d-flex justify-content-between">

                                            <div
                                                class="w-100 d-flex justify-content-start align-items-center border {{ isset($file->completed) && $file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id ? 'rounded-start' : 'rounded' }} position-relative">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="{{ asset($file->dataPath) }}" alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $file->originalName }}</div>
                                                    <div class="points">Изображение</div>
                                                </div>

                                                <a class="position-absolute top-0 bottom-0 start-0 end-0"
                                                    href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"
                                                    target="_blank"></a>
                                            </div>
                                            @if (isset($file->completed) &&
                                                $file->completed->option_id == 1 &&
                                                $file->completed->user_id == auth()->user()->id)
                                                <div class="bg-danger p-2 text-white align-middle position-relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                    <a href="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        class="position-absolute top-0 bottom-0 start-0 end-0"
                                                        onclick="event.preventDefault();
                                                document.getElementById('file-destroy{{ $file->id }}').submit();"></a>
                                                    <form class="d-none" id="file-destroy{{ $file->id }}"
                                                        action="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif ($file->extension === 'txt' ||
                                        $file->extension === 'html' ||
                                        $file->extension === 'css' ||
                                        $file->extension === 'js')
                                        <div class="col-md-6 mt-4 d-flex justify-content-between">
                                            <div
                                                class="w-100 d-flex justify-content-start align-items-center border {{ $file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id ? 'rounded-start' : 'rounded' }} position-relative">
                                                <div class="flex-0-0-105 border-end d-flex align-items-center justify-content-center"
                                                    style="width: 105px; height: 70px;">
                                                    <img class="img-settings" style="width: 50px; height: 50px;"
                                                        src="@if ($file->extension == 'txt') {{ asset('icons/txt.png') }} @elseif ($file->extension == 'html') {{ asset('icons/html.png') }} @elseif ($path->extension == 'css') {{ asset('icons/css.png') }} @elseif ($path->extension == 'js') {{ asset('icons/js.png') }} @endif"
                                                        alt="">
                                                </div>
                                                <div class="points flex-0-1-auto ps-2 pe-2">
                                                    <div class="points">{{ $file->originalName }}</div>
                                                    <div class="points">Текстовый</div>
                                                </div>

                                                <a class="position-absolute top-0 bottom-0 start-0 end-0"
                                                    href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"></a>
                                            </div>
                                            @if ($file->completed->option_id == 1 && $file->completed->user_id == auth()->user()->id)
                                                <div class="bg-danger p-2 text-white align-middle position-relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                    <a href="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        class="position-absolute top-0 bottom-0 start-0 end-0"
                                                        onclick="event.preventDefault();
                                                document.getElementById('file-destroy{{ $file->id }}').submit();"></a>
                                                    <form class="d-none" id="file-destroy{{ $file->id }}"
                                                        action="{{ route('task.file.destroy', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if (!empty($completed))
                            @if ($completed->option_id == 1)
                                <div class="mt-4 w-100 d-flex justify-content-end">
                                    <button class="btn btn-primary"
                                        onclick="event.preventDefault();
                                    document.getElementById('pass-task').submit();">Сдать
                                        задание</button>
                                    <form
                                        action="{{ route('task.completed.update', ['course' => $course, 'task' => $task, 'completed' => $completed]) }}"
                                        id="pass-task" class="d-none" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="option_id" value="2">
                                    </form>
                                </div>
                            @elseif ($completed->option_id == 2)
                                <div class="mt-4 w-100 d-flex justify-content-end">
                                    <button class="btn btn-primary"
                                        onclick="event.preventDefault();
                                    document.getElementById('cancel-task').submit();">Отменить
                                        отправку</button>
                                    <form
                                        action="{{ route('task.completed.update', ['course' => $course, 'task' => $task, 'completed' => $completed]) }}"
                                        id="cancel-task" class="d-none" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="option_id" value="1">
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                @else
                    {{-- Возможность просмотреть все решения по этому заданию --}}
                    <div class="w-100 mt-4">
                        @if (!empty($completed))
                            @if ($completed->where('option_id', '>', '1')->count() > 0)
                                <div class="W-100 d-flex align-items-center justify-content-between">
                                    <h3 class="mb-0">Сдано</h3>
                                </div>
                            @endif
                            <table class="table myaccordion table-hover mt-3" id="accordion">
                                <tbody style="max-width: 720px">
                                    @foreach ($completed as $path)
                                        @if ($path->option_id != 1)
                                            <tr class="position-relative">
                                                <td class="align-middle" style="width: 50px; height: 50px">
                                                    <img class="rounded-circle img-settings"
                                                        style="width: 34px; height: 34px"
                                                        src="{{ asset($path->user->about->photoPath) }}" alt="">
                                                    <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                                        href="{{ route('task.user.show', ['course' => $course, 'task' => $task, 'user' => $path->user]) }}"></a>
                                                </td>
                                                <td class="align-middle mw-597 me-auto">
                                                    {{ $path->user->name . ' ' . $path->user->surname }}
                                                </td>
                                                <td class="align-middle" style="width: 60px">
                                                    {{ $path->option->title }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @endif
            @endif
        </div>
    </div>
    @if ($course->leader_id != auth()->user()->id && (empty($completed) || $completed->option_id == 1))
        @include('examples.task.modal_upload_file')
    @endif
@endsection
