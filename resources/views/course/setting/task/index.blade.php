@extends('layouts.course')
@section('content')
    <div class="position-relative">
        <div class="container" style="max-width: 900px">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTask">
                Создать
            </button>
            @if ($themes->count() != 0)
                <h2 class="mb-2 mt-4">Все темы</h2>
                @foreach ($themes->reverse() as $theme)
                    <form action="{{ route('task.updateSimplified', ['course' => $course, 'theme_id' => $theme->id]) }}"
                        method="POST" class="mb-3">
                        @csrf
                        @method('patch')
                        <input id="theme" type="text"
                            class="form-control fs-5 me-3 @error('theme') is-invalid @enderror" name="theme"
                            value="{{ $theme->title }}" required autocomplete="theme">

                        <div class="d-flex w-100 align-items-center justify-content-between mt-2">
                            <button class="btn btn-danger"
                                onclick="event.preventDefault();
                        document.getElementById('destroy-theme{{ $theme->id }}').submit();">Удалить</button>
                            <input type="submit" class="btn btn-primary" value="Изменить">
                        </div>
                    </form>
                    <form action="{{ route('task.destroySimplified', ['course' => $course, 'theme_id' => $theme->id]) }}"
                        method="POST" id="destroy-theme{{ $theme->id }}">
                        @csrf
                        @method('delete')
                    </form>
                @endforeach
            @endif
            @if ($tasks->count() != 0)
                <h2 class="mb-2 mt-4">Все задания</h2>
                @foreach ($themes->reverse() as $theme)
                    @if ($theme->tasks()->count() > 0)
                        <div class="mt-2 ps-4 fs-4">{{ $theme->title }}</div>
                        <table class="table myaccordion" id="accordion">
                            <tbody style="max-width: 720px;">
                                @foreach ($tasks->where('theme_id', $theme->id)->reverse() as $item)
                                    <tr class="position-relative rounded overflow-hidden" style="height: 50px">
                                        <td class="align-middle" style="width: 40px">
                                            @if ($item->type_id === 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                    <path
                                                        d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                                </svg>
                                            @elseif ($item->type_id === 2)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                    <path
                                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                                </svg>
                                            @endif
                                        </td>
                                        <td class="points align-middle mw-597">
                                            <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                                href="{{ route('course.setting.task.show', ['course' => $course, 'task' => $item]) }}"></a>
                                            <span class="fs-5">{{ $item->title }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
                @if ($tasks->where('theme_id', null)->count() > 0)
                    <table class="table myaccordion" id="accordion">
                        <tbody style="max-width: 720px;">
                            <div class="mt-2 ps-4 fs-4">Без темы</div>
                            @foreach ($tasks->where('theme_id', null)->reverse() as $item)
                                <tr class="position-relative rounded overflow-hidden" style="height: 50px">
                                    <td class="align-middle" style="width: 40px">
                                        @if ($item->type_id === 1)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                <path
                                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                <path
                                                    d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                        @elseif ($item->type_id === 2)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                                <path
                                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="points align-middle mw-597">
                                        <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                            href="{{ route('course.setting.task.show', ['course' => $course, 'task' => $item]) }}"></a>
                                        <span class="fs-5">{{ $item->title }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </div>
    @include('examples.setting.modal_create_task')
@endsection
