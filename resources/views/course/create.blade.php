@extends('layouts.extended')
@section('content')
    <div class="container" style="max-width: 900px">
        <div class="card">
            <div class="card-body py-4 px-md-4">
                <div class="text-dark mb-3 text-center">
                    <h4>Создание курса</h4>
                </div>
                <form method="POST" action="{{ route('course.store', ['type' => 'create']) }}">
                    @csrf

                    <div class="form-outline mb-4">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                        <label class="" for="title">Название</label>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <input id="topic" type="text" class="form-control @error('topic') is-invalid @enderror"
                            name="topic" value="{{ old('topic') }}" required autocomplete="topic" autofocus>
                        <label class="" for="topic">Тема</label>
                        @error('topic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                        <label class="" for="description">Описание</label>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-block">
                            Создать
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body py-4 px-md-4">
                <div class="text-dark mb-3 text-center">
                    <h4>Присоединиться</h4>
                </div>
                <div class="text-dark text-center fs-5 mb-3">
                    По коду доступа вы можете присоединиться к курсу
                </div>
                <form method="POST" action="{{ route('course.store', ['type' => 'code']) }}">
                    @csrf
                    <div class="form-outline">
                        <input id="code" type="text"
                            class="form-control @error('code') is-invalid @enderror @if (session('type') == 'code' && session('error')) is-invalid @endif"
                            name="code"
                            @if (old('code')) value="{{ old('code') }}" @elseif (session('value')) value="{{ session('value') }}" @endif
                            required autocomplete="code" autofocus>
                        <label class="" for="code">Код</label>
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if (session('type') == 'code')
                        @if (session('success'))
                            <div class="text-success mt-1">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @elseif (session('error'))
                            <div class="text-danger mt-1">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif
                    @endif
                    <div class="w-100
                            d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            Присоединиться
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body py-4 px-md-4">
                <div class="text-dark mb-3 text-center">
                    <h4>Приглашения</h4>
                </div>
                <div class="text-dark text-center fs-5 mb-3">
                    Список курсов, в которые вас пригласили
                </div>
                <div class="row justify-content-center">
                    @foreach ($invitations as $invitation)
                        <div class="col-sm-5 mb-4">
                            <div class="card ms-auto me-auto position-relative" style="max-width: 330px">
                                <div class="position-relative">
                                    <img class="card-img-top img-settings"
                                        src="{{ asset($invitation->course->info->imagePath) }}" style="height: 100px">
                                    <div class="card-img-overlay p-2" style="background: rgba(108, 117, 125, .3)">
                                        <p class="card-text text-light points">
                                            {{ $invitation->course->users->find($invitation->course->leader_id)->name . ' ' . $invitation->course->users->find($invitation->course->leader_id)->surname }}
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-text points mb-2 text-dark">{{ $invitation->course->title }}
                                    </div>
                                    <div class="card-text points text-dark">{{ $invitation->course->topic }}</div>
                                </div>
                                <div class="hover position-absolute top-0 bottom-0
                                start-0 w-50 text-center"
                                    onclick="event.preventDefault();
                                document.getElementById('invitation{{ $invitation->course->id }}-delete').submit();">
                                    <a class="h-100" style="background: rgba(13, 110, 253, .6)"><strong
                                            class="text-white d-block p-4">Отклонить</strong></a>
                                </div>
                                <div class="hover position-absolute top-0 bottom-0
                                    end-0 w-50 text-center"
                                    onclick="event.preventDefault();
                                    document.getElementById('invitation{{ $invitation->course->id }}-enter').submit();">
                                    <a class="h-100" style="background: rgba(13, 110, 253, .6)"><strong
                                            class="text-white d-block p-4">Принять</strong></a>
                                </div>
                                <form method="POST"
                                    action="{{ route('course.store', ['type' => 'invitation', 'method' => 'enter']) }}"
                                    id="invitation{{ $invitation->course->id }}-enter">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $invitation->course->id }}">
                                </form>
                                <form method="POST"
                                    action="{{ route('course.store', ['type' => 'invitation', 'method' => 'delete']) }}"
                                    id="invitation{{ $invitation->course->id }}-delete">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $invitation->course->id }}">
                                </form>
                            </div>
                        </div>
                    @endforeach
                    @if ($invitations->count() != 0)
                        <div class="w-100 d-flex justify-content-between">
                            <button class="btn btn-primary"
                                onclick="event.preventDefault();
                            document.getElementById('invitation-all-delete').submit();">Отклонить
                                все</button>
                            <button class="btn btn-primary"
                                onclick="event.preventDefault();
                            document.getElementById('invitation-all-enter').submit();">Принять
                                все</button>
                        </div>
                        <form method="POST"
                            action="{{ route('course.store', ['type' => 'invitation', 'subtype' => 'all', 'method' => 'delete']) }}"
                            id="invitation-all-delete">
                            @csrf
                        </form>
                        <form method="POST"
                            action="{{ route('course.store', ['type' => 'invitation', 'subtype' => 'all', 'method' => 'enter']) }}"
                            id="invitation-all-enter">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
