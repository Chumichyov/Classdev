<div class="container d-flex flex-wrap justify-content-center">
    <ul class="nav col-12 col-md-auto justify-content-center mb-md-0">
        <li class="nav-item">
            <a href="{{ route('profile.index', auth()->user()->id) }}"
                class="nav-link fz-12-max-400 px-2 pb-3 link-dark fz-16 {{ $page == 'profile.index' ? 'border-bottom border-dark border-3' : '' }}"
                aria-current="page">
                Главная
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.personal', auth()->user()->id) }}"
                class="nav-link fz-12-max-400 px-2 pb-3 link-dark fz-16 {{ $page == 'profile.personal' ? 'border-bottom border-dark border-3' : '' }}"
                aria-current="page">
                Личная информация
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.security', auth()->user()->id) }}"
                class="nav-link fz-12-max-400 px-2 pb-3 link-dark fz-16 {{ $page == 'profile.security' ? 'border-bottom border-dark border-3' : '' }}"
                aria-current="page">
                Безопасность
            </a>
        </li>
    </ul>
</div>
