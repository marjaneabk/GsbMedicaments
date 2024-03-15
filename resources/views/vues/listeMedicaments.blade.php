@extends('layouts.master')
@section('content')
<table class="table table-bordered table-striped table-responsive">
    <thead>
    <tr>
        <th style="width:60%">Id médicament</th>
        <th style="width:60%">Famille</th>
        <th style="width:60%">depot_legal</th>
        <th style="width:60%">Nom </th>
        <th style="width:60%">Effet</th>
        <th style="width:60%">Contre Indication </th>
        <th style="width:60%">Prix   </th>
        <th style="width:20%">Modifier</th>
        <th style="width:20%">Supprimer</th>
    </tr>
    </thead>
    @foreach ($mesMedicaments as $unMedicament)
    <tr>
        <td> {{ $unMedicament->id_medicament }}</td>
        <td> {{ $unMedicament->id_famille }}</td>
        <td> {{ $unMedicament->depot_legal }}</td>
        <td> {{ $unMedicament->nom_commercial }}</td>
        <td> {{ $unMedicament->effets }}</td>
        <td> {{ $unMedicament->contre_indication }}</td>
        <td> {{ $unMedicament->prix_echantillon }}</td>
        <td style="text-align:center;"><a href="{{ url('/modifierFrais') }}/{{ $unMedicament->id_medicament }}">
                <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span>
                <td style="text-align:center;">
                    <a class="glyphicon glyphicon-remove" data-toggle= "tooltip" data-placement="top" title="Supprimer" onclick="javascript:if (confirm('Suppression confirmée ?')) { window.location ='{{ url('/supprimerFrais') }}/{{ $unMedicament->id_medicament }}'; }">>
                    </a>


            </a>
        </td>
    </tr>
    @endforeach
</table>
@include ('vues.error')
@stop
