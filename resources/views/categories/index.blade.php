@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Categorías</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Campañas Asociadas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->campaigns()->count() }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('¿Eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection
