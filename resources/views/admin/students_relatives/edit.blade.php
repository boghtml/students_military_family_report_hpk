@extends('layouts.admin')

@section('title', 'Редагувати студента')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Редагувати студента та його родичів</h1>

    <form action="{{ route('admin.students-relatives.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-bold mb-2">Інформація про студента</h2>

        <div class="mb-3">
            <label for="first_name" class="form-label">Ім'я студента</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Прізвище студента</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="middle_name" class="form-label">По батькові студента</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name', $student->middle_name) }}">
        </div>

        <div class="mb-3">
            <label for="group_name" class="form-label">Група студента</label>
            <input type="text" name="group_name" id="group_name" class="form-control" value="{{ old('group_name', $student->group_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="military_relation" class="form-label">Відношення студента до військової справи</label>
            <input type="text" name="military_relation" id="military_relation" class="form-control" value="{{ old('military_relation', $student->military_relation) }}">
        </div>

        <h2 class="text-xl font-bold mt-4 mb-2">Родичі, які воюють</h2>

        <div id="relatives-container">
            @foreach ($student->relatives as $index => $relative)
                <div class="relative-item mb-4">
                    <div class="mb-3">
                        <label for="relatives[{{ $index }}][first_name]" class="form-label">Ім'я родича</label>
                        <input type="text" name="relatives[{{ $index }}][first_name]" class="form-control" value="{{ old('relatives.' . $index . '.first_name', $relative->first_name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="relatives[{{ $index }}][last_name]" class="form-label">Прізвище родича</label>
                        <input type="text" name="relatives[{{ $index }}][last_name]" class="form-control" value="{{ old('relatives.' . $index . '.last_name', $relative->last_name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="relatives[{{ $index }}][middle_name]" class="form-label">По батькові родича</label>
                        <input type="text" name="relatives[{{ $index }}][middle_name]" class="form-control" value="{{ old('relatives.' . $index . '.middle_name', $relative->middle_name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="relatives[{{ $index }}][military_unit]" class="form-label">Військова частина</label>
                        <input type="text" name="relatives[{{ $index }}][military_unit]" class="form-control" value="{{ old('relatives.' . $index . '.military_unit', $relative->military_unit) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="relatives[{{ $index }}][relationship_type]" class="form-label">Тип зв'язку зі студентом</label>
                        <input type="text" name="relatives[{{ $index }}][relationship_type]" class="form-control" value="{{ old('relatives.' . $index . '.relationship_type', $relative->pivot->relationship_type) }}" required>
                    </div>

                    <button type="button" class="btn btn-danger remove-relative-btn">Видалити родича</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-relative-btn" class="btn btn-secondary mb-4">Додати ще одного родича</button>

        <button type="submit" class="btn btn-primary">Оновити</button>
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

        document.querySelectorAll('.remove-relative-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('.relative-item').remove();
            });
        });
    </script>
@endsection
