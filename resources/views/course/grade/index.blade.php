@extends('layouts.course')
@section('content')
    <div class="container" style="max-width: 900px">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link-dark py-1 px-3 rounded link-dark active" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">Ученики</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link-dark py-1 px-3 rounded link-dark" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">Задания</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <table class="table myaccordion" id="accordion">
                    <tbody>
                        @foreach ($users as $user)
                            @if ($user->id !== $users->find($course->leader_id)->id)
                                <tr class="position-relative" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTask{{ $user->id }}"
                                    aria-controls="collapseTask{{ $user->id }}" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <td class="align-middle" style="width: 50px; height: 50px">
                                        <img class="rounded-circle img-settings" style="width: 34px; height: 34px"
                                            src="{{ asset($user->about->photoPath) }}" alt="">
                                    </td>
                                    <td class="align-middle mw-597 user-select-none">
                                        {{ $user->name . ' ' . $user->surname }}
                                    </td>
                                    <td style="width: 40px">
                                        &nbsp;
                                    </td>
                                </tr>
                                @foreach ($tasks->where('type_id', 2) as $task)
                                    <tr id="collapseTask{{ $user->id }}" class="collapse acc position-relative">
                                        <td colspan="2" class="ps-3 align-middle mw-597 fz-12-max-400 user-select-none">
                                            {{ $task->title }}
                                            <a href="{{ route('task.user.show', ['course' => $course, 'task' => $task, 'user' => $user]) }}"
                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                        </td>
                                        <td class="text-end fz-12-max-400 user-select-none"
                                            style="font-size: 12px; width: 85px">
                                            @if (!is_null($task->completed->where('user_id', $user->id)->first()))
                                                @if ($task->completed->where('user_id', $user->id)->first()->option_id === 2)
                                                    @if (!is_null($task->completed->where('user_id', $user->id)->first()->grade))
                                                        {{ $task->completed->where('user_id', $user->id)->first()->grade }}
                                                    @else
                                                        Без оценки
                                                    @endif
                                                @elseif($task->completed->where('user_id', $user->id)->first()->option_id === 3)
                                                    Возвращено
                                                @elseif($task->completed->where('user_id', $user->id)->first()->option_id === 1)
                                                    Не сдано
                                                @else
                                                    Не проверено
                                                @endif
                                            @else
                                                Не сдано
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table class="table myaccordion" id="accordion">
                    <tbody>
                        @foreach ($tasks->where('type_id', 2) as $task)
                            <tr class="position-relative" data-bs-toggle="collapse"
                                data-bs-target="#collapseUser{{ $task->id }}"
                                aria-controls="collapseUser{{ $task->id }}" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <td colspan="3" class="align-middle mw-597 fz-12-max-400 user-select-none">
                                    {{ $task->title }}
                                </td>
                            </tr>
                            @foreach ($users as $user)
                                @if ($user->id !== $users->find($course->leader_id)->id)
                                    <tr id="collapseUser{{ $task->id }}" class="collapse acc position-relative">
                                        <td class="ps-3 align-middle" style="width: 50px; height: 50px">
                                            <img class="rounded-circle img-settings" style="width: 34px; height: 34px"
                                                src="{{ asset($user->about->photoPath) }}" alt="">
                                            <a href="{{ route('task.user.index', ['course' => $course, 'task' => $task, 'user' => $user]) }}"
                                                class="position-absolute top-0 bottom-0 start-0 end-0"></a>
                                        </td>
                                        <td class="align-middle mw-597 user-select-none">
                                            {{ $user->name . ' ' . $user->surname }}
                                        </td>
                                        <td class="text-end fz-12-max-400 user-select-none align-middle"
                                            style="font-size: 12px; width: 85px">
                                            @if (!is_null($task->completed->where('user_id', $user->id)->first()))
                                                @if ($task->completed->where('user_id', $user->id)->first()->option_id === 2)
                                                    @if (!is_null($task->completed->where('user_id', $user->id)->first()->grade))
                                                        {{ $task->completed->where('user_id', $user->id)->first()->grade }}
                                                    @else
                                                        Без оценки
                                                    @endif
                                                @elseif($task->completed->where('user_id', $user->id)->first()->option_id === 3)
                                                    Возвращено
                                                @elseif($task->completed->where('user_id', $user->id)->first()->option_id === 1)
                                                    Не сдано
                                                @else
                                                    Не проверено
                                                @endif
                                            @else
                                                Не сдано
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
