@extends('layouts.course')
@section('content')
    <div class="position-relative">
        <div class="container" style="max-width: 900px">
            <h2 class="text-start">
                Пригласить
            </h2>
            <div class="w-100 mt-2">
                <form class="d-flex w-100 justify-content-end mt-3 flex-wrap"
                    action="{{ route('course.setting.connection.store', ['course' => $course]) }}" method="POST">
                    @csrf
                    @method('post')
                    <input id="email" type="text" class="me-3 form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Введите почту..." style="width: 86%">
                    <button type="submit" class="btn btn-primary">Пригласить</button>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </form>
                @if (session('success'))
                    <div class="text-success ms-3 mt-1">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @elseif (session('error'))
                    <div class="text-danger ms-3 mt-1">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
            </div>
            <h2 class="text-start mt-4">
                Подключение по ссылке
            </h2>
            <div class="w-100 mt-2">
                <input class="form-control" value="{{ $course->uniqueLink }}" disabled>
                <div class="d-flex w-100 justify-content-between mt-3">
                    <form action="{{ route('course.setting.connection.update', ['course' => $course, 'type' => 'link']) }}"
                        method="POST">
                        @csrf
                        @method('patch')
                        <button type="submit" class="btn btn-primary">Сгенерировать</button>
                    </form>
                    <button class="btn btn-primary"
                        data-clipboard-text="{{ route('course.join', $course->uniqueLink) }}">Скопировать</button>
                </div>
            </div>
            <h2 class="text-start mt-4">
                Код доступа
            </h2>
            <div class="w-100 mt-2">
                <input class="form-control" value="{{ $course->uniqueCode }}" disabled>
                <div class="d-flex w-100 justify-content-between mt-3">
                    <form action="{{ route('course.setting.connection.update', ['course' => $course, 'type' => 'code']) }}"
                        method="POST">
                        @csrf
                        @method('patch')
                        <button type="submit" class="btn btn-primary">Сгенерировать</button>
                    </form>
                    <button class="btn btn-primary" data-clipboard-text="{{ $course->uniqueCode }}">Скопировать</button>
                </div>
            </div>
            @if ($users->count() > 1)
                <h2 class="text-start mt-4">
                    Подключенные участники
                </h2>
                <table class="table myaccordion" id="accordion">
                    <tbody>
                        @foreach ($users as $user)
                            @if ($user->id !== $users->find($course->leader_id)->id)
                                <tr class="">
                                    <td class="align-middle position-relative" style="width: 50px; height: 50px">
                                        <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                            href="{{ route('task.user.index', ['course' => $course, 'user' => $user]) }}"></a>
                                        <img class="rounded-circle img-settings" style="width: 34px; height: 34px"
                                            src="{{ asset($user->about->photoPath) }}" alt="">
                                    </td>
                                    <td class="points align-middle mw-597 position-relative">
                                        <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                            href="{{ route('task.user.index', ['course' => $course, 'user' => $user]) }}"></a>
                                        {{ $user->name . ' ' . $user->surname }}
                                    </td>
                                    <td class="align-middle" style="width: 50px">
                                        <a onclick="event.preventDefault();
                                    document.getElementById('user{{ $user->id }}-delete-form').submit();"
                                            class="text-danger d-block w-100 text-center h-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z">
                                                </path>
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form
                                            action="{{ route('course.setting.connection.destroy', ['course' => $course, 'user' => $user]) }}"
                                            method="POST" id="user{{ $user->id }}-delete-form">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if ($invitations->count() != 0)
                <h2 class="text-start mt-4">
                    Приглашенные
                </h2>
                <table class="table myaccordion" id="accordion">
                    <tbody>
                        @foreach ($invitations as $invitation)
                            <tr class="">
                                <td class="align-middle position-relative" style="width: 50px; height: 50px">
                                    <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                        href="{{ route('task.user.index', ['course' => $course, 'user' => $invitation->user]) }}"></a>
                                    <img class="rounded-circle img-settings" style="width: 34px; height: 34px"
                                        src="{{ asset($invitation->user->about->photoPath) }}" alt="">
                                </td>
                                <td class="points align-middle mw-597 position-relative">
                                    <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                        href="{{ route('task.user.index', ['course' => $course, 'user' => $invitation->user]) }}"></a>
                                    {{ $invitation->user->name . ' ' . $invitation->user->surname }}
                                </td>
                                <td class="align-middle" style="width: 50px">
                                    <a onclick="event.preventDefault();
                                    document.getElementById('user{{ $invitation->user->id }}-delete-form').submit();"
                                        class="text-danger d-block w-100 text-center h-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </a>
                                    <form
                                        action="{{ route('course.setting.connection.destroy', ['course' => $course, 'user' => $invitation->user]) }}"
                                        method="POST" id="user{{ $invitation->user->id }}-delete-form">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script type="text/javascript">
        var Clipboard = new ClipboardJS('.btn');
    </script>
@endsection
