@extends('layouts.master')
@section('content')
    <br>
    <br>
    <br>
    <style>
        /* Style pour la table */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style pour les cellules de la table */
        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Style pour l'en-tête de la table */
        .table thead th {
            background-color: #f2f2f2;
            color: #333;
        }

        /* Style pour les lignes impaires de la table */
        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Style pour les liens dans la table */
        .table a {
            color: #337ab7;
        }

        /* Style pour l'icône du lien */
        .table a .glyphicon {
            font-size: 16px;
            margin-right: 5px;
        }
        .table a .glyphicon-edit {
            color: black;
        }

        .table a .glyphicon-trash {
            color: red;
        }
        /* Style pour l'icône du lien Supprimer */


        /* Style pour les tooltips */
        [data-toggle="tooltip"] {
            position: relative;
        }

        .tooltip {
            position: absolute;
            z-index: 1;
            display: none;
            padding: 5px;
            background-color: #333;
            color: #fff;
            border-radius: 3px;
            font-size: 12px;
        }

        [data-toggle="tooltip"]:hover .tooltip {
            display: block;
        }
    </style>
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
                <td style="text-align:center;">
                    <a href="{{ url('/modifierMedicament') }}/{{ $unMedicament->id_medicament }}">
                        <span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="center" title="Modifier"></span>                    </a>
                </td>
                <td style="text-align:center;">
                    <a class="glyphicon glyphicon-trash" data-toggle= "tooltip" data-placement="top"  style="color: red;" title="Supprimer" onclick="javascript:if (confirm('Suppression confirmée ?')) { window.location ='{{ url('/supprimerMedicament') }}/{{ $unMedicament->id_medicament }}'; }">
                    </a>
                </td>


            </tr>
        @endforeach
    </table>
    @include ('vues.error')
@stop
