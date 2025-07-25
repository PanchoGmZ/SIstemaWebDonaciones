@extends('Layouts.plantilla')

@section('content')
<div class="container py-4">
    <h2>Crear Nueva Donación</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccione un usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="campaign_id" class="form-label">Campaña</label>
            <select name="campaign_id" id="campaign_id" class="form-control" required>
                <option value="">Seleccione una campaña</option>
                @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                        {{ $campaign->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Monto</label>
            <input type="number" step="0.01" min="0.01" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Donación</button>
        <a href="{{ route('donations.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
