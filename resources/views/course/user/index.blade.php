@extends('layouts.course')
@section('content')
    <div class="container" style="max-width: 900px">
        <h3 class="mb-3 ps-3">Преподаватель</h3>
        <table class="table myaccordion" id="accordion">
            <tbody>
                <tr class="position-relative">
                    <td class="align-middle" style="width: 50px; height: 50px">
                        <img class="rounded-circle img-settings" style="width: 34px; height: 34px"
                            src="{{ asset($users->find($course->leader_id)->about->photoPath) }}" alt="">
                    </td>
                    <td class="align-middle mw-597 fs-5">
                        {{ $users->find($course->leader_id)->name . ' ' . $users->find($course->leader_id)->surname }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex w-100 justify-content-between align-items-center mb-2">
            <h3 class="ps-3">Учащиеся</h3>
            @can('view', $course)
                <a href="{{ route('course.setting.connection.index', ['course' => $course]) }}"
                    class="btn btn-primary">Настройки</a>
            @endcan
        </div>
        <table class="table myaccordion {{ $course->leader_id == auth()->user()->id ? 'table-hover' : '' }}" id="accordion">
            <tbody>
                @foreach ($users as $user)
                    @if ($user->id !== $users->find($course->leader_id)->id)
                        <tr class="position-relative">
                            <td class="align-middle" style="width: 50px; height: 50px">
                                @can('view', $course)
                                    <a class="position-absolute top-0 start-0 bottom-0 end-0"
                                        href="{{ route('task.user.index', ['course' => $course, 'user' => $user]) }}"></a>
                                @endcan
                                <img class="rounded-circle img-settings" style="width: 34px; height: 34px"
                                    src="{{ asset($user->about->photoPath) }}" alt="">
                            </td>
                            <td class="align-middle mw-597 fs-5">
                                {{ $user->name . ' ' . $user->surname }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script type="text/javascript">
        var Clipboard = new ClipboardJS('.btn');
    </script>
@endsection
