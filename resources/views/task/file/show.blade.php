@extends('layouts.course')
@section('content')
    <div class="container" style="max-width: 900px">
        <div class="fs-3 w-100 me-3 points">
            {{ $file->originalName }}
        </div>
        <div class="w-100 mb-3 mt-3 d-flex align-items-center justify-content-between">
            <a href="{{ route('task.show', ['course' => $course, 'task' => $task]) }}" class="btn btn-primary">Назад</a>
            <a href="{{ route('task.file.download', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                class="btn btn-primary">Скачать</a>
        </div>

        <textarea name="code" id="code" style="">
@foreach ($lines as $key => $line)
{{ $line }}
@endforeach
        </textarea>

        @if (!is_null($file->completed))
            <div class="w-100 d-flex align-items-center justify-content-between">
                <div class="fs-3 mt-3 mb-3">Обзор</div>
                @if (!is_null($file->completed) && $file->completed->option_id != 3)
                    @can('view', $course)
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReview">Создать</button>
                    @endcan
                @endif
            </div>
            @if (isset($file->reviews))
                <div class="d-flex">
                    @foreach ($file->reviews as $review)
                        <button
                            class="alert {{ $loop->iteration > 1 ? 'ms-3' : '' }} py-2 px-3 {{ $review->type_id == 1 ? 'alert-danger' : '' }} {{ $review->type_id == 2 ? 'alert-warning' : '' }} {{ $review->type_id == 3 ? 'alert-success' : '' }}"
                            role="alert" data-bs-toggle="modal" data-bs-target="#modalReview{{ $review->id }}">
                            {{ $review->first . ' - ' . $review->last }}
                        </button>
                    @endforeach
                </div>
            @endif


            @if (isset($file->message) || $course->leader_id == auth()->user()->id)
                <div class="w-100 fs-3 mt-3 mb-3">Комментарий</div>
                <form
                    action="{{ route('task.file.message.store', ['course' => $course, 'file' => $file, 'task' => $task]) }}"
                    method="POST">
                    @csrf
                    <textarea id="message" type="text"
                        class="form-control {{ $course->leader_id == auth()->user()->id ? '' : 'resize-none' }} @error('message') is-invalid @enderror"
                        name="message" required autocomplete="message" autofocus
                        {{ !is_null($file->completed) && $file->completed->option_id != 3 ? '' : 'disabled' }}
                        {{ $course->leader_id == auth()->user()->id ? '' : 'disabled' }}>{{ (!is_null(old('message')) ? old('message') : isset($file->message)) ? $file->message->text : '' }}</textarea>

                    @if (!is_null($file->completed) && $file->completed->option_id != 3)
                        @can('view', $course)
                            <div class="w-100 d-flex justify-content-end">
                                <button class="btn btn-primary mt-3" type="submit">Отправить</button>
                            </div>
                        @endcan
                    @endif
                </form>
            @endif
        @endif
    </div>

    @if (!is_null($file->completed) && $file->completed->option_id != 3)
        @can('view', $course)
            @include('examples.task.file.modal_create_review')
        @endcan
    @endif

    @include('examples.task.file.modal_review')


    <script>
        window.addEventListener('load', function(event) {
            let editorElement = document.querySelector("textarea[name=code]");
            // If we have an editor element
            if (editorElement) {
                // pass options to ace.edit
                let editor = ace.edit(editorElement, {
                    mode: "ace/mode/{{ $file->extension == 'js' ? 'javascript' : $file->extension }}",
                    theme: "ace/theme/monokai",
                    fontSize: 14,
                    wrap: true,
                    maxLines: 30,
                })
                editor.resize();
                // editor.container.style.height = '300px'
                editor.setReadOnly(true)
                // use setOptions method to set several options at once
                editor.setOptions({
                    autoScrollEditorIntoView: true,
                    copyWithEmptySelection: true,
                });

                // const text = $("#message").val();

                // let number;
                // let first;
                // let last;
                // let types = {
                //     red: {
                //         symbol: "!!",
                //         style: "",
                //     },
                //     green: {
                //         symbol: "#",
                //         style: "",
                //     }
                // };


                // console.log(types)

                // function getListIdx(str, substr) {
                //     let listIdx = []
                //     let lastIndex = -1
                //     while ((lastIndex = str.indexOf(substr, lastIndex + 1)) !== -1) {
                //         listIdx.push(lastIndex)
                //     }
                //     return listIdx
                // }

                // const isNumeric = n => !!Number(n);



                // function getHlRanges(text, ) {
                //     var ranges = [];

                //     getListIdx(text, '#').forEach((element, index) => {
                //         number = text.slice(element).split(' ')[0].slice(1)

                //         if (isNumeric(number.substring(0, 1)) == false) {
                //             return;
                //         }


                //         number = number.replace('.', '');
                //         number = number.replace('#', '');

                //         if (isNumeric(number.slice(-1)) == false && number.slice(-1) != 0) {
                //             return;
                //         }


                //         first = number.split('-')[0];
                //         last = number.split('-').pop();
                //         console.log(first, last)

                //         ranges.push({
                //             "first": first,
                //             "last": last
                //         });
                //     });

                //     return ranges;
                // }

                // const arr = getHlRanges(text);

                var reviews = {!! json_encode($file->reviews->toArray(), JSON_HEX_TAG) !!};

                for (var review in reviews) {
                    var Range = ace.require('ace/range').Range;
                    editor.session.addMarker(new Range(reviews[review].first - 1, 0, reviews[review].last - 1,
                            reviews[review].first -
                            1 == reviews[review].last - 1 ? 1 : 0), reviews[review].type_id == 1 ?
                        "myMarker-red" : reviews[review].type_id == 2 ? "myMarker-yellow" : reviews[review]
                        .type_id == 3 ? "myMarker-green" : '',
                        "fullLine");
                }

                // for (var key in arr) {
                //     var Range = ace.require('ace/range').Range;
                //     editor.session.addMarker(new Range(arr[key].first - 1, 0, arr[key].last - 1, arr[key].first -
                //             1 == arr[key].last - 1 ? 1 : 0), "myMarker-green",
                //         "fullLine");
                // }
            }
        });
    </script>
@endsection
