@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">

    {{-- 🔹 Título de la página --}}
    <h2>Editar Perfil de Fundación</h2>

    {{-- 🔸 Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    {{-- 🔹 Formulario de edición --}}
    <form action="{{ route('foundation-profiles.update', $foundationProfile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 🔸 Selector de usuario --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $foundationProfile->user_id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 🔸 Nombre de la Fundación --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Fundación</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ old('name', $foundationProfile->name) }}" required>
        </div>

        {{-- 🔸 Descripción --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $foundationProfile->description) }}</textarea>
        </div>

        {{-- 🔸 Logo actual --}}
        @if ($foundationProfile->logo)
            <div class="mb-3">
                <label class="form-label">Logo actual:</label><br>
                <img src="{{ $foundationProfile->logo }}" alt="Logo" style="max-height: 120px;">
            </div>
        @endif

        {{-- 🔸 Subir nuevo logo --}}
        <div class="mb-3">
            <label for="logo" class="form-label">Nuevo logo (opcional)</label>
            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
        </div>

        {{-- 🔸 Botones --}}
        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
        <a href="{{ route('foundation-profiles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
