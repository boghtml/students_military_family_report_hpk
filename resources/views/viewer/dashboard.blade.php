@extends('layouts.viewer')

@section('title', 'Головна сторінка глядача')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body text-center p-5">
                <h1 class="display-4 mb-4">
                    <i class="bi bi-shield-check text-primary"></i>
                    Вітаємо в системі!
                </h1>
                <p class="lead text-muted mb-4">
                    Тут ви можете переглядати інформацію про студентів та їхніх родичів, які зараз захищають нашу країну.
                </p>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a href="{{ route('viewer.students.index') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-list-ul"></i> Переглянути список студентів
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Швидка статистика</h5>
                <div class="row text-center mt-3">
                    <div class="col">
                        <h2 class="h4 text-primary">{{ \App\Models\Student::count() }}</h2>
                        <p class="text-muted">Студентів</p>
                    </div>
                    <div class="col">
                        <h2 class="h4 text-primary">{{ \App\Models\Relative::count() }}</h2>
                        <p class="text-muted">Родичів на службі</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection