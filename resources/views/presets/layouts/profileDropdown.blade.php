<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    {{-- Личный кабинет --}}
    <a class="dropdown-item" href="{{ route('profile.index', auth()->user()->id) }}">Настройки</a>

    {{-- Выход --}}
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
        {{ __('Выход') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
