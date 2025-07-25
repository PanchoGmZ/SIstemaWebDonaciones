@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Crear Categoría</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Categoría</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
