@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Detalle del Perfil de Fundación</h2>

    <div class="mb-3">
        <strong>Nombre:</strong> {{ $foundationProfile->name }}
    </div>

    <div class="mb-3">
        <strong>Usuario:</strong> {{ $foundationProfile->user->name }} ({{ $foundationProfile->user->email }})
    </div>

    <div class="mb-3">
        <strong>Descripción:</strong><br>
        {{ $foundationProfile->description }}
    </div>

    @if($foundationProfile->logo)
        <div class="mb-3">
            <strong>Logo:</strong><br>
            <img src="{{ $foundationProfile->logo }}" alt="Logo" style="max-height:150px;">
        </div>
    @endif

    <a href="{{ route('foundation-profiles.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('foundation-profiles.edit', $foundationProfile->id) }}" class="btn btn-primary">Editar</a>
</div>
@endsection
