@extends('layouts.admin')

@section('title', 'Додати студента')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Додати студента та його родичів</h1>

    <form action="{{ route('admin.students-relatives.store') }}" method="POST">
    @csrf

        <!-- Поля для студента -->
        <h2 class="text-xl font-bold mb-2">Інформація про студента</h2>

        <div class="mb-3">
            <label for="first_name" class="form-label">Ім'я студента</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Прізвище студента</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="middle_name" class="form-label">По батькові студента</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}">
        </div>

        <div class="mb-3">
            <label for="group_name" class="form-label">Група студента</label>
            <input type="text" name="group_name" id="group_name" class="form-control" value="{{ old('group_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="military_relation" class="form-label">Відношення студента до військової справи</label>
            <input type="text" name="military_relation" id="military_relation" class="form-control" value="{{ old('military_relation') }}">
        </div>

        <!-- Поля для родичів -->
        <h2 class="text-xl font-bold mt-4 mb-2">Родичі, які воюють</h2>

        <div id="relatives-container">
            <div class="relative-item mb-4">
                <div class="mb-3">
                    <label for="relatives[0][first_name]" class="form-label">Ім'я родича</label>
                    <input type="text" name="relatives[0][first_name]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="relatives[0][last_name]" class="form-label">Прізвище родича</label>
                    <input type="text" name="relatives[0][last_name]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="relatives[0][middle_name]" class="form-label">По батькові родича</label>
                    <input type="text" name="relatives[0][middle_name]" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="relatives[0][military_unit]" class="form-label">Військова частина</label>
                    <input type="text" name="relatives[0][military_unit]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="relatives[0][relationship_type]" class="form-label">Тип зв'язку зі студентом</label>
                    <input type="text" name="relatives[0][relationship_type]" class="form-control" required>
                </div>
            </div>
        </div>

        <button type="button" id="add-relative-btn" class="btn btn-secondary mb-4">Додати ще одного родича</button>

        <button type="submit" class="btn btn-success">Додати</button>
        <a href="{{ route('admin.students-relatives.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>

    <script>
        document.getElementById('add-relative-btn').addEventListener('click', function() {
            let container = document.getElementById('relatives-container');
            let relativeIndex = document.querySelectorAll('.relative-item').length;
            let newRelative = document.querySelector('.relative-item').cloneNode(true);

            newRelative.querySelectorAll('input').forEach(function(input) {
                let name = input.getAttribute('name');
                name = name.replace(/\[\d+\]/, `[${relativeIndex}]`);
                input.setAttribute('name', name);
                input.value = '';
            });

            container.appendChild(newRelative);
        });
    </script>
@endsection
