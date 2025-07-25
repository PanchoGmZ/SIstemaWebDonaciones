@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Detalle de Donación #{{ $donation->id }}</h2>

    <div class="card p-3">
        <p><strong>Usuario:</strong> {{ $donation->user->name }} ({{ $donation->user->email }})</p>
        <p><strong>Campaña:</strong> {{ $donation->campaign->title }}</p>
        <p><strong>Monto:</strong> ${{ number_format($donation->amount, 2) }}</p>
        <p><strong>Fecha:</strong> {{ $donation->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <a href="{{ route('donations.edit', $donation->id) }}" class="btn btn-warning mt-3">Editar</a>
    <a href="{{ route('donations.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</div>
@endsection
