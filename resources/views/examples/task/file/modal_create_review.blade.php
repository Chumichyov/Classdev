<div class="modal modal-lg fade" id="createReview" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="createReviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createReviewLabel">Создание обзора</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="POST"
                action="{{ route('task.file.review.store', ['course' => $course, 'task' => $task, 'file' => $file]) }}">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-10">
                            <select class="form-control" id="type_id" name="type_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
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
                                    value="{{ old('first') }}" required autocomplete="first">
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
                                    value="{{ old('last') }}" required autocomplete="last">
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
                                <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror"
                                    name="description" autocomplete="description">{{ old('description') }}</textarea>
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
                    <div class="row mb-0 flex-row">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Отправить') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
