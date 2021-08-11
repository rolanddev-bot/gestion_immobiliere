@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   

    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Contrat - Modifié </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
     <a href="{{ route('location')}}">Retour</a>


                </div>
                <div class="table-responsive p-3">

@if(session()->has('ok'))
    <div class="alert alert-danger alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

 
<br>
<br>

  
<form  name="form_location" method="POST" action="{{ route('locationupdate') }}" id="form_location" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
    <input type="hidden" name="location_id" id="location_id" value="{{ $location->id }}">

   
<div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <strong>Date location <b style="color: red;">*</b></strong>
                <input type="date" name="date_location" id="date_location"  class="form-control" value="{{ $location->date_location }}" required>
                <span class="text-danger">{{ $errors->first('date_location') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Date prise d'effet <b style="color: red;">*</b></strong>
                <input type="date" name="date_echeance" id="date_echeance"  class="form-control" value="{{ $location->date_echeance }}" required>
                <span class="text-danger">{{ $errors->first('date_echeance') }}</span>


            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Date paiement <b style="color: red;">*</b></strong>
                <input type="number" name="jour_paiement" id="jour_paiement"  value="{{ $location->jour_paiement }}"  class="form-control" required>
                <span class="text-danger">{{ $errors->first('date_location') }}</span>
            </div>
        </div>

        <div class="col-md-3">

            <div class="form-group">
                <strong>Etat<b style="color: red;">*</b></strong>
                <select class="form-control" id="etat" name="etat" required>
                    <option value="{{ $location->etat }}">{{ $location->etat }}</option>
                    <option value="En cours">En cours</option>
                    <option value="Suspendu">Suspendu</option>
                    <option value="Résillié">Résillié</option>

                </select>
                <span class="text-danger">{{ $errors->first('Etat_Contrat') }}</span>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <strong>Périodicité paiement loyer<b style="color: red;">*</b></strong>
                <select class="form-control" id="periodicite_loyer" name="periodicite_loyer" required>
                    <option value="{{ $location->periodicite_loyer }}">{{ $location->periodicite_loyer }}</option>
                    <option value="Mensuel">Mensuel</option>
                    <option value="Bimestriel">Bimestriel</option>
                    <option value="Trimestriel">Trimestriel</option>
                    <option value="Semestriel">Semestriel</option>
                    <option value="Annuel">Annuel</option>
                </select>
                <span class="text-danger">{{ $errors->first('Periodicité') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <strong>Mode paiement<b style="color: red;">*</b></strong>
                <select class="form-control" id="mode_id" name="mode_id" required>
                    <option value="{{ $location->mode_id }}">{{ $location->mode->libelle }}</option>
                    
                     @foreach($modes as $mode)
                    <option value="{{ $mode->id }}">{{ $mode->libelle }}</option>
                   @endforeach
                   
                </select>
                <span class="text-danger">{{ $errors->first('Periodicité') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <strong>Durée contrat(an)<b style="color: red;">*</b></strong>
            <input type="number"  id="duree" class="form-control"  name="duree" value="{{ $location->duree }}" required>
            <span class="text-danger">{{ $errors->first('Honoraire') }}</span>
            </div>
        </div>
        
        <div class="col-md-3">

            <div class="form-group">
                <strong>Type contrat<b style="color: red;">*</b></strong>
                <select class="form-control" id="type" name="type" required>
                    <option value="{{ $location->type }}">{{ $location->type }}</option>
                    <option value="Commercial">Commercial</option>
                    <option value="Habitation">Habitation</option>

                </select>
                <span class="text-danger">{{ $errors->first('Etat_Contrat') }}</span>
            </div>
        </div>



    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
            <strong>Montant loyer HT <b style="color: red;">*</b></strong>
            <input type="number"  id="loyer" class="form-control"  name="loyer" value="{{ $location->loyer }}" required >
            <span class="text-danger">{{ $errors->first('loyer') }}</span>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
            <strong>Montant dépôt de garantie <b style="color: red;">*</b></strong>
            <input type="number"  id="caution" class="form-control"  name="caution" value="{{ $location->caution }}" required>
            <span class="text-danger">{{ $errors->first('caution') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <strong>Nbre Mois dépôt de garantie</strong>
            <input type="number"  id="nbre_depot" class="form-control"  value="{{ $location->nbre_depot }}" name="nbre_depot">
            <span class="text-danger">{{ $errors->first('caution') }}</span>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
            <strong>Révision loyer(an)<b style="color: red;">*</b></strong>
            <input type="number" name="revision_annuelle_loyer" id="revision_annuelle_loyer" class="form-control"  value="{{ $location->revision_annuelle_loyer }}">
            <span class="text-danger">{{ $errors->first('Honoraire') }}</span>
            </div>
        </div>
    </div>


    <div class="row">
    
    <div class="col-md-3">
            <div class="form-group">
            <strong>Montant charge</strong>
            <input type="number"  id="charge" class="form-control"  name="charge" value="{{ $location->charge }}" >
            <span class="text-danger">{{ $errors->first('frais_enregistrement') }}</span>
            </div>
        </div>


    <div class="col-md-3">
            <div class="form-group">
            <strong>Frais enregistrement</strong>
            <input type="number"  id="frais_enregistrement" class="form-control" value="{{ $location->frais_enregistrement }}"  name="frais_enregistrement">
            <span class="text-danger">{{ $errors->first('frais_enregistrement') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <strong>Frais agence</strong>
            <input type="number"  id="frais_agence" class="form-control" value="{{ $location->frais_agence }}"  name="frais_agence">
            <span class="text-danger">{{ $errors->first('Honoraire') }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <strong>Frais timbre</strong>
            <input type="number"  id="frais_timbre" class="form-control" value="{{ $location->frais_timbre }}"  name="frais_timbre">
            <span class="text-danger">{{ $errors->first('Honoraire') }}</span>
            </div>
        </div>

       <div class="col-md-3">
            <div class="form-group">
            <strong>Taux Penalité (%)</strong>
            <input type="number"  id="taux_penalite" class="form-control"  value="{{ $location->taux_penalite }}" name="taux_penalite">
            <span class="text-danger">{{ $errors->first('Honoraire') }}</span>
            </div>
        </div>


</div>

    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
            <strong>Information complémentaire:</strong>
            <textarea id="detail" cols="5" class="form-control"  name="detail">{{ $location->detail }}</textarea>
            <span class="text-danger">{{ $errors->first('complement') }}</span>
            </div>
        </div>
    </div>



<p align="right">
    <button type="submit" class="btn btn-success" style="width: 150px" title="Soumettre la modification" id="">Appliquer</button>
    </p>
</form>



                </div>
              </div>
            </div>














</div>



@endsection
