@extends('layouts.viewer')

@section('title', 'Список студентів')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="card-title h4 mb-0">
                    <i class="bi bi-people-fill me-2"></i>Список студентів та їх родичів
                </h2>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">
                    Всього: {{ $students->total() }}
                </span>
            </div>
        </div>
    </div>

    <div class="card-body">
        <!-- Форма для пошуку -->
        <form method="GET" action="{{ route('viewer.students.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               class="form-control" 
                               placeholder="Загальний пошук..."
                        >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-bookmark"></i>
                        </span>
                        <input type="text" 
                               name="group" 
                               value="{{ request('group') }}" 
                               class="form-control" 
                               placeholder="Пошук за групою..."
                        >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" 
                               name="name" 
                               value="{{ request('name') }}" 
                               class="form-control" 
                               placeholder="Пошук за іменем..."
                        >
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Пошук
                </button>
                <a href="{{ route('viewer.students.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i> Скинути фільтри
                </a>
            </div>
        </form>

        <!-- Таблиця зі студентами -->
        <div class="table-responsive border rounded">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="bg-light">
                            <a href="{{ route('viewer.students.index', array_merge(request()->all(), ['sort' => 'last_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" 
                               class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                Прізвище
                                <i class="bi bi-arrow-{{ request('sort') === 'last_name' ? (request('direction') === 'asc' ? 'up' : 'down') : 'down-up' }}"></i>
                            </a>
                        </th>
                        <th class="bg-light">
                            <a href="{{ route('viewer.students.index', array_merge(request()->all(), ['sort' => 'first_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" 
                               class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                Ім'я
                                <i class="bi bi-arrow-{{ request('sort') === 'first_name' ? (request('direction') === 'asc' ? 'up' : 'down') : 'down-up' }}"></i>
                            </a>
                        </th>
                        <th class="bg-light">
                            <a href="{{ route('viewer.students.index', array_merge(request()->all(), ['sort' => 'middle_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" 
                               class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                По батькові
                                <i class="bi bi-arrow-{{ request('sort') === 'middle_name' ? (request('direction') === 'asc' ? 'up' : 'down') : 'down-up' }}"></i>
                            </a>
                        </th>
                        <th class="bg-light">
                            <a href="{{ route('viewer.students.index', array_merge(request()->all(), ['sort' => 'group_name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" 
                               class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                Група
                                <i class="bi bi-arrow-{{ request('sort') === 'group_name' ? (request('direction') === 'asc' ? 'up' : 'down') : 'down-up' }}"></i>
                            </a>
                        </th>
                        <th class="bg-light">
                            <a href="{{ route('viewer.students.index', array_merge(request()->all(), ['sort' => 'relatives_count', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" 
                               class="text-decoration-none text-dark d-flex align-items-center gap-2">
                                Родичі на службі
                                <i class="bi bi-arrow-{{ request('sort') === 'relatives_count' ? (request('direction') === 'asc' ? 'up' : 'down') : 'down-up' }}"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($students as $student)
                        <tr>
                            <td class="fw-medium">{{ $student->last_name }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->middle_name }}</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                    {{ $student->group_name }}
                                </span>
                            </td>
                            <td>
                                @forelse($student->relatives as $relative)
                                    <div class="card mb-2 border-0 bg-light bg-opacity-50">
                                        <div class="card-body p-2">
                                            <div class="fw-medium text-dark">
                                                {{ $relative->last_name }} {{ $relative->first_name }} {{ $relative->middle_name }}
                                            </div>
                                            <div class="small text-muted d-flex align-items-center gap-2">
                                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary">
                                                    {{ $relative->pivot->relationship_type }}
                                                </span>
                                                <span class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-shield-fill"></i>
                                                    ВЧ: {{ $relative->military_unit }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <span class="text-muted fst-italic">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Немає даних
                                    </span>
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-1 mb-3 d-block opacity-50"></i>
                                <h5>Записів не знайдено</h5>
                                <p class="text-muted mb-0">Спробуйте змінити параметри пошуку</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
            <div class="mt-4">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>
@endsection