{{-- Тема --}}
<div class="modal fade" data-bs-backdrop="static" id="themeModal" tabindex="-1" aria-labelledby="themeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="themeModalLabel">Тема</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('task.storeTheme', $course) }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>

                        <div class="col-md-6">
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
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Создать') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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
            <div class="modal-body">
                <form method="POST" action="{{ route('task.storeTask', $course) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>

                        <div class="col-md-6">
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

                    <div class="row mb-3">
                        <label for="description"
                            class="col-md-4 col-form-label text-md-end">{{ __('Описание') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description') }}" required autocomplete="description" autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="theme_id" class="col-md-4 col-form-label text-md-end">{{ __('Тема') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="theme_id" name="theme_id">
                                <option {{ old('theme_id') == null ? ' selected' : '' }} value="">Без темы
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
                        <label for="files" class="col-md-4 col-form-label text-md-end">{{ __('Файлы') }}</label>

                        <div class="col-md-6">
                            <input class="form-control @error('files') is-invalid @enderror" type="file"
                                name="files[]" placeholder="Выберите файлы" multiple>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Создать') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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
            <div class="modal-body">
                <form method="POST" action="{{ route('task.storeMaterial', $course) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="title"
                            class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>

                        <div class="col-md-6">
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

                    <div class="row mb-3">
                        <label for="description"
                            class="col-md-4 col-form-label text-md-end">{{ __('Описание') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description') }}" required autocomplete="description" autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="theme_id" class="col-md-4 col-form-label text-md-end">{{ __('Тема') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="theme_id" name="theme_id">
                                <option {{ old('theme_id') == null ? ' selected' : '' }} value="">Без темы
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
                        <label for="files" class="col-md-4 col-form-label text-md-end">{{ __('Файлы') }}</label>

                        <div class="col-md-6">
                            <input class="form-control @error('files') is-invalid @enderror" type="file"
                                name="files[]" placeholder="Выберите файлы" multiple>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Создать') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
