@extends('layouts.admin')

@section('title', 'Додати глядача')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Додати глядача</h1>

    <form action="{{ route('admin.viewers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label">Ім'я</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Електронна пошта</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Підтвердження пароля</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Додати</button>
        <a href="{{ route('admin.viewers.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
@endsection
