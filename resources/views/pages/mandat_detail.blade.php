@extends('layouts.main')
@section('content')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">

    <div class="col-lg-12">

    <h2  @if($mandat->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Mandat  @if($mandat->archiver == 1) archivé @endif - Détail </h2>

              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

				 @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
        {!! session('ok') !!}
        </div>
    @endif


<p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('mandat')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{ url('mandat/'.$mandat->id.'/edit')}}" class="" style=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>


                </div>
                <div class="table-responsive p-3">


 <div class="row">

    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Mandat</p>

        Réf. Mandat: &nbsp;  <span class="text-primary"><strong>{{ $mandat->ref }}</strong></span><br>
        Frais clôture: &nbsp;  <span class="text-primary"><strong>{{ $mandat->frais_cloture }}</strong></span><br>
        Fréquence :  &nbsp;<span class="text-primary">{{ $mandat->frequence_compte_rendu.' mois ' }}</span><br>
        Honoraire :  &nbsp;<span class="text-primary">{{ $mandat->honnoraire.'%' }}</span><br>
        Rénouvellement :  &nbsp;<span class="text-primary">{{ $mandat->renouvellement.' an(s)' }}</span><br>
        Fréquence compte-rendu (Mois) :  &nbsp;<span class="text-primary">{{ $mandat->frequence_compte_rendu }}</span><br>
        Commission:  &nbsp;<span class="text-primary">{{ $mandat->commission }}</span><br>
        Durée:  &nbsp;<span class="text-primary">{{$mandat->duree.' an(s)'}}</span><br>

        Personne en charge de l'impôt:  &nbsp;<span class="text-primary">
        @if($mandat->impot==1) Propriétaire @elseif($mandat->impot==2) Bailleur @elseif($mandat->impot==3) Locataire @endif
         </span><br><br>

        Date de création:  &nbsp;<span class="text-primary">{{date('d/m/Y', strtotime($mandat->date_enregistrement))}}</span><br>
        Date prise d'effet:  &nbsp;<span class="text-primary">{{date('d/m/Y', strtotime($mandat->date_prise_effet))}}</span><br>

    </div>

    <div class="col-md-4">
    <p class="" style="background-color: #CCC">Bailleur</p>

    	@foreach($appartenirs as $appart)

        {!! '<span class="text-primary">'.$appart->proprietaire->nom.' '.$appart->proprietaire->prenom.'</span>, ' !!}

        @endforeach

        <br>
        <br>

        <p class="" style="background-color: #CCC">Fichier joint</p>

        Fichier 1:  &nbsp;
        @if($mandat->doc1 !='')<a href="{{ url('mandat/'.$mandat->bien->doc1) }}" class="text-primary">Téléchargé</a> @endif<br>

        Fichier 2:  &nbsp;
        @if($mandat->doc2 !='')<a href="{{ url('mandat/'.$mandat->bien->doc1) }}" class="text-primary">Téléchargé </a> @endif<br>

    </div>
    <div class="col-md-4">
    <p class="" style="background-color: #CCC">Bien</p>

        Type de bien:  &nbsp;<span class="text-primary">{{$mandat->bien->typebien->libelle}}</span><br>
        Bien: &nbsp;  <span class="text-primary">{{$mandat->bien->libelle}}</span><br>
        Lot/Ilot:  &nbsp;<span class="text-primary">{{ $mandat->bien->lot.'/'.$mandat->bien->ilot }}</span>



    </div>
</div>



</div>



@endsection
