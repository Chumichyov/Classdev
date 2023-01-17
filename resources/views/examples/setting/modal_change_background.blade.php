<div class="modal fade" data-bs-backdrop="static" id="modalPhoto" tabindex="-1" aria-labelledby="photoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменить фон</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{ route('course.update', ['course' => $course]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body tab-content">
                    <div class="">
                        <input type="file" class="form-control" name="image" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Загрузить</button>
                </div>
            </form>
        </div>
    </div>
</div>
