@extends('layouts.master')
@section('content')
    <h1 style="text-align: center; font-weight: bold;">Fiche détail d'un Médicament: </h1>
    <h2 style="font-style: italic;">{{ $medicament->nom_commercial }}</h2>
    <p>Id médicament: {{ $medicament->id_medicament }}</p>
    <p>Famille: {{ $medicament->id_famille }}</p>
    <p>Depot legal: {{ $medicament->depot_legal }}</p>
    <p>Effet: {{ $medicament->effets }}</p>
    <p>Contre Indication: {{ $medicament->contre_indication }}</p>
    <p>Prix: {{ $medicament->prix_echantillon }}</p>
    <h2 style="font-style: italic;">Intéraction médicamenteuses</h2>
    <ul>
        @foreach ($contraindicatedDrugs as $drug)
            <li>{{ $drug->nom_commercial }}</li>
        @endforeach
    </ul>

    <h3>Ajouter un médicament contre-indiqué</h3>
    {!! Form::open(['url' => '/addInteraction/' . $medicament->id_medicament, 'method' => 'post']) !!}
    {!! Form::token() !!}
    <div class="form-group">
        <div class="col-md-3 col-sm-3">
            <select class="form-control" name="id_interaction" required>
                <option value="">Sélectionnez un medicament</option>
                @foreach ($allDrugs as $drug)
                    <option value="{{ $drug->id_medicament }}">{{ $drug->nom_commercial }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-default btn-primary">
        <span class="glyphicon glyphicon-ok"></span> Valider
    </button>
    {!! Form::close() !!}

    <h3>Supprimer un médicament contre-indiqué</h3>
    {!! Form::open(['url' => '/deleteInteraction/' . $medicament->id_medicament, 'method' => 'post']) !!}
    {!! Form::token() !!}
    <div class="form-group">
        <div class="col-md-3 col-sm-3">
            <select class="form-control" name="id_interaction" required>
                <option value="">Sélectionnez un medicament</option>
                @foreach ($contraindicatedDrugs as $drug)
                    <option value="{{ $drug->id_medicament }}">{{ $drug->nom_commercial }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @method('DELETE')
    <button type="submit" class="btn btn-default btn-primary">
        <span class="glyphicon glyphicon-remove"></span> Supprimer
    </button>
    {!! Form::close() !!}
@stop
