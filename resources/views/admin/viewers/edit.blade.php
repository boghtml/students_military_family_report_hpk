@extends('layouts.admin')

@section('title', 'Редагувати глядача')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Редагувати глядача</h1>

    <form action="{{ route('admin.viewers.update', $viewer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="form-label">Ім'я</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $viewer->name }}" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Електронна пошта</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $viewer->email }}" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Новий пароль (якщо потрібно змінити)</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Підтвердження пароля</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('admin.viewers.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
@endsection
