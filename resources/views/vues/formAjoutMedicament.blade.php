@extends('layouts.master')
@section('content')

    <br>
    <br>
    <br>

    {!! Form::open(['url' => 'validerMedicament']) !!}
    <div class="col-md-12  col-sm-12 well well-md">
        <center><h1> </h1></center>
        <div class="form-horizontal">
            <input type="hidden" name="id_medicament" value=""/>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label"> Nom du medicament : </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="nom_commercial" value="" placeholder="Nom commercial" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Famille de médicament :</label>
                <div class="col-md-3 col-sm-3">
                    <select class="form-control" name="id_famille" required>
                        <option value="">Sélectionnez une famille</option>
                        @foreach($familles as $famille)
                            <option value="{{ $famille->id_famille }}">{{ $famille->lib_famille }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Dépot Legal: </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="depot_legal" value="" placeholder="Dépot Legal" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Effets : </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="effets" value="" placeholder="Effets" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Contre Indications: </label>
                <div class="col-md-3 col-sm-3">
                    <input type="text" class="form-control" name="contre_indications" value="" placeholder="Contre Indications" required>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label"> Prix :</label>
                <div class="col-md-3 col-sm-3">
                    <input type="number" class="form-control"  name="prix_echantillon" value="" placeholder="Prix echantillon" required>
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
            <div class="col-md-6 col-md-offset-3  col-sm-6 col-sm-offset-3">

            </div>
        </div>
    </div>
@stop
