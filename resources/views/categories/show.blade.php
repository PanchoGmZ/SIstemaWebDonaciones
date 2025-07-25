@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Categoría: {{ $category->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4>Campañas Asociadas</h4>
    @if($category->campaigns->count())
        <ul>
            @foreach($category->campaigns as $campaign)
                <li><a href="{{ route('campaigns.show', $campaign->id) }}">{{ $campaign->title }}</a></li>
            @endforeach
        </ul>
    @else
        <p>No hay campañas asociadas a esta categoría.</p>
    @endif

    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning mt-3">Editar Categoría</a>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
</div>
@endsection
