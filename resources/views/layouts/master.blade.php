<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB Médicaments</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/monStyle.css') }}">
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
    <style>


        .navbar {
            margin-bottom: 0;
            background-color: #f8f8f8;
            border-color: #e7e7e7;
        }

        .navbar-fixed-top {
            border: none;
        }


        .navbar-nav > li > a {
            color: #333;
        }

        .navbar-nav > li > a:hover,
        .navbar-nav > li > a:focus {
            color: #555;
            background-color: transparent;
        }

        .container {
            margin-top: 20px;
        }


    </style>
</head>
<body class="body">
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
            @if (Session::get('id') == 0)
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/formLogin') }}" data-toggle="collapse"
                               data-target=".navbar-collapse.in">Se connecter</a></li>
                    </ul>
                </div>
            @endif
            @if (Session::get('id') > 0)
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

            @endif
        </div>
    </nav>
</div>
<div class="container">
    @yield('content')
</div>


<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</body>
</html>
