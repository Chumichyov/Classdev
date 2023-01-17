@extends('layouts.default')
@section('content')
    <div class="position-relative py-4">
        <div class="container" style="max-width: 900px">
            <div class="my d-flex justify-content-center">
                <div class="fz-16 d-flex justify-content-center flex-column align-items-center">
                    <div class="user__photo plus-size rounded-circle position-relative overflow-hidden">
                        <img class="header-profile" src="{{ asset($user->about->photoPath) }}" alt="">
                        <div data-bs-toggle="modal" data-bs-target="#photoModal"
                            class="position-absolute bottom-0 start-0 end-0 top-0">
                        </div>
                    </div>
                    <span class="font-weight-bold mt-3">{{ $user->surname . ' ' . $user->name }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                </div>
            </div>
            <div class="p-3 pt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Личная информация</h4>
                </div>
                <form action="{{ route('profile.update', auth()->user()->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="labels">Имя</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ !is_null(old('name')) ? old('name') : $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="labels">Фамилия</label>
                            <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror"
                                value="{{ !is_null(old('surname')) ? old('surname') : $user->surname }}">
                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-2 position-relative">
                            <label class="labels">Телефон</label>
                            <div class="position-relative">
                                <input type="text" name="number" style="padding-left: 21px"
                                    class="form-control @error('number') is-invalid @enderror" placeholder=" Номер телефона"
                                    value="{{ (!is_null(old('number')) ? old('number') : isset($user->about->number)) ? $user->about->number : '' }}">
                                <span class="prefix top-0 d-flex align-items-center justify-content-center"
                                    style="height: 37px">+</span>
                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mb-2">
                            <label class="labels">Почта</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Почта" value="{{ !is_null(old('email')) ? old('email') : $user->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3 text-end"><button class="btn btn-primary profile-button"
                            type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @include('examples.profile.modal_change_photo')
@endsection
