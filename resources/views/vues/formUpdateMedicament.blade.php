@extends('layouts.master')
@section('content')
  <br>
  <br>
  <br>

  <style>
      body {
          background-color: #c4dfff;
      }
  </style>
  <center><h1 style="font-weight: bold;">Modifier un médicament</h1></center>

  {!! Form::open(['url' => 'validerMedicament']) !!}
    <div class="col-md-12  col-sm-12 well well-md">
        <div class="form-horizontal">
            <input type="hidden" name="id_medicament" value="{{$unMedicament->id_medicament ?? 0}}"/>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Nom commercial : </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" name="nom_commercial" value="{{$unMedicament->nom_commercial ?? ''}}" class="form-control"
                           placeholder="Nom commercial" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Famille de médicament :</label>
                <div class="col-md-3 col-sm-3">
                    <select class="form-control" name="id_famille" required>
                        <option value="">Sélectionnez une famille</option>
                        @foreach($familles as $famille)
                            <option value="{{ $famille->id_famille }}" {{$unMedicament->id_famille == $famille->id_famille ? 'selected' : ''}}>{{ $famille->lib_famille }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Dépôt légal: </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="depot_legal" value="{{$unMedicament->depot_legal ?? ''}}" placeholder="Dépôt légal" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Effets : </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="effets" value="{{$unMedicament->effets ?? ''}}" placeholder="Effets" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Contre-indications: </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="contre_indication" value="{{$unMedicament->contre_indication ?? ''}}" placeholder="Contre-indications" required>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Prix échantillon :</label>
                <div class="col-md-3 col-sm-3">
                    <input type="number" class="form-control"  name="prix_echantillon" value="{{$unMedicament->prix_echantillon ?? ''}}" placeholder="Prix échantillon" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary" onclick="javascript: window.history.back();">
                        <span class="glyphicon glyphicon-remove"></span> Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop
