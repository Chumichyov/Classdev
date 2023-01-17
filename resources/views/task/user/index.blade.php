@extends('layouts.course')
@section('content')
    <div class="container">
        <div class="starter-template ms-auto me-auto" style="max-width: 720px">
            @if (empty($completed))
                <h2 class="w-100 text-center">Пользователь {{ $user->name . ' ' . $user->surname }} не отправлял задания</h2>
            @else
                <h4 class="w-100 text-center">{{ $user->name . ' ' . $user->surname }}</h4>
                <h2 class="w-100 text-center">Выполненные задания</h2>
                <table class="table myaccordion table-hover" id="accordion">
                    <tbody style="max-width: 720px;">
                        @foreach ($completed as $item)
                            <tr class="position-relative rounded overflow-hidden">
                                <td class="points align-middle mw-597">
                                    @if ($item->user_id != auth()->user()->id)
                                        <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                            href="{{ route('task.showUserFile', ['course' => $course, 'task' => $item->task->id, 'user' => $user]) }}"></a>
                                    @else
                                        <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                            href="{{ route('task.show', ['course' => $course, 'task' => $item->task->id]) }}"></a>
                                    @endif
                                    <span>{{ $item->task->title }}</span>
                                </td>
                                <td class="align-middle" style="width: 40px">
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="width: 28px; height: 28px;">

                                        @if ($item->is_returned === 0)
                                            <img class="img-settings" src="{{ asset('icons/warning.png') }}"
                                                style="width: 28px; height: 28px;" alt="">
                                        @endif
                                    </div>
                                </td>
                                <td style="width: 40px">
                                    <button data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->task->id }}"
                                        aria-controls="collapse{{ $item->task->id }}" aria-expanded="false"
                                        aria-label="Toggle navigation"
                                        class="btn my rounded-circle btn-link text-dark arrow-down collapsed z-index-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" id="collapse{{ $item->task->id }}" class="collapse acc">
                                    <p>{{ $item->task->description }}</p>

                                    @if ($item->task->deadline !== null && $item->task->type_id !== 1)
                                        <p>Срок сдачи: {{ $item->task->deadline }}</p>
                                    @endif

                                    @if (!is_null($item->grade))
                                        Оценка: {{ $item->grade }}
                                    @else
                                        Без оценки
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endsection
