@extends('layouts.admin')

@section('title', 'Список глядачів')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Список глядачів</h1>
    <a href="{{ route('admin.viewers.create') }}" class="btn btn-primary mb-4">Додати глядача</a>

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Ім'я</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewers as $viewer)
                <tr>
                    <td class="border px-4 py-2">{{ $viewer->name }}</td>
                    <td class="border px-4 py-2">{{ $viewer->email }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.viewers.edit', $viewer->id) }}" class="btn btn-sm btn-warning">Редагувати</a>
                        <form action="{{ route('admin.viewers.destroy', $viewer->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
