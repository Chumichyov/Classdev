<div class="modal fade" data-bs-backdrop="static" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Настройки фото</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body tab-content">
                <div class="tab-pane fade show active" id="see-tab-pane" role="tabpanel" aria-labelledby="see-tab"
                    tabindex="0">
                    <div class="fz-16 d-flex justify-content-center flex-column align-items-center">
                        <div class="photo__info pb-3">
                            <div class="info__description text-center">По фото профиля другие люди смогут вас узнавать.
                            </div>
                        </div>
                        <div class="user__photo plus-size rounded-circle position-relative overflow-hidden">
                            <img class="header-profile" src="{{ asset($user->about->photoPath) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="change-tab-pane" role="tabpanel" aria-labelledby="change-tab"
                    tabindex="0">
                    <form action="{{ route('profile.uploadPhoto', auth()->user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control" name="image" />
                        <button type="submit" class="btn btn-sm">Upload</button>
                    </form>
                </div>
                @can('viewPhoto', auth()->user()->about)
                    <div class="tab-pane fade" id="remove-tab-pane" role="tabpanel" aria-labelledby="remove-tab"
                        tabindex="0">
                        <div class="fz-16 d-flex justify-content-center flex-column align-items-center">
                            <div class="photo__info pb-3">
                                <div class="info__description text-center">Вы уверены об удалении фото?
                                </div>
                                <div class="info__description text-center">Оно будет сменено на:
                                </div>
                            </div>
                            <div class="user__photo plus-size rounded-circle position-relative overflow-hidden">
                                <img class="header-profile" src="{{ asset('photos/250.png') }}" alt="">
                            </div>
                            <form action="{{ route('profile.destroyPhoto', auth()->user()->id) }}" method="POST"
                                class="pt-3">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-secondary px-3">Удалить</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="my nav nav-tabs border-0  d-flex justify-content-between align-items-center" id="nav-tab"
                    role="tablist">
                    <button class="px-2 nav-link text-dark active" id="see-tab" data-bs-toggle="tab"
                        data-bs-target="#see-tab-pane" type="button" role="tab" aria-controls="see-tab-pane"
                        aria-selected="true">Просмотр</button>
                    <button class="px-2 nav-link text-dark" id="change-tab" data-bs-toggle="tab"
                        data-bs-target="#change-tab-pane" type="button" role="tab" aria-controls="change-tab-pane"
                        aria-selected="false">Изменить</button>
                    @can('viewPhoto', auth()->user()->about)
                        <button class="px-2 nav-link text-dark" id="remove-tab" data-bs-toggle="tab"
                            data-bs-target="#remove-tab-pane" type="button" role="tab" aria-controls="remove-tab-pane"
                            aria-selected="false">Удалить</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
