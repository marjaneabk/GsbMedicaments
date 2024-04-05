@extends('layouts.master')
@section('content')

    <h1 style="text-align: center; font-weight: bold;">Fiche détail d'un Médicament: </h1>
    <h2 style="font-style: italic;">{{ $medicament->nom_commercial }}</h2>
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
    {!! Form::open(['url' => '/detailsMedicament/' . $medicament->id_medicament, 'method' => 'post']) !!}
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

    <h3>Supprimer ou Modifier un médicament contre-indiqué</h3>
    @foreach($contraindicatedDrugs as $drug)
        <p>{{ $drug->nom_commercial }}

        <form action="{{ route('modifierMedicamentCompatible') }}" method="POST">
            @csrf
            <input type="hidden" name="id_medicament" value="{{ $medicament->id_medicament }}">
            <input type="hidden" name="old_med_id_medicament" value="{{ $drug->id_medicament }}">

            <select name="new_med_id_medicament">
                @foreach($allDrugs as $medicamentOption)
                    <option value="{{ $medicamentOption->id_medicament }}" {{ $medicamentOption->id_medicament == $drug->id_medicament ? 'selected' : '' }}>
                        {{ $medicamentOption->nom_commercial }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-default btn-primary">
            Modifier
            </button>

        <a class="glyphicon glyphicon-trash" data-toggle= "tooltip" data-placement="top"  style="color: red;" title="Supprimer" onclick="javascript:if (confirm('Suppression confirmée ?')) { window.location ='{{ url('/supprimerInteraction') }}/{{ $medicament->id_medicament }}/{{ $drug->id_medicament }}'; }">
        </a>
        </p>
        </form>

    @endforeach



@stop

