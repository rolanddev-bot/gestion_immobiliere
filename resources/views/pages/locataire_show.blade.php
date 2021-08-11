@extends('layouts.main')
@section('content')

@include('pages.incl_fonction')

<script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>



<div class="container-fluid" id="container-wrapper">
   


    <div class="col-lg-12">
<h2  @if($locataire->archiver == 1) class="text-center alert " style="background-color:darksalmon" @else class="text-center alert alert-secondary" @endif>Locataire @if($locataire->archiver == 1) archivé @endif <i class="fa fa-angle-double-right" style="font-size: px"></i> Détail </h2>
             
             
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<p>
   <a href="javascript:window.history.go(-1)" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Retour</a> |
   <a href="{{ url('locataire')}}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Liste</a>
   |
   <a href="{{ url('locataire/'.$locataire->id.'/edit')}}" class="" style=""><i class="fas fa-fw fa-edit" style="font-size:15px"></i>Editer</a>
</p>

@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    {!! session('ok') !!}
    </div>
@endif
                


                </div>
                <div class="table-responsive p-3">


@if($fact_nb>0)
     <div class="alert alert-danger alert-dismissible" role="alert" style="height:5%; line-height:0.7; width:60%; margin:auto; text-align:center">
     
 <p>Ce locataire a <a href="#"class="" data-toggle="modal" 
data-target="#modalEtatEntrant" style="color: #fff">{{ $fact_nb }} avis d'échéance</a>  en attentes.</p>
   
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:0.5"><span aria-hidden="true">&times;</span></button>
    
    </div>            
@endif


<br>
<p align="center">
   @if($locataire->photo != 'aucun')
        <img width="100" class="" height="100" src="{{ url('/assets/dossier/'.$locataire->photo) }}" class="img-thumbnail">
    @else
        <img width="100" class="" height="100" src="{{ url('/assets/img/avatar.png') }}" class="img-thumbnail">
    @endif
 </p>
 
 
 <div class="row">

   @if($locataire->type_locataire_acq == 'personne morale')

    <div class="col-md-4">
    	<p class="" style="background-color: #CCC">Personne morale</p>
        Nom Société:  <span class="text-primary">{{ $locataire->nom_societe  }}</span><br>
        N° RCCM :  <span class="text-primary">{{ $locataire->numero_registre  }}</span><br>
        Pj RCCM :  <span class="text-primary">{{ $locataire->nom_societe  }}</span><br>
		
        N° Compte Contribuable :  <span class="text-primary">{{ $locataire->compte_contribuable  }}</span><br>
        N° Compte Bancaire :  <span class="text-primary">{{ $locataire->compte_bancaire  }}</span><br>
        Banque :  <span class="text-primary">{{ $locataire->banque->libelle  }}</span><br>
        Téléphone :  <span class="text-primary">{{ $locataire->telephone_societe  }}</span><br>
        Adresse :  <span class="text-primary">{{ $locataire->adresse_societe  }}</span><br>
        
        <br>
        <span class="">Représentant</span>
        Nom et prénom(s):  <span class="text-primary">{{ $locataire->nom_representant  }}</span><br>
        Contact:  <span class="text-primary">{{ $locataire->contact1_representant.' '.$locataire->contact2_representant  }}</span><br>

    </div>
    @endif
   
    <div class="col-md-4">
        <p class="" style="background-color: #CCC">Représentant/Locataire</p>
        
        Nom et prénom(s):  <span class="text-primary">{{ $locataire->nom.' '.$locataire->prenom}}</span><br>
        Type:  <span class="text-primary">{{ $locataire->type_locataire_acq }}</span><br>
        Mobile:  <span class="text-primary">{{ $locataire->mob1.' '.$locataire->mob2}}</span><br>
        Adresse:  <span class="text-primary">{{ $locataire->adresse}} </span><br>
        N° pièce:  <span class="text-primary">{{ $locataire->numero_piece  }}</span><br>
        Type pièce:  <span class="text-primary">{{ $locataire->type_piece }}</span><br>
        Date naissance:  <span class="text-primary">{{ date('d/m/Y', strtotime($locataire->date_naissance))  }}</span><br>
        Civilité:  <span class="text-primary">{{ $locataire->sexe  }}</span><br>
        Email:  <span class="text-primary">{{ $locataire->autres  }}</span><br>
        
    </div>
    
    
    
    <div class="col-md-4">
       <p class="" style="background-color: #CCC">Autre</p>
        Date enregistrement :  <span class="text-primary">{{ date('d/m/Y', strtotime($locataire->created_at))  }}</span><br>
        
	</div>   
</div>

<br>
<hr>

<h4><u>Bail(s) contracté(s)</u></h4>

<table class="table align-items-center table-flush " id="dataTablebien" style="width:80%">

<thead  style="background-color:#CCC; color:#FFF">

    <tr>
    <th width="">Réf.</th>
    <th width="">Date location</th>
    <th>Bien loué</th>
    <th>Loyer nu</th>
    <th>Section/Parcelle</th>
    </tr>
</thead>


<tbody><?php $i=1; ?>
@foreach($locations as $loca)

    <tr >
	<td><a href="{{ url('location/'.$loca->id)}}">{{ $loca->ref  }}</a></td>
	<td>{{ date('d/m/Y', strtotime($loca->date_location))  }}</td>
	<td>{{ $loca->bien->libelle  }}</td>
    <td>{{ separer($loca->loyer, 3) }} </td>
    <td>{{ $loca->bien->section.'/'.$loca->bien->parcelle }} </td>
    
    </tr>


    @endforeach
                 
                    </tbody>
                  </table>


	</div>
  </div>
</div>


<div>



@if($fact_nb >0 )
<div class="modal fade bd-example-modal-xl" id="modalEtatEntrant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
<h4 class="modal-title" style="text-align: center; color: red" id="titremodal">AVIS D'ECHEANCE EN ATTENTES</h4>
                   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    
<table width="100%" class="table"><tr>
	<th>Réf. facture</th>
	<th>Libellé</th>
	<th>Montant</th>
	<th>Location</th>
	</tr>
	@foreach($factures as $fact)

	
	
	<tr>
		<td>{{ $fact->ref_fact }}</td>
		
		<td>{{ $fact->lib_fact }}</td>

        <td style="text-align: right; color: red" ><b>{{ separer($fact->montant_fact , 3) }}</b></td>
        
        <td>{{ $fact->ref_loca }}</td>
        
	</tr>
	
	@endforeach
</table>					
					
					
					


                </div>
            </div>
        </div>
    </div>


@endif




@endsection
