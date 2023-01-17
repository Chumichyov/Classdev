@extends('layouts.course')
@section('content')
    <div class="position-relative">
        <div class="container" style="max-width: 900px">
            <div class="ms-auto me-auto rounded overflow-hidden mb-3 position-relative" style="max-height: 237px">
                <img class="w-100 h-100 img-settings" style="min-height: 100px; max-height: 237px;"
                    src="{{ asset($course->info->imagePath) }}" alt="">
                <a class="btn btn-light position-absolute end-0 top-0 py-2 px-3 mt-2 me-2" data-bs-toggle="modal"
                    data-bs-target="#modalPhoto">Изменить</a>
            </div>



            <div class="ms-auto me-auto my d-flex justify-content-center">
                <div class="w-100 fz-16 d-flex justify-content-center flex-column align-items-center">
                    {{-- Название --}}
                    <div class="ms-auto me-auto d-flex justify-content-between align-items-center w-100 border-bottom pb-2">
                        <div class="fz-16 text-dark">Название</div>
                    </div>
                    <form class="w-100 d-flex flex-column align-items-start justify-content-between"
                        action="{{ route('course.update', ['course' => $course]) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="my-section w-100 pt-2 ps-2">
                            <div class="d-flex flex-column w-100 me-5">
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                    name="title" required value="{{ $course->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Тема --}}
                        <div
                            class="ms-auto me-auto d-flex justify-content-between align-items-center w-100 border-bottom pb-2 mt-4">
                            <div class="fz-16 text-dark">Тема</div>
                        </div>
                        <div class="my-section w-100 pt-2 ps-2">

                            <div class="d-flex flex-column w-100 me-5">
                                <input class="form-control @error('topic') is-invalid @enderror" type="text"
                                    name="topic" required value="{{ $course->topic }}">
                                @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Описание --}}
                        <div
                            class="ms-auto me-auto d-flex justify-content-between align-items-center w-100 border-bottom pb-2 mt-4">
                            <div class="fz-16 text-dark">Описание</div>
                        </div>
                        <div class="my-section w-100 pt-2 ps-2">

                            <div class="d-flex flex-column w-100 me-5">
                                <input class="form-control @error('description') is-invalid @enderror" type="text"
                                    name="description" required value="{{ $course->description }}">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end w-100">
                            <div class="mt-3 text-end"><button class="btn btn-primary profile-button"
                                    type="submit">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('examples.setting.modal_change_background')
@endsection
