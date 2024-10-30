@extends('layouts.admin')

@section('title', 'Студенти та Родичі')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Студенти та їх родичі</h1>
            <a href="{{ route('admin.students-relatives.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Додати студента
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ім'я студента</th>
                            <th>Група</th>
                            <th>Родичі</th>
                            <th>Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    {{ $student->last_name }} {{ $student->first_name }} {{ $student->middle_name }}
                                </td>
                                <td>{{ $student->group_name }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($student->relatives as $relative)
                                            <li>
                                                {{ $relative->last_name }} {{ $relative->first_name }} {{ $relative->middle_name }}
                                                <span class="badge bg-secondary">{{ $relative->pivot->relationship_type }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.students-relatives.edit', $student->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Редагувати
                                        </a>
                                        <form action="{{ route('admin.students-relatives.destroy', $student->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                                                <i class="bi bi-trash"></i> Видалити
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection