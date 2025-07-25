@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Crear Perfil de Fundación</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('foundation-profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccione un usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Fundación</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo (opcional)</label>
            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Perfil</button>
        <a href="{{ route('foundation-profiles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
