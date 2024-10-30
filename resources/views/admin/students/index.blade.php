@extends('layouts.admin')

@section('title', 'Список студентів')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Список студентів</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Додати студента
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Прізвище</th>
                            <th>Ім'я</th>
                            <th>По батькові</th>
                            <th>Група</th>
                            <th>Родичі</th>
                            <th class="text-end">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
                                <td>{{ $student->group_name }}</td>
                                <td>
                                    @foreach($student->relatives as $relative)
                                        <div class="mb-1">
                                            {{ $relative->last_name }} {{ $relative->first_name }}
                                            <span class="badge bg-secondary">{{ $relative->pivot->relationship_type }}</span>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.students.edit', $student->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Ви впевнені?')">
                                                <i class="bi bi-trash"></i>
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