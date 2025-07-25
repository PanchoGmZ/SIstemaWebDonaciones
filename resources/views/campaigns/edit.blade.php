@extends('layouts.plantilla')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Campaña: {{ $campaign->title }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('campaigns.update', $campaign->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="foundation_profile_id" class="form-label">Fundación</label>
                                <select class="form-select" id="foundation_profile_id" name="foundation_profile_id" required>
                                    @foreach($foundations as $foundation)
                                        <option value="{{ $foundation->id }}" {{ $foundation->id == $campaign->foundation_profile_id ? 'selected' : '' }}>
                                            {{ $foundation->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Categoría</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $campaign->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $campaign->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $campaign->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="goal_amount" class="form-label">Meta ($)</label>
                                <input type="number" class="form-control" id="goal_amount" name="goal_amount" 
                                       value="{{ old('goal_amount', $campaign->goal_amount) }}" min="0" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="deadline" class="form-label">Fecha Límite</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" 
                                       value="{{ old('deadline', $campaign->deadline->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input class="form-control" type="file" id="image" name="image">
                            @if($campaign->image_url)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$campaign->image_url) }}" width="200" class="img-thumbnail">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                        <label class="form-check-label" for="remove_image">
                                            Eliminar imagen actual
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection