@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   


    <div class="col-lg-12">
    <h2 class="text-center alert alert-secondary">Transaction - Détail </h2>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
     <a href="{{ route('vente')}}">Retour</a>


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
        Réf:  <span class="text-primary">{{ $vente->reference }}</span><br>
        Bien loué:  <span class="text-primary">{{$vente->bien->libelle}}</span><br>
        Prix:  <span class="text-primary">{{ separer($vente->prix_unitaire, 3) }}</span><br>
        
    </div>

    <div class="col-md-4">
    
     
        Condition vente:  <span class="text-primary">{{ $vente->condition_vente  }}</span><br>
        Valeur HT:  <span class="text-primary">{{ separer($vente->prix_unitaire, 3)  }}</span><br>
        Valeur TTC:  <span class="text-primary">{{ separer($vente->montant_total,3)  }}</span><br>
        Remise:  <span class="text-primary">{{ $vente->remise  }}</span><br>
        Statut:  <span class="text-primary">{{ $vente->statut  }}</span><br>

    </div>
    <div class="col-md-4">
        Date vente:  <span class="text-primary">{{ date('d/m/Y', strtotime($vente->date_vente)) }}</span><br>
    </div>   
</div>
<br>
<br>



                </div>
              </div>
            </div>





<div>


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

                   


                </div>
            </div>
        </div>
    </div>



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



                </div>
            </div>
        </div>
    </div>





</div>



@endsection
