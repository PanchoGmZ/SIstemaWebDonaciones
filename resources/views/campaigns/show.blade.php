@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>{{ $campaign->title }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p><strong>Fundación:</strong> {{ $campaign->foundationProfile->name ?? 'N/A' }}</p>
    <p><strong>Categoría:</strong> {{ $campaign->category->name ?? 'N/A' }}</p>
    <p><strong>Descripción:</strong></p>
    <p>{{ $campaign->description }}</p>
    <p><strong>Monto Meta:</strong> ${{ number_format($campaign->goal_amount, 2) }}</p>
    <p><strong>Monto Recaudado:</strong> ${{ number_format($campaign->collected_amount, 2) }}</p>
    <p><strong>Fecha Límite:</strong> {{ \Carbon\Carbon::parse($campaign->deadline)->format('d/m/Y') }}</p>

    @if($campaign->image_url)
        <div>
            <img src="{{ asset('storage/' . $campaign->image_url) }}" alt="Imagen campaña" style="max-width: 400px;">
        </div>
    @endif

    <hr>

    <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning">Editar Campaña</a>
    <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>
@endsection
