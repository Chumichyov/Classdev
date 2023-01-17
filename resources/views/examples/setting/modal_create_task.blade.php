<div class="modal fade" id="createTask" aria-hidden="true" data-bs-backdrop="static" aria-labelledby="createTaskLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createTaskLabel">Создание</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center fs-4">Выберите что вы хотете создать</div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary" data-bs-target="#taskModal" data-bs-toggle="modal">Задание</button>
                <button class="btn btn-primary" data-bs-target="#materialModal" data-bs-toggle="modal">Материал</button>
                <button class="btn btn-primary" data-bs-target="#themeModal" data-bs-toggle="modal">Тема</button>
            </div>
        </div>
    </div>
</div>

{{-- Тема --}}
<div class="modal fade" data-bs-backdrop="static" id="themeModal" tabindex="-1" aria-labelledby="themeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="themeModalLabel">Тема</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="POST" action="{{ route('task.store', ['course' => $course]) }}">
                @csrf
                <div class="modal-body">
                    <div class="row mb-2">
                        <label for="theme" class="col-md-3 col-form-label text-md-end">{{ __('Название') }}</label>

                        <div class="col-md-8">
                            <input id="theme" type="text"
                                class="form-control @error('theme') is-invalid @enderror" name="theme"
                                value="{{ old('theme') }}" required autocomplete="theme" autofocus>

                            @error('theme')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#createTask"
                        data-bs-toggle="modal">Назад</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Задание --}}
<div class="modal modal-lg fade" data-bs-backdrop="static" id="taskModal" tabindex="-1"
    aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Задание</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="POST" action="{{ route('task.store', ['course' => $course]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="title" class="col-md-2 col-form-label text-md-end">{{ __('Название') }}</label>

                        <div class="col-md-9">
                            <input id="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="type_id" value="2">

                    <div class="row mb-3">
                        <label for="description"
                            class="col-md-2 col-form-label text-md-end">{{ __('Описание') }}</label>

                        <div class="col-md-9">
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="theme_id" class="col-md-2 col-form-label text-md-end">{{ __('Тема') }}</label>
                        <div class="col-md-9">
                            <select class="form-control" id="theme_id" name="theme_id">
                                <option {{ old('theme_id') == null ? ' selected' : '' }} value="">
                                    Без темы
                                </option>
                                @foreach ($themes as $theme)
                                    <option {{ old('theme_id') == $theme->id ? ' selected' : '' }}
                                        value="{{ $theme->id }}">
                                        {{ $theme->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="files" class="col-md-2 col-form-label text-md-end">{{ __('Файлы') }}</label>

                        <div class="col-md-9">
                            <input class="form-control @error('files') is-invalid @enderror" type="file"
                                name="files[]" placeholder="Выберите файлы" multiple>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#createTask"
                        data-bs-toggle="modal">Назад</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Материал --}}
<div class="modal modal-lg fade" id="materialModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="materialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Материал</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="POST" action="{{ route('task.store', ['course' => $course]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="title"
                            class="col-md-2 col-form-label text-md-end">{{ __('Название') }}</label>

                        <div class="col-md-9">
                            <input id="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="type_id" value="1">

                    <div class="row mb-3">
                        <label for="description"
                            class="col-md-2 col-form-label text-md-end">{{ __('Описание') }}</label>

                        <div class="col-md-9">
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="theme_id" class="col-md-2 col-form-label text-md-end">{{ __('Тема') }}</label>
                        <div class="col-md-9">
                            <select class="form-control" id="theme_id" name="theme_id">
                                <option {{ old('theme_id') == null ? ' selected' : '' }} value="">
                                    Без темы
                                </option>
                                @foreach ($themes as $theme)
                                    <option {{ old('theme_id') == $theme->id ? ' selected' : '' }}
                                        value="{{ $theme->id }}">
                                        {{ $theme->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="files" class="col-md-2 col-form-label text-md-end">{{ __('Файлы') }}</label>

                        <div class="col-md-9">
                            <input class="form-control @error('files') is-invalid @enderror" type="file"
                                name="files[]" placeholder="Выберите файлы" multiple>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#createTask"
                        data-bs-toggle="modal">Назад</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
