@extends('layouts.master')
@section('content')
    <br>
    <br>
    <br>
    <style>
        .search-bar input[type="text"] {
            width: 50%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-bar input[type="submit"] {
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: dodgerblue;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-bar input[type="submit"]:hover {
            background-color: darkblue;
        }

        .delete-link {
            color: red;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .delete-link:hover {
            color: darkred;
        }
    </style>

    <div class="search-bar">
    <form action="{{ url('/rechercheMedicament') }}" method="GET">
        <input type="text" name="recherche" placeholder="Rechercher un médicament">
        <input type="submit" value="Rechercher">
    </form>
    </div>


    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <tr>
            <th style="width:60%">Nom </th>
            <th style="width:60%">Id médicament</th>
            <th style="width:60%">Famille</th>
            <th style="width:60%">depot_legal</th>
            <th style="width:60%">Effet</th>
            <th style="width:60%">Contre Indication </th>
            <th style="width:60%">Prix   </th>
            <th style="width:20%">Modifier</th>
            <th style="width:20%">Supprimer</th>
        </tr>
        </thead>
        @foreach ($mesMedicaments as $unMedicament)
            <tr>
                <td>
                    <a href="{{ url('/detailsMedicament') }}/{{ $unMedicament->id_medicament }}">
                        {{ $unMedicament->nom_commercial }}
                    </a>
                </td>
                <td> {{ $unMedicament->id_medicament }}</td>
                <td> {{ $unMedicament->id_famille }}</td>
                <td> {{ $unMedicament->depot_legal }}</td>
                <td> {{ $unMedicament->effets }}</td>
                <td> {{ $unMedicament->contre_indication }}</td>
                <td> {{ $unMedicament->prix_echantillon }}</td>
                <td style="text-align:center;">
                    <a href="{{ url('/modifierMedicament') }}/{{ $unMedicament->id_medicament }}">
                        <span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="center" title="Modifier"></span>                    </a>
                </td>
                <td style="text-align:center;">
                    <a class="glyphicon glyphicon-trash delete-link" data-toggle= "tooltip" data-placement="top"  title="Supprimer" onclick="javascript:if (confirm('Suppression confirmée ?')) { window.location ='{{ url('/supprimerMedicament') }}/{{ $unMedicament->id_medicament }}'; }">
                    </a>
                </td>


            </tr>
        @endforeach

    </table>
    @include ('vues.error')
@stop
