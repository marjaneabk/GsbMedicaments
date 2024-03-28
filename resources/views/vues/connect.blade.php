@extends('layouts.master')
@section('content')

    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navbar-collapse-target">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">GSB Médicaments</a>

                </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-target">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/getListeMedicaments') }}" data-toggle="collapse"
                                   data-target=".navbar-collapse.in">Lister</a></li>
                            <li><a href="{{ url('/ajouterMedicament') }}" data-toggle="collapse"
                                   data-target=".navbar-collapse.in">Ajouter</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/getLogout') }}" data-toggle="collapse"
                                   data-target=".navbar-collapse.in">Se déconnecter</a></li>
                        </ul>
                    </div>
            </div>
        </nav>
    </div>
    <div style="text-align: center;">
        <img src="{{ url('https://mbriand.fr/wp-content/uploads/2018/08/gsblogo.png') }}" alt="" >
    </div>

    <div class="container-fluid text-center" style="color:dodgerblue ; padding: 20px; font-family: Georgia">
        <?php
        use Illuminate\Support\Facades\Session;
        $nomVisiteur = Session::get('nom_visiteur');
        ?>
        @if(isset($nomVisiteur))
            <h2>Bonjour {{ $nomVisiteur }},</h2>
        @endif
        <h2>Bienvenue sur la gestion de la formulation des médicaments</h2>
    </div>

@stop
