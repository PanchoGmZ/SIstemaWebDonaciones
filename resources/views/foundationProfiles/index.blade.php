@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Perfiles de Fundaciones</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('foundation-profiles.create') }}" class="btn btn-success mb-3">+ Crear Perfil</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Logo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foundationProfiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->user->name }}</td>
                    <td>
                        @if($profile->logo)
                            <img src="{{ $profile->logo }}" alt="Logo" height="40">
                        @else
                            Sin logo
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('foundation-profiles.show', $profile->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('foundation-profiles.edit', $profile->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('foundation-profiles.destroy', $profile->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este perfil?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $foundationProfiles->links() }}
</div>
@endsection
