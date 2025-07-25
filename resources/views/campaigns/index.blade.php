@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Campañas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('campaigns.create') }}" class="btn btn-primary mb-3">Crear Nueva Campaña</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fundación</th>
                <th>Categoría</th>
                <th>Monto Meta</th>
                <th>Monto Recaudado</th>
                <th>Fecha Límite</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->title }}</td>
                    <td>{{ $campaign->foundationProfile->name ?? 'N/A' }}</td>
                    <td>{{ $campaign->category->name ?? 'N/A' }}</td>
                    <td>${{ number_format($campaign->goal_amount, 2) }}</td>
                    <td>${{ number_format($campaign->collected_amount, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($campaign->deadline)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar esta campaña?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No hay campañas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $campaigns->links() }}
</div>
@endsection
