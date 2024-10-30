<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Адмін-панель</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.viewers.*') ? 'active' : '' }}" 
                       href="{{ route('admin.viewers.index') }}">
                        <i class="bi bi-people"></i> Глядачі
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.students-relatives.*') ? 'active' : '' }}" 
                       href="{{ route('admin.students-relatives.index') }}">
                        <i class="bi bi-people-fill"></i> Студенти та Родичі
                    </a>
                </li>
                <li class="nav-item">
                    <a class = nav-link href="{{ route('viewer.students.index') }}">
                        <i class="bi bi-mortarboard"></i> Студенти
                    </a>
                </li>
            </ul>
            <div class="d-flex">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="bi bi-box-arrow-right"></i> Вийти
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>