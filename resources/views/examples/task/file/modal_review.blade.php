@if (isset($file->reviews))
    @foreach ($file->reviews as $review)
        <div class="modal modal-lg fade" id="modalReview{{ $review->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="modalReview{{ $review->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalReview{{ $review->id }}Label">
                            {{ auth()->user()->id == $course->leader_id && !is_null($file->completed) && $file->completed->option_id != 3 ? 'Редактирование обзора' : 'Просмотр обзора' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <form method="POST"
                        action="{{ route('task.file.review.update', ['course' => $course, 'task' => $task, 'file' => $file, 'review' => $review]) }}">
                        @csrf
                        @method('patch')
                        <div class="modal-body">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10">
                                    <select class="form-control" id="type_id" name="type_id"
                                        {{ auth()->user()->id == $course->leader_id && !is_null($file->completed) && $file->completed->option_id != 3 ? '' : 'disabled' }}>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ $type->id == $review->type_id ? 'selected' : '' }}>
                                                {{ $type->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="" for="type_id">Тип</label>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-4">
                                    <div class="form-outline">
                                        <input id="first" type="first"
                                            class="form-control @error('first') is-invalid @enderror" name="first"
                                            value="{{ $review->first }}" required autocomplete="first"
                                            {{ auth()->user()->id == $course->leader_id && !is_null($file->completed) && $file->completed->option_id != 3 ? '' : 'disabled' }}>
                                        <label class="" for="first">Начало выделения</label>
                                        @error('first')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5 mb-4">
                                    <div class="form-outline">
                                        <input id="last" type="last"
                                            class="form-control @error('last') is-invalid @enderror" name="last"
                                            value="{{ $review->last }}" required autocomplete="last"
                                            {{ auth()->user()->id == $course->leader_id && !is_null($file->completed) && $file->completed->option_id != 3 ? '' : 'disabled' }}>
                                        <label class="" for="last">Конец выделения</label>
                                        @error('last')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-outline">
                                        <textarea style="height: 150px" id="description" type="description"
                                            class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description"
                                            {{ auth()->user()->id == $course->leader_id && !is_null($file->completed) && $file->completed->option_id != 3 ? '' : 'disabled' }}>{{ !is_null(old('description')) ? old('description') : $review->description }}</textarea>
                                        <label class="" for="description">Описание</label>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            @if (auth()->user()->id == $course->leader_id && !is_null($file->completed) && $file->completed->option_id != 3)
                                <button type="submit" class="btn btn-primary">
                                    Изменить
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif
