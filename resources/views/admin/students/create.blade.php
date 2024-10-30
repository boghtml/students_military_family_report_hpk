@extends('layouts.admin')

@section('title', 'Додати студента')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Додати нового студента</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.students.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Прізвище</label>
                            <input type="text" 
                                   class="form-control @error('last_name') is-invalid @enderror" 
                                   id="last_name" 
                                   name="last_name" 
                                   value="{{ old('last_name') }}" 
                                   required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">Ім'я</label>
                            <input type="text" 
                                   class="form-control @error('first_name') is-invalid @enderror" 
                                   id="first_name" 
                                   name="first_name" 
                                   value="{{ old('first_name') }}" 
                                   required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">По батькові</label>
                            <input type="text" 
                                   class="form-control @error('middle_name') is-invalid @enderror" 
                                   id="middle_name" 
                                   name="middle_name" 
                                   value="{{ old('middle_name') }}" 
                                   required>
                            @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="group_name" class="form-label">Група</label>
                            <input type="text" 
                                   class="form-control @error('group_name') is-invalid @enderror" 
                                   id="group_name" 
                                   name="group_name" 
                                   value="{{ old('group_name') }}" 
                                   required>
                            @error('group_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="military_relation" class="form-label">Військове відношення</label>
                            <input type="text" 
                                   class="form-control @error('military_relation') is-invalid @enderror" 
                                   id="military_relation" 
                                   name="military_relation" 
                                   value="{{ old('military_relation') }}" 
                                   required>
                            @error('military_relation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Зберегти
                            </button>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x"></i> Скасувати
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection