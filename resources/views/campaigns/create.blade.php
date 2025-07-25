@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Crear Nueva Campaña</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="foundation_profile_id" class="form-label">Fundación</label>
            <select name="foundation_profile_id" id="foundation_profile_id" class="form-control" required>
                <option value="">Seleccione una Fundación</option>
                @foreach($foundations as $foundation)
                    <option value="{{ $foundation->id }}" {{ old('foundation_profile_id') == $foundation->id ? 'selected' : '' }}>
                        {{ $foundation->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Seleccione una Categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required minlength="3" maxlength="255">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" required minlength="10" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="goal_amount" class="form-label">Monto Meta</label>
            <input type="number" name="goal_amount" id="goal_amount" class="form-control" value="{{ old('goal_amount') }}" required min="0" step="0.01">
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label">Fecha Límite</label>
            <input type="date" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen (opcional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Crear Campaña</button>
        <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
