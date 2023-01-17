@extends('layouts.course')
@section('content')
    <div class="position-relative">
        <div class="container" style="max-width: 900px">
            <h1 class="text-center">Настройки <a class="text-decoration-underline"
                    href="{{ route('task.show', ['course' => $course, 'task' => $task]) }}">Задания</a>
            </h1>
            <form action="{{ route('task.update', ['course' => $course, 'task' => $task]) }}" method="POST" class="mt-3">
                @csrf
                @method('patch')
                <div class="form-outline mb-4">
                    <input id="title" type="title" class="form-control @error('title') is-invalid @enderror"
                        name="title" value="{{ old('title') != null ? old('title') : $task->title }}" required
                        autocomplete="title">
                    <label class="" for="title">Название</label>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-outline mb-4">
                    <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror"
                        name="description" required autocomplete="description">{{ old('description') != null ? old('description') : $task->description }}</textarea>
                    <label class="" for="description">Описание</label>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <select class="form-control" id="themeId" name="themeId">
                                <option {{ $task->theme_id == null ? 'selected' : '' }} value="">
                                    Без темы
                                </option>
                                @foreach ($themes as $theme)
                                    <option {{ $task->theme_id == $theme->id ? 'selected' : '' }}
                                        value="{{ $theme->id }}">
                                        {{ $theme->title }}</option>
                                @endforeach
                            </select>
                            <label class="" for="theme_id">Тема</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <select class="form-control" id="type_id" name="type_id">
                                @foreach ($types as $type)
                                    <option {{ $task->type_id == $type->id ? 'selected' : '' }}
                                        value="{{ $type->id }}">
                                        {{ $type->title }}</option>
                                @endforeach
                            </select>
                            <label class="" for="type_id">Тип</label>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadFileModal">
                        Загрузить
                    </button>
                    <button type="submit" class="btn btn-primary btn-block">
                        Изменить
                    </button>
                </div>
            </form>

            <div class="w-100">
                <div class="row">
                    @foreach ($task->files as $file)
                        @if ($file->extension === 'pdf')
                            <div class="col-md-6 mt-4 d-flex justify-content-between">
                                <div
                                    class="w-100 d-flex justify-content-start align-items-center border rounded-start position-relative">
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
                            </div>
                        @elseif ($file->extension === 'docx' || $file->extension === 'doc')
                            <div class="col-md-6 mt-4 d-flex justify-content-between">
                                <div
                                    class="w-100 d-flex justify-content-start align-items-center border rounded-start position-relative">
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
                            </div>
                        @elseif ($file->extension === 'png' ||
                            $file->extension === 'tiff' ||
                            $file->extension === 'jpg' ||
                            $file->extension === 'jpeg')
                            <div class="col-md-6 mt-4 d-flex justify-content-between">

                                <div
                                    class="w-100 d-flex justify-content-start align-items-center border rounded-start position-relative">
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
                                        href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"></a>
                                </div>
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
                            </div>
                        @elseif ($file->extension === 'txt' ||
                            $file->extension === 'html' ||
                            $file->extension === 'css' ||
                            $file->extension === 'js')
                            <div class="col-md-6 mt-4 d-flex justify-content-between">
                                <div
                                    class="w-100 d-flex justify-content-start align-items-center border rounded-start position-relative">
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

                                    <a class="position-absolute top-0 bottom-0 start-0 end-0"
                                        href="{{ route('task.file.show', ['course' => $course, 'task' => $task, 'file' => $file->id]) }}"></a>
                                </div>
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
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="w-100 pt-4 border-top mt-4  ">
                <button type="button" class="btn btn-danger btn-block"
                    onclick="event.preventDefault();
                    document.getElementById('delete-task').submit();">
                    Удалить задание
                </button>
                <form action="{{ route('task.destroy', ['course' => $course, 'task' => $task]) }}" class="d-none"
                    method="POST" id="delete-task">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>

    @include('examples.setting.task.modal_upload_file')
@endsection
