@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   


    <div class="col-lg-12">
    
    <h2  @if($etat->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Etat des lieux @if($etat->archiver == 1) archivé @endif <i class="fa fa-angle-double-right" style="font-size: px"></i> Détail </h2>
             
             
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  
  <p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('etat')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
  
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
      	<p class="" style="background-color: #CCC">Etat des lieux</p>
      	
       	Réf. Etat:  <span class="text-primary">{{ $etat->ref }}</span><br>
       	Date état:  <span class="text-primary">{{ date('d/m/Y', strtotime($etat->date_etat)) }}</span><br>
       	Sortie/Entrée:  <span class="text-primary">{{ $etat->entree_sortie }}</span><br>
       	Clôturer:  <span class="text-primary">@if($etat->cloture == 0) Non @else Oui @endif</span><br><br>
    </div>
    

    <div class="col-md-4">
    <p class="" style="background-color: #CCC">Avis & Conclusion</p>
    	Avis bailleur :  <br><span class="text-primary">{{ $etat->avis_locataire}}</span><br><br>
        Avis locataire:  <br><span class="text-primary">{{ $etat->avis_bailleur }}</span><br><br>
        
        Conclusion:  <br><span class="text-primary">{{ $etat->detail }}</span><br>
    </div>
    
    
    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Bien et propriétaire</p>
       
        Bien:  <span class="text-primary">{{ $etat->location->bien->libelle }}</span><br>
        Locataire:  <span class="text-primary">{{ $etat->location->locataire->nom.' '.$etat->location->locataire->prenom  }}</span><br>
        Locataire mobile:  <span class="text-primary">{{ $etat->location->locataire->mobile1.' '.$etat->location->locataire->mobile2  }}</span><br>
     
    </div>   
</div>
<br>
<br>

<p align="center">
  
  @if($etat->entree_sortie == 'Entrée')
<button style="width:400px" class="btn btn-primary bg-navbar" data-toggle="modal" 
data-target="#modalEtatEntrant" >ETAT DES LIEUX ENTRANT 
@if($etat->cloture == 1 ) <i class="fas fa-lock" style="font-size:15px"></i> @else 
<i class="fas fa-lock-open" style="font-size:15px"></i>
 @endif
</button>


@else

<button style="width:400px" class="btn btn-warning" data-toggle="modal" 
data-target="#modalEtatSortant">

ETAT DES LIEUX SORTANT

@if($etats->cloture == 1 ) <i class="fas fa-lock" style="font-size:15px"></i> @else 
<i class="fas fa-lock-open" style="font-size:15px"></i>
 @endif

</button>
@endif

</p>

                </div>
              </div>
            </div>





<div>

@if($etat->entree_sortie == 'Entrée')
<div class="modal fade bd-example-modal-xl" id="modalEtatEntrant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" style="text-align: center;" id="titremodal">ETAT DES LIEUX ENTRANT</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @include('pages.location_etat_entrant')


                </div>
            </div>
        </div>
    </div>


@else


<div class="modal fade bd-example-modal-xl" id="modalEtatSortant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" style="text-align: center;" id="titremodal">ETAT DES LIEUX SORTANT</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @include('pages.location_etat_sortant')


                </div>
            </div>
        </div>
    </div>
    
@endif



</div>



@endsection
