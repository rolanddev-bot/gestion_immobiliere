@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   


    <div class="col-lg-12">
    <h2  @if($location->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Bail @if($location->archiver == 1) archivé @endif <i class="fa fa-angle-double-right" style="font-size: px"></i> Détail </h2>
             
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  
  <p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('location')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{ url('location/'.$location->id.'/edit')}}" class="" style=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>

     @if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif

                </div>
                <div class="table-responsive p-3">



 <div class="row">
	 

    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Location</p>
		
        Type:  <span class="text-primary">{{ $location->type }}</span><br>
		
        Durée:  <span class="text-primary">{{ $location->duree.'an(s)' }}</span><br>
        Date location:  <span class="text-primary">{{ date('d/m/Y', strtotime($location->date_location)) }}</span><br>
        
        
		<br>
        Mode paiement:  <span class="text-primary">{{ $location->mode->libelle }}</span><br>
        Etat:  <span class="text-primary">{{ $location->etat}} </span><br>
        Révision loyer:  <span class="text-primary">{{ $location->revision_annuelle_loyer.' an(s)'}}</span><br>
		
		
		Frais agence:  <span class="text-primary">{{ separer($location->frais_agence, 3)  }}</span><br>
        Frais enregistrement:  <span class="text-primary">{{ separer($location->frais_enregistrement, 3)  }}</span><br>
        Frais timbre:  <span class="text-primary">{{ separer($location->frais_timbre, 3)  }}</span><br>
        Taux pénalité:  <span class="text-primary">{{ $location->taux_penalite.'%'  }}</span><br>
        Périodicité:  <span class="text-primary">{{ $location->periodicite_loyer  }}</span><br>
		<br>
		
        
    </div>

    <div class="col-md-4">
    <p class="" style="background-color: #CCC">Locataire & Bien</p>
        Locataire:  <span class="text-primary">{{ $location->locataire->nom.' '.$location->locataire->prenom}}</span><br>
        Locataire contact:  <span class="text-primary">{{ $location->locataire->mob1.' '.$location->locataire->mob2 }}</span><br>
		Bien loué:  <span class="text-primary">{{ $location->bien->libelle}}</span><br>
		Type Bien loué:  <span class="text-primary">{{ $location->bien->typebien->libelle }}</span><br>

    </div>
    <div class="col-md-4">
		<p class="" style="background-color: #CCC">Loyer & Dépôt</p>
        Loyer nu:  <span class="text-primary">{{ separer($location->loyer, 3)  }}</span><br>
		Montant charge:  <span class="text-primary">{{ separer($location->charge, 3)  }}</span><br>
		N° dépôt de garantie:  <span class="text-primary">{{ $location->ref_depot_garantie  }}</span><br>
        Montant Depôt de garantie:  <span class="text-primary">{{ separer($location->caution, 3)  }}</span><br>
		Nbre Mois correspondant:  <span class="text-primary">{{ separer($location->nbre_depot, 3)  }}</span><br>
        
    </div>   
</div>
<br>
<br>



                </div>
              </div>
            </div>





<div>






</div>



@endsection
