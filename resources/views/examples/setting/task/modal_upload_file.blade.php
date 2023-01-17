{{-- Модальное окно для загрузки файлов --}}
<div class="modal modal-lg fade" id="uploadFileModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="sendModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFileModalLabel">Загрузить</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="POST" action="{{ route('task.file.store', ['course' => $course->id, 'task' => $task->id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="files" class="col-md-2 col-form-label text-md-end">{{ __('Файлы') }}</label>

                        <div class="col-md-9">
                            <input class="form-control @error('files') is-invalid @enderror" type="file"
                                name="files[]" placeholder="Выберите файлы" multiple>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="task" value="true">

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
