
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('viewer.dashboard') }}">
            <i class="bi bi-house-door"></i> Головна
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('viewer.students.index') ? 'active' : '' }}" 
                       href="{{ route('viewer.students.index') }}">
                        <i class="bi bi-people"></i> Список студентів
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