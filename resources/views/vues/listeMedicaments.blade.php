@extends('layouts.master')
@section('content')
    <br>
<br> <br>
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

        .table tr:nth-child(even){background-color: #c4dfff;}

        .table {
            border: 1px solid #000000; /* Bordure en noir */

        }

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #c4dfff;
            color: black;
        }

         body {
             background-color: #c4dfff;
         }

        .container {
            margin-top: 50px;
        }


    </style>

    <center><h1 style="font-weight: bold;">Liste des interactions des médicaments</h1></center>

    <br>

    <form action="{{ url('/getListeMedicaments') }}" method="GET" style="width: 500px; margin: auto;">
        <input type="text" name="searchTerm" placeholder="Rechercher par nom" style="width: 70%; padding: 15px; font-size: 20px;">
        <input type="submit" value="Rechercher" style="width: 25%; padding: 15px; font-size: 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
    </form>




    <br>
    <table class="table table-striped ">
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
                <td> {{ $unMedicament->famille->lib_famille }}</td>
                <td> {{ $unMedicament->depot_legal }}</td>
                <td> {{ $unMedicament->effets }}</td>
                <td> {{ $unMedicament->contre_indication }}</td>
                <td> {{ $unMedicament->prix_echantillon }}</td>
                <td style="text-align:center;">
                    <a href="{{ url('/modifierMedicament') }}/{{ $unMedicament->id_medicament }}">
                        <span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="center" title="Modifier"></span>
                    </a>
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
