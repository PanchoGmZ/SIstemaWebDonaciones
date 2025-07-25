@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Donaciones</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('donations.create') }}" class="btn btn-primary mb-3">Nueva Donación</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Campaña</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->user->name }}</td>
                    <td>{{ $donation->campaign->title }}</td>
                    <td>${{ number_format($donation->amount, 2) }}</td>
                    <td>{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('donations.show', $donation->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('¿Eliminar esta donación?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $donations->links() }}
</div>
@endsection
