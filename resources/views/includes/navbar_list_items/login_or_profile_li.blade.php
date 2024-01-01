@if(auth()->check())
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->name}}
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/profile">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">Abmelden</button>
                </form>
            </li>
        </ul>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/login">Anmelden</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/register">Registrieren</a>
    </li>
@endif


